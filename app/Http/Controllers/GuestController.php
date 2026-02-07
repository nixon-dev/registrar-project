<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Cache;
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
            'student_id' => 'required|string|max:10|regex:/^[0-9]{2}-[0-9]{4,6}$/',
        ]);

        $studentId = trim($request->student_id);

        $cacheKey = 'check_' . md5($studentId);

        $data = Cache::remember($cacheKey, now()->addMinute(3), function () use ($studentId) {
            return Document::where('student_id', $studentId)
                ->select('request_date', 'status', 'request_type', 'remarks', 'updated_at', 'student_id')
                ->orderBy('request_date', 'desc')
                ->get();
        });

        return view('guest.result', compact('data', 'studentId'));

    }

}
