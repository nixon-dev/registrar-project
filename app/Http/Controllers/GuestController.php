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
            'student_id' => 'required|string',
        ]);

        $data = Document::where('student_id', $request->student_id)->get();

        if (!$data) {
            return redirect()->route('home')->with('error', 'Error: No Document Found');
        }
        
        return view('guest.result', compact('data'));

    }
}
