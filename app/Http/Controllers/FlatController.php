<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use Illuminate\Http\Request;
use Auth;

class FlatController extends Controller
{
    // Index method start here 
    public function Index()
    {
        $data = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.flat.index', compact('data'));
    }
    // Index method ends here 

    // create method start here 
    public function Create()
    {
        return view('admin.flat.create');
    }
    // create method ends here 

    // storer method start here 
    public function Store(Request $request)
    {
        if (Flat::where('customer_id', Auth::guard('admin')->user()->id)->exists()) {
            return redirect()->route('flat.index')->with('message', ' OPS! You have already created!');
        } else {
            $floor = $request->floor;
            $unit = $request->unit;
            $flatChar = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            //  $flats = $floor;


            for ($i = 0; $i < $floor; $i++) {
                for ($j = 0; $j < $unit; $j++) {
                    $flatName = $flatChar[$i] . '-' . ($j + 1);

                    $data['customer_id'] = Auth::guard('admin')->user()->id;
                    $data['flat_name'] = $flatName;
                    $data['floor_no'] = $i + 1;

                    Flat::create($data);
                }
            }
            return redirect()->route('flat.index')->with('message', 'Flat creted successfully');
        }
    }
    // store method ends here 
}
