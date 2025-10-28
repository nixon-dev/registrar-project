<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Attachmments;
use App\Models\Co;
use App\Models\PendingDocx;
use App\Models\Sessions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Document;
use App\Models\History;
use App\Models\Office;
use App\Models\User;
use App\Models\Items;
use App\Models\Mooe;
use App\Models\ResCenter;
use App\Models\Units;
use Illuminate\Database\QueryException;
use App\Traits\RecordHistory;
use Illuminate\Support\Facades\Storage;
use Session;


class AdminController extends Controller
{
    use RecordHistory;

    public function index()
    {

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;


        $thisMonthDocumentCount = Document::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $lastMonthDocumentCount = Document::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $pendingCount = Document::where('status', 'Pending')
            ->count();

        $approvedCount = Document::where('status', 'For Signing')
            ->count();

        $deniedCount = Document::where('status', 'For Release')
            ->count();

        $documents = Document::orderBy('created_at', 'DESC')->take(5)->get();


        $userCount = User::where('role', '!=', 'Guest')->count();
        $activeUserCount = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())->count();

        $rawData = Document::selectRaw("
    date_format(document_request.request_date, '%Y-%m-%d') as full_date,
    date_format(document_request.request_date, '%b %d') as month_day,
    request_type,
    count(*) as aggregate
")
            ->whereDate('document_request.request_date', '>=', now()->subYear())
            ->groupByRaw("date_format(document_request.request_date, '%Y-%m-%d'), date_format(document_request.request_date, '%b %d'), request_type")
            ->get();

        $allDates = $rawData->pluck('full_date')
            ->unique()
            ->sortBy(fn($date) => \Carbon\Carbon::parse($date))
            ->values();
        $chartLabels = $allDates->map(fn($date) => $rawData->where('full_date', $date)->first()->month_day)->toArray();

        $requestTypes = $rawData->pluck('request_type')->unique();

        $chartDatasets = [];
        $colors = [
            '#f84a65',
            '#4e73df',
            '#1cc88a',
            '#f6c23e',
            '#36b9cc'
        ];
        $colorIndex = 0;

        foreach ($requestTypes as $type) {
            $dataPoints = [];
            $currentColor = $colors[$colorIndex % count($colors)];

            foreach ($allDates as $date) {
                $count = $rawData->where('full_date', $date)
                    ->where('request_type', $type)
                    ->pluck('aggregate')
                    ->first();

                $dataPoints[] = $count ?? 0;
            }

            $chartDatasets[] = [
                'label' => $type,
                'backgroundColor' => $currentColor . '30',
                'borderColor' => $currentColor,
                'data' => $dataPoints,
                'fill' => true,
            ];

            $colorIndex++;
        }

        $chartData = [
            'labels' => $chartLabels,
            'datasets' => $chartDatasets,
        ];

        $activeUsers = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())
            ->leftJoin('users', 'users.id', '=', 'sessions.user_id')
            ->orderBy('last_activity', 'desc')
            ->get();


        $logs = ActivityLog::orderBy('created_at', 'DESC')->take(10)->get();


