<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RateController extends Controller
{
    public function store(Request $request)
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

    public function update(Request $request)
    {
        $id = $request->route('id');

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

    public function delete(Request $request)
    {
        $id = $request->route('id');

        $rate = Rate::find(['id' => $id])->first();

        if ($rate && $request->user()->id == $rate->author->id) {
            $rate->delete();
            return redirect()->back()->with('success', 'Rate deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this rate.');
    }
}
