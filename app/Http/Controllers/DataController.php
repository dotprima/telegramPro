<?php

namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(){
        try {
            $datas = Data::all();
            return view('data.index', compact('datas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve data');
        }
    }

    public function chart1(){

        try {
            $response = [
                Data::sum('A1') + Data::sum('A2') + Data::sum('A3') + Data::sum('A4') + Data::sum('A5'),
                Data::sum('SN1') + Data::sum('SN2') + Data::sum('SN3') + Data::sum('SN4') + Data::sum('SN5'),
                Data::sum('PBC1') + Data::sum('PBC2') + Data::sum('PBC3') + Data::sum('PBC4') + Data::sum('PBC5'),
                Data::sum('EC1') + Data::sum('EC2') + Data::sum('EC3') + Data::sum('EC4') + Data::sum('EC5'),
                Data::sum('PI1') + Data::sum('PI2') + Data::sum('PI3') + Data::sum('PI4') + Data::sum('PI5')
            ];
            
            $jsonResponse = json_encode($response);
            return $jsonResponse;
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve data');
        }

    }
}