        return view('admin.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount', 'userCount', 'activeUserCount', 'logs', 'chartData', 'pendingCount', 'deniedCount', 'approvedCount', 'documents', 'activeUsers'));
    }



    // DOCUMENTS

    public function document_tracking()
    {


        $data = Document::orderBy('request_date', 'DESC')
            ->leftJoin('users', 'users.id', '=', 'document_request.admin_id')
            ->select('document_request.*', 'users.username')
            ->orderBy('document_request.request_date', 'desc')
            ->get();

        return view('admin.document', compact('data'));
    }

    public function view_document($id)
    {
        $data = Document::where('dr_id', $id)
            ->leftJoin('users', 'users.id', '=', 'document_request.admin_id')
            ->select('document_request.*', 'users.username')
            ->first();

        if (!$data) {
            return redirect()->route('admin.document')->with('error', 'Error: No Document Found');
        }



        return view('admin.view-document', compact('data'));
    }

    public function document_request_add(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|numeric',
            'request_date' => 'nullable|date',
            'request_type' => 'required|string',
            'student_id' => 'required|string',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'course' => 'required|string',
            'year_graduated' => 'nullable|string',
            'or_number' => 'nullable|string',
            'or_date' => 'nullable|date',
            'purpose' => 'nullable|string',
            'status' => 'nullable|string',
        ]);


        try {
            $document = Document::create([
                'admin_id' => $request->admin_id,
                'request_date' => $request->request_date,
                'request_type' => $request->request_type,
                'student_id' => $request->student_id,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'course' => $request->course,
                'year_graduated' => $request->year_graduated,
                'or_number' => $request->or_number,
                'or_date' => $request->or_date,
                'purpose' => $request->purpose,
                'status' => $request->status,
            ]);

            if ($document) {
                return back()->with('success', 'Document Request added successfully!');
            }
        } catch (\Exception $e) {
            \Log::error("Failed to add document request: " . $e->getMessage());


            return back()->with('error', $e->getMessage());
        }

    }

    public function document_request_update(Request $request)
    {

        $request->validate([
            'dr_id' => 'required|numeric',
            'status' => 'required|string',
            'remarks' => 'nullable|string|max:255',
        ]);

        $query = Document::where('dr_id', $request->dr_id)->update(['status' => $request->status, 'remarks' => $request->remarks]);

        $student_id = Document::where('dr_id', $request->dr_id)->value('student_id');
        
        $this->recordHistory('Updated Status for', $student_id);


        if ($query) {
            return redirect()->back()->with('success', 'Status has been updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to update status.');
        }

    }


    // Users Functions

    public function users_list()
    {
        $usersList = User::where('role', '!=', 'Guest')
            ->get();

        $usersPending = User::where('role', '=', 'Guest')
            ->get();

        return view('admin.settings.users', compact('usersList', 'usersPending'));
    }

    public function view_users($id)
    {
        $info = User::where('id', $id)
            ->get();

        if ($info->isNotEmpty()) {
            return view('admin.view-user', compact('info'));
        } else {
            return redirect()->route('admin.users-list')->with('error', 'Error: User not found');
        }
    }


    public function users_update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'role' => 'required|string',
        ]);

        $query = User::where('id', $request->id)->update(['role' => $request->role]);

        if ($query) {
            return redirect()->back()->with('success', 'User has been updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to update user.');
        }
    }

    public function user_update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
        ]);

        $query = User::where('id', $request->id)->update(['name' => $request->name]);

        if ($query) {
            return response()->json([
                'success' => true,
                'message' => 'Personal information updated successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error: Update Failed',
            ]);
        }
    }

    public function users_delete($id)
    {
        $query = User::where('id', $id)->delete();

        if ($query) {
            return redirect()->route('admin.users-list')->with('success', 'User has been deleted!');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to Delete User');
        }
    }





    public function history(Request $request)
    {
        $activities = ActivityLog::orderBy('created_at', 'desc')->get();
        return view('admin.history', compact('activities'));
    }

    public function active_users()
    {
        $activeUsers = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())
            ->leftJoin('users', 'users.id', '=', 'sessions.user_id')
            ->orderBy('last_activity', 'desc')
            ->get();
        return view('admin.active-users', compact('activeUsers'));
    }


    // Units Functions

    public function units()
    {
        $units = Units::orderBy('unit_name', 'ASC')->get();

        return view('admin.units', compact('units'));
    }



    public function units_add(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|string',
        ]);
        $query = Units::insert([
            'unit_name' => $request->unit_name,
        ]);
        if ($query) {
            return back()->with('success', 'Unit added successfully!');
        } else {
            return back()->with('error', 'Error: Failed to add unit.');
        }
    }

    public function units_edit(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|numeric',
            'unit_name' => 'required|string',
        ]);

        $query = Units::where('unit_id', $request->unit_id)
            ->update([
                'unit_name' => $request->unit_name,
            ]);
        if ($query) {
            return back()->with('success', 'Unit edited successfully!');
        } else {
            return back()->with('error', 'Error: Failed to edit unit.');
        }
    }

    public function units_delete($id)
    {

        $query = Units::where('unit_id', $id)->delete();

        if ($query) {
            return back()->with('success', 'Unit deleted successfully!');
        } else {
            return back()->with('error', 'Error: Failed to delete unit.');
        }
    }

    // Account Settings

    public function account_settings()
    {
        return view('admin.settings.account');
    }

    // Settings



    // Maintenance & Other Operating Expenses
    public function mooe_list()
    {
        $mooes = Mooe::orderBy('name', 'ASC')->get();

        return view('admin.settings.mooe', compact('mooes'));
    }

    public function mooe_add(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
        ]);

        $checkCode = Mooe::where('code', $request->code)->first();

        if ($checkCode) {
            return back()->with('error', 'Error: Code already exists!');
        }

        $query = Mooe::insert([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        if ($query) {
            return back()->with('success', 'MOOE inserted successfully!');
        } else {
            return back()->with('error', 'Error: Failed inserting MOOE');
        }
    }

    public function mooe_edit(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
        ]);

        $query = Mooe::where('code', $request->code)
            ->update([
                'name' => $request->name,
            ]);

        if ($query) {
            return back()->with('success', 'MOOE updated successfully!');
        } else {
            return back()->with('error', 'Error: Failed updating MOOE');
        }
    }

    public function mooe_delete($code)
    {
        $query = Mooe::where('code', $code)->delete();

        if ($query) {
            return back()->with('success', 'MOOE deleted successfully!');
        } else {
            return back()->with('error', 'Error: Failed deleting MOOE');
        }
    }

    // Capital Outlay Functions
    public function co_list()
    {
        $co = Co::orderBy('name', 'ASC')->get();

        return view('admin.settings.co', compact('co'));
    }

    public function co_add(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
        ]);

        $checkCode = Co::where('code', $request->code)->first();

        if ($checkCode) {
            return back()->with('error', 'Error: Code already exists!');
        }

        $query = Co::insert([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        if ($query) {
            return back()->with('success', 'Capital Outlay inserted successfully!');
        } else {
            return back()->with('error', 'Error: Failed inserting Capital Outlay');
        }
    }

    public function co_edit(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
        ]);

        $query = Co::where('code', $request->code)
            ->update([
                'name' => $request->name,
            ]);

        if ($query) {
            return back()->with('success', 'Capital Outlay updated successfully!');
        } else {
            return back()->with('error', 'Error: Failed updating Capital Outlay');
        }
    }

    public function co_delete($code)
    {
        $query = Co::where('code', $code)->delete();

        if ($query) {
            return back()->with('success', 'Capital Outlay deleted successfully!');
        } else {
            return back()->with('error', 'Error: Failed deleting Capital Outlay');
        }
    }
}