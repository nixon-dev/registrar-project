<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Attachmments;
use App\Models\Co;
use App\Models\PendingDocx;
use App\Models\Sessions;
use Auth;
use Hash;
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
use Yajra\DataTables\Facades\DataTables;


class AdminController extends Controller
{
    use RecordHistory;

    public function index()
    {

        $now = Carbon::now();

        $thisMonthDocumentCount = Document::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonth = $now->copy()->subMonth();

        $lastMonthDocumentCount = Document::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
        $statusCounts = Document::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');
        $pendingCount = $statusCounts['Pending'] ?? 0;
        $approvedCount = $statusCounts['Processing'] ?? 0;
        $deniedCount = $statusCounts['Ready for Pickup'] ?? 0;

        $documents = Document::latest()->limit(5)->get(['dr_id', 'last_name', 'first_name', 'middle_name', 'request_type', 'created_at']);

        $userCount = User::where('role', '!=', 'Guest')->count();
        $activeUserCount = Sessions::where('last_activity', '>', Carbon::now()->subMinute(10)->getTimestamp())->count();

        $rawData = Document::selectRaw("
            date_format(document_request.request_date, '%Y-%m-%d') as full_date,
            date_format(document_request.request_date, '%b %d') as month_day,
            request_type,
            count(*) as aggregate
            ")
            ->whereDate('document_request.request_date', '>=', now()->subMonth())
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
            '#5851d5',
            '#1c1c1c',
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
        return view('admin.index', compact('thisMonthDocumentCount', 'lastMonthDocumentCount', 'userCount', 'activeUserCount', 'chartData', 'pendingCount', 'deniedCount', 'approvedCount', 'documents'));
    }



    // DOCUMENTS

    public function document_tracking()
    {
        $data = Document::orderBy('created_at', 'DESC')
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
            'status' => 'nullable|string',
        ]);


        try {
            $document = Document::create([
                'admin_id' => $request->admin_id,
                'request_date' => Carbon::now(),
                'request_type' => $request->request_type,
                'student_id' => $request->student_id,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'course' => $request->course,
                'year_graduated' => $request->year_graduated,
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

    public function document_request_update(Request $request, $id)
    {

        $request->validate([
            'status' => 'required|string',
            'remarks' => 'nullable|string|max:255',
        ]);

        $query = Document::where('dr_id', $id)->update(['status' => $request->status, 'remarks' => $request->remarks]);

        $student_id = Document::where('dr_id', $id)->value('student_id');

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

    public function user_create(Request $request)
    {

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:30',
            'password' => 'required|string|min:4',
        ], [
            'username.unique' => 'This username is already taken.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => User::role_admin,
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
                'redirect' => route('admin.users-list'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error: User creation failed!',
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
        $activities = ActivityLog::orderBy('created_at', 'desc')->limit(150)->get(['created_at', 'history_name', 'history_action', 'history_description']);
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




    public function account_settings()
    {
        return view('admin.settings.account');
    }


    public function documentsData()
    {
        $documents = Document::orderBy('created_at', 'desc');

        return DataTables::of($documents)
            ->addColumn('username', function ($d) {
                return $d->admin->username ?? '';
            })
            ->addColumn('created_at', function ($d) {
                return $d->created_at;
            })
            ->addColumn('view', function ($d) {
                return '<a href="' . route('admin.document-view', ['id' => $d->dr_id]) . '" 
                    class="btn btn-primary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg>
                    </a>';
            })
            ->editColumn('created_at', function ($d) {
                return $d->request_date->format('M d, Y');
            })
            ->filterColumn('fullname', function ($query, $keyword) {
                $query->whereRaw(
                    "CONCAT(last_name,' ',first_name,' ',middle_name) like ?",
                    ["%{$keyword}%"]
                );
            })
            ->addColumn('cbt', function ($d) {
                return '<input type="checkbox"
                    class="row-checkbox"
                    value="' . $d->dr_id . '">';
            })
            ->rawColumns(['view', 'cbt'])
            ->make(true);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'status' => 'required|string'
        ]);

        Document::whereIn('dr_id', $request->ids)
            ->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }




}