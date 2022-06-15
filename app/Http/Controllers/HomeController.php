<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount, sum(price) as sum_price')
                    ->groupBy('name')
                    ->orderBy('sum_amount', 'desc')
                    ->orderBy('name')
                    ->paginate(8);
        return view('userPharmacy.u_home', ['stocks' => $stocks]);
    }

    public function indexaboutU()
    {
        return view('userPharmacy.u_about');
    }


    public function indexprofileU()
    {
        return view('userPharmacy.u_profile');
    }


    public function indexpromotionU(){
        $promotions = Promotion::all();
        return view('userPharmacy.u_promotion', ['promotions' => $promotions]);
    }

    public function indexstockU()
    {
        return view('userPharmacy.u_stock');
    }


    

}
