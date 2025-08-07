<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;     
use App\Models\Status;  
use App\Models\Product;

use Carbon\Carbon;


class leadcontroller extends Controller
{

public function index(Request $request)
{
    $statuses = Status::all();
    $products = Product::all(); 

     $perPage = $request->get('per_page', 10);
   

    $leads = Lead::with('product') // if you want to show product
                 ->orderBy('followup_date', 'asc')
                 ->paginate($perPage)
                 ->appends($request->query()); 

    return view('leads.index', compact('leads', 'statuses', 'products'));
}


public function kanban()
{
    $statuses = \App\Models\Status::with(['leads' => function ($query) {
        $query->orderBy('followup_date', 'asc');
    }])->get();

    return view('leads.kanban', compact('statuses'));
}

        

public function store(Request $request)
{
    $validated = $request->validate([
        'customer' => 'required|string|max:255',
       'product_id' => 'nullable|exists:products,id',
        'status_id' => 'required|exists:statuses,id',
        'source' => 'nullable|string|max:255',
        'number' => 'nullable|string|max:255',
        'followup_date' => 'nullable|date',
        'next_action' => 'nullable|string|max:255',
        'call_status' => 'nullable|string|max:255',
    ]);

    \App\Models\Lead::create($validated);

    return redirect()->route('leads.index')->with('success', 'Lead added successfully!');
}

public function destroy($id)
{
    $lead = Lead::findOrFail($id);
    $lead->delete();

    return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
}

public function updateInteraction(Request $request)
{
    $request->validate([
        'lead_id' => 'required|exists:leads,id',
        'followup_date' => 'required|date',
        'status_id' => 'required|exists:statuses,id',
        'call_status' => 'required|string'
    ]);

    $lead = Lead::findOrFail($request->lead_id);
    $lead->update([
        'followup_date' => $request->followup_date,
        'status_id' => $request->status_id,
        'call_status' => $request->call_status
    ]);

    return redirect()->route('leads.index')->with('success', 'Interaction updated successfully.');
}



public function filterByDate($date)
{
    $statuses = Status::all();
    $products = Product::all();

    $leads = Lead::whereDate('followup_date', Carbon::parse($date))
                 ->orderBy('followup_date', 'asc')
                 ->paginate(10);

    return view('leads.index', compact('leads', 'statuses', 'products'));
}

public function filterByStatus($status_id)
{
    $statuses = Status::all();
    $products = Product::all();

    $leads = Lead::where('status_id', $status_id)
                 ->orderBy('followup_date', 'asc')
                 ->paginate(10);

    return view('leads.index', compact('leads', 'statuses', 'products'));
}

// public function search(Request $request)
// {
//     $query = $request->input('query');
//     $statuses = Status::all();
//     $products = Product::all();

//     $leads = Lead::where('customer', 'like', "%{$query}%")
//                  ->orWhere('number', 'like', "%{$query}%")
//                  ->orWhere('source', 'like', "%{$query}%")
//                  ->orderBy('followup_date', 'asc')
//                  ->paginate(10);

//     return view('leads.index', compact('leads', 'statuses', 'products'));
// }

public function liveSearch(Request $request)
{
    $query = $request->query('query');

    // $leads = Lead::where('customer', 'like', "%{$query}%")
    //             ->orWhere('number', 'like', "%{$query}%")
    //             ->orWhere('source', 'like', "%{$query}%")
    //             ->orderBy('followup_date', 'asc')
    //             ->paginate(10);


     $leads = Lead::with('product') // eager load product
        ->where(function ($q) use ($query) {
            $q->where('customer', 'like', "%{$query}%")
              ->orWhere('number', 'like', "%{$query}%")
              ->orWhere('source', 'like', "%{$query}%")
              ->orWhereHas('product', function ($q2) use ($query) {
                  $q2->where('name', 'like', "%{$query}%");
              });
        })
        ->orderBy('followup_date', 'asc')
        ->paginate(10);

    return view('leads.partials.table', compact('leads'))->render();
}


}
