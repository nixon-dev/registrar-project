<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view("guest.index");
    }

    public function checker(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:10',
        ]);

        $studentId = trim($request->student_id);

        $data = Document::where('student_id', $studentId)
            ->select('request_date', 'status', 'request_type', 'remarks', 'updated_at', 'student_id')
            ->orderBy('request_date', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return redirect()
                ->route('home')
                ->with('error', 'No document found for this Student ID.');
        }

        return view('guest.result', compact('data'));

    }

}
