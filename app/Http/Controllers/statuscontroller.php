<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
 

class statuscontroller extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'color' => 'required',
    ]);

    Status::create($request->all());

    return redirect()->back()->with('success', 'Status added!');
}

public function update(Request $request, Status $status)
{
    $request->validate([
        'name' => 'required',
        'color' => 'required',
    ]);

    $status->update($request->all());

    return redirect()->back()->with('success', 'Status updated!');
}

public function destroy(Status $status)
{
    $status->delete();
    return redirect()->back()->with('success', 'Status deleted!');
}


}
