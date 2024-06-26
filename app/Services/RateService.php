<?php

namespace App\Services;

use App\Models\Rate;
use Illuminate\Http\Request;

class RateService
{
    public function __construct()
    {
        //
    }

    public function saveRate(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'star' => 'required|integer|min:1|max:5',
            'user_id' => 'required',
        ]);

        $rate = Rate::create([
            'content' => $validatedData['content'],
            'star' => $validatedData['star'],
            'user_id' => $validatedData['user_id'],
            'author_id' => $request->user()->id,

        ]);

        return redirect()->back()->with('success', 'Rate created successfully.');
    }

    public function updateRate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'star' => 'required|integer|min:1|max:5',
        ]);

        $rate = Rate::find(['id' => $id])->first()->update([
            'content' => $validatedData['content'],
            'star' => $validatedData['star'],
        ]);

        return redirect()->back()->with('success', 'Rate updated successfully.');
    }

    public function deleteRate(Request $request, $id)
    {
        $rate = Rate::find(['id' => $id])->first()->delete();

        return redirect()->back()->with('success', 'Rate deleted successfully.');
    }
}
