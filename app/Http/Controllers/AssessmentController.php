<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function create()
    {
        return view('assessment.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        Assessment::create([
            'user_id' => Auth::id(),
            'answers' => $data,
        ]);

        return redirect()->route('dashboard')->with('success', 'Assessment submitted successfully!');
    }
}
