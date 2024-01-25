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
            $sequence = $request->sequence;
            $flatChar = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            //  $flats = $floor;


            for ($i = 0; $i < $floor; $i++) {
                for ($j = 0; $j < $unit; $j++) {
                    if ($sequence == 1) {
                        $flatName = $flatChar[$i] . '-' . ($j + 1);
                    } elseif ($sequence == 2) {
                        $flatName = $flatChar[$j] . '-' . ($i + 1);
                    } elseif ($sequence == 3) {
                        $flatName = ($i + 1) . '-' .  $flatChar[$j];
                    }

                    $start_at = 001;

                    if ($start_at) {
                        $flat = Flat::where('customer_id', Auth::guard('admin')->user()->id)->find( $start_at);
                        if (!$flat) {
                            $data['flat_unique_id'] = $start_at;
                        }
                    }

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

    // flat single create start here
    public function SingleCreate()
    {
        return view('admin.flat.single_create');
    }

    // flat single create start here

    // flat SingleStore start here
    public function SingleStore(Request $request)
    {

        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['flat_name'] = $request->flat_name;
        $data['floor_no'] = $request->floor_no;

        Flat::create($data);
        return redirect()->route('flat.index')->with('message', 'Flat creted successfully');
    }
    // flat SingleStore ends here
}
