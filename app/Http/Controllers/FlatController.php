<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Flatid;
use App\Models\Flatmaster;
use App\Models\Income;
use Illuminate\Http\Request;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Auth;
use Carbon\Carbon;

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
        $flat = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.flat.create', compact('flat'));
    }
    // create method ends here 

    // storer method start here 
    public function Store(Request $request)
    {
        if (Flat::where('customer_id', Auth::guard('admin')->user()->id)->exists()) {
            return redirect()->back()->with('message', ' OPS! You have already created!');
        } else {
            $floor = $request->floor;
            $unit = $request->unit;
            $sequence = $request->sequence;
            $amount = $request->amount;

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

                    $data['customer_id'] = Auth::guard('admin')->user()->id;
                    $data['flat_name'] = $flatName;
                    $data['floor_no'] = $i + 1;
                    $data['amount'] = $amount;
                    // dd($data);
                    $flatmaster = Flatmaster::create($data);
                    // dd($flatmaster);


                    if ($flatmaster) {
                        $Fid = UniqueIdGenerator::generate(['table' => 'flatids', 'length' => 3]);
                        $flatid['flat_id'] = $Fid;
                        $flatid['customer_id'] = Auth::guard('admin')->user()->id;
                        Flatid::create($flatid);
                    }
                }
            }

            if ($flatmaster) {
                $flatmasters = Flatmaster::where('customer_id', Auth::guard('admin')->user()->id)->get();
                // dd($flatmasters);
                // $flatids = Flatid::where('customer_id', Auth::guard('admin')->user()->id)->get();

                // foreach($flatids as $flatid){
                //     $flat_unique_id = $flatid->flat_id . Auth::guard('admin')->user()->id;
                // }
                // dd($flat_unique_id[]);
                // $flat = array();
                foreach ($flatmasters as $flatmaster) {
                    $flatid = Flatid::where('id', $flatmaster->id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
                    $flat['flat_unique_id'] = $flatid->flat_id;
                    $flat['customer_id'] = Auth::guard('admin')->user()->id;
                    $flat['flat_name'] = $flatmaster->flat_name;
                    $flat['floor_no'] = $flatmaster->floor_no;
                    $flat['charge'] = "Service Charge";
                    $flat['amount'] = $flatmaster->amount;
                    $flat['create_date'] = date('d');
                    $flat['create_month'] = date('F');
                    $flat['create_year'] = date('Y');

                    // dd($flatmaster->amount);
                    Flat::create($flat);
                }
            }
            Flatmaster::where('customer_id', Auth::guard('admin')->user()->id)->delete();
            Flatid::where('customer_id', Auth::guard('admin')->user()->id)->delete();

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
        $unique_id = Flat::where('customer_id', Auth::guard('admin')->user()->id)->max('flat_unique_id');
        $flat = Flat::where('customer_id', Auth::guard('admin')->user()->id)->first();

        $zeroo = '0';
        $data['flat_unique_id'] = ($zeroo) . ++$unique_id;
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['flat_name'] = $request->flat_name;
        $data['floor_no'] = $request->floor_no;
        $data['charge'] = "Service Charge";
        $data['amount'] = $flat->amount;
        $flat['create_date'] = date('Y-m-Y');
        $flat['create_month'] = date('F');
        $flat['create_year'] = date('Y');

        $flat = Flat::create($data);
        return redirect()->route('flat.index')->with('message', 'Flat creted successfully');
    }
    // flat SingleStore ends here
}
