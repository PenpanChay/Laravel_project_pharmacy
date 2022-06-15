<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Promotion;
use App\BillDetail;
use App\Bill;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PDF;
use Charts;
use App\query;
use Redirect;
use Validator;
use Session;


class AdminController extends Controller
{
    private $curr_raw_time;
    private $curr_date;
    private $curr_date_time;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Bangkok');
        $this->curr_raw_time = getdate();
        $this->curr_date = $this->curr_raw_time['year'] . '-' . $this->curr_raw_time['mon'] . '-' . $this->curr_raw_time['mday'];
        $this->curr_date_time = $this->curr_raw_time['year'] . '-' . $this->curr_raw_time['mon'] . '-' . $this->curr_raw_time['mday'] . ' ' . $this->curr_raw_time['hours'] . ':' . $this->curr_raw_time['minutes'] . ':' . $this->curr_raw_time['seconds'];
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
        return view('adminPharmacy.a_home', ['stocks' => $stocks]);
    }

    public function indexaboutAd()
    {
        return view('adminPharmacy.a_about');
    }

    public function indexaddpromotionAd()
    {
        return view('adminPharmacy.a_addpromotion');
    }

  

    public function indexadduserAd()
    {
        return view('adminPharmacy.a_adduser');
    }

    public function indexaddstockAd()
    {
        return view('adminPharmacy.a_addstock');
    }

    public function indexchangepassAd()
    {
        return view('adminPharmacy.a_changepass');
    }

    public function indexprofileAd()
    {
        return view('adminPharmacy.a_profile');
    }

    public function promotionAd(){
        $promotions = Promotion::all();
        return view('adminPharmacy.a_promotion', ['promotions' => $promotions]);
    }

    public function promotionEm(){
        $promotions = Promotion::all();
        return view('EmployeePharmacy.e_promotion', ['promotions' => $promotions]);
    }

    public function promotionUs(){
        $promotions = Promotion::all();
        return view('userPharmacy.u_promotion', ['promotions' => $promotions]);
    }

    public function indexstockAd()
    {
        return view('adminPharmacy.a_stock');
    }

    // public function indexreportAd()
    // {
    //     $bill_details = DB::table('bill_details')->paginate(15);
    //     return view('adminPharmacy.a_report', ['bill_details' => $bill_details]);
    // }

    // public function charts()
    // {
    //     $chart = Charts::new('line', 'highcharts')
    //         ->setTitle("My website users")
    //         ->setLabels(["ES", "FR", "RU"])
    //         ->setValues([100,50,25])
    //         ->setElementLabel("Total users");

    //     return view('adminPharmacy.a_graph', ['chart' => $chart]);
    // }

    public function adminAd(){
        $users = User::all();
        return view('adminPharmacy.a_admin', ['users' => $users]);
    }



    

    // //

    public function employAd(){
        $users = User::all();
        return view('adminPharmacy.a_employ', ['users' => $users]);
    }




   

    //user
    public function userAd(){
        $users = User::all();
        return view('adminPharmacy.a_user', ['users' => $users]);
    }



    public function addUser(Request $request){
        $this->validate($request, [
            'code_user' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'birth' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'tel' => 'required',
            'disease' => 'required',
            'drug' => 'required'
            // 'size_imguser' => 'required',
             // 'type_imguser' => 'required'
        ]);

        $users = new User;
        $users->code_user = $request->input('code_user');
        $users->name = $request->input('name');
        $users->surname = $request->input('surname');
        $users->role = $request->input('role');
        $users->email = $request->input('email');
        $users->password  = Hash::make($request->input('password'));
        $users->birth = $request->input('birth');
        $users->age = $request->input('age');
        $users->sex = $request->input('sex');
        $users->tel = $request->input('tel');
        $users->disease = $request->input('disease');
        $users->drug = $request->input('drug');
        $users->size_imguser = $request->input('size_imguser');
        $users->type_imguser = $request->input('type_imguser');
        if(Input::hasFile('image')){
            $user=Input::file('image');
            $user->move(public_path(). '/frontend/images/', $user->getClientOriginalName());

            $users->name_imguser = $user->getClientOriginalName();
            $users->size_imguser = $user->getClientsize();
            $users->type_imguser = $user->getClientMimeType();
        }

        $users->save();
            return redirect('/userAd')->with('info', 'User Saved Successfully!');
    }

    public function updateUser($id){
        $users = User::find($id);

        return view('adminPharmacy.a_updateuser', ['users' => $users]);
    }

    public function editUser(Request $request, $id){
        $this->validate($request, [
            'code_user' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            // 'password' => 'required|string|min:6|confirmed',
            'birth' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'tel' => 'required',
            'disease' => 'required',
            'drug' => 'required'
        ]);
        $data = array(
        'code_user' => $request->input('code_user'),
        'name' => $request->input('name'),
        'surname' => $request->input('surname'),
        'name_img' => $request->input('name_img'),
        'email' => $request->input('email'),
        'password'  => Hash::make($request->input('password')),
        'birth' => $request->input('birth'),
        'age' => $request->input('age'),
        'sex' => $request->input('sex'),
        'tel' => $request->input('tel'),
        'disease' => $request->input('disease'),
        'drug' => $request->input('drug'),
        'size_imguser' => $request->input('size_imguser'),
        'type_imguser' => $request->input('type_imguser'),


        );

        User::where('id', $id)->update($data);
        return redirect('/userAd')->with('info', 'User Update Successfully!');
    }

    public function showUser($id){
        $users = User::find($id);

        return view('adminPharmacy.a_showuser', ['users' => $users]);

    }

    public function deleteUser($id){
        User::where('id', $id)
        ->delete();
        return redirect('/userAd')->with('info', 'User Deleted Successfully!');
    }

    public function addpromotion(Request $request){
        $this->validate($request, [
            'description_pro' => 'required',
        ]);

        $promotions = new Promotion;
        $promotions->description_pro = $request->input('description_pro');
        $promotions->size_imgpromotion = $request->input('size_imgpromotion');
        $promotions->type_imgpromotion = $request->input('type_imgprommotion');
        if(Input::hasFile('image')){
            $promotion=Input::file('image');
            $promotion->move(public_path(). '/frontend/images/', $promotion->getClientOriginalName());

            $promotions->name_imgpromotion = $promotion->getClientOriginalName();
            $promotions->size_imgpromotion = $promotion->getClientsize();
            $promotions->type_imgpromotion = $promotion->getClientMimeType();
        }
        $promotions->save();
        return redirect('/promotionAd')->with('info', 'Promotion Saved Successfully!');

    }

 
    public function deletepromotion($id){
        Promotion::where('id', $id)
        ->delete();
        return redirect('/promotionAd')->with('info', 'Promotion Deleted Successfully!');
    }

//em
    public function expem() {
        
        $curr_date = $this->curr_raw_time['year'] . '-' . $this->curr_raw_time['mon'] . '-' . $this->curr_raw_time['mday'];
        $ages = DB::table('stocks')
        ->orderBy('exp', 'asc')->get();
        $expire_count = 0;
        $exp = array();
        foreach ($ages as $item) {
            if ((strtotime($item->exp) - strtotime($curr_date)) / (60 * 60 * 24) <= 90) array_push($exp, $item);
        }
        return View('EmployeePharmacy.e_exp')->with('stocks', $exp);
    }

public function outem() {
        
        $out = array();
        $amount = DB::table('stocks')->where('amout', '<', 30)
        ->orderBy('amout', 'asc')->get();
        foreach ($amount as $item) {
            
            array_push($out, $item);
        }
        
        return View('EmployeePharmacy.e_out')->with('stocks', $out);
    }

    //endem


public function exp() {
        
        $curr_date = $this->curr_raw_time['year'] . '-' . $this->curr_raw_time['mon'] . '-' . $this->curr_raw_time['mday'];
        $ages = DB::table('stocks')
        ->orderBy('exp', 'asc')->get();
        $expire_count = 0;
        $exp = array();
        foreach ($ages as $item) {
            if ((strtotime($item->exp) - strtotime($curr_date)) / (60 * 60 * 24) <= 90) array_push($exp, $item);
        }
        return View('adminPharmacy.a_exp')->with('stocks', $exp);
    }

public function out() {
        
        $out = array();
        $amount = DB::table('stocks')->where('amout', '<', 30)
        ->orderBy('amout', 'asc')->get();
        foreach ($amount as $item) {
            
            array_push($out, $item);
        }
        
        return View('adminPharmacy.a_out')->with('stocks', $out);
    }

    public function topdrug() {
        return View('adminPharmacy.a_top');
    }

    public function topstaff() {
        return View('adminPharmacy.a_topstaff');
    }

    public function topdrug2() {
        $date       = Input::get('keyword') . "%";
        $date_start = substr($date, 0, 8) . "01";
        $date_end   = substr($date, 0, 8) . "31";

        $year = substr($date, 0, 4) . '%';
        $count = 0;
        Session::flash('keyword', Input::get('keyword'));
        Session::flash('range', Input::get('range'));

        if(Input::get('range') == "date"){
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount, sum(price) as sum_price')
                    ->where('updated_at', 'like', $date)
                    ->groupBy('name')
                    ->orderBy('sum_amount', 'desc')
                    ->orderBy('name')
                    ->paginate(200);

        $data = DB::table('bill_details')
        ->select('name', DB::raw('SUM(bill_details.amout) as amount_sales'))
        ->where('updated_at', 'like', $date)
        ->groupBy('name')
        ->orderBy('amount_sales', 'desc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Amount Sales")
        ->title('กราฟแสดงยอดอันดับการขาย')
        ->dimensions(1000, 500)
        ->labels($data->pluck('name'))
        ->values($data->pluck('amount_sales'))
        ->responsive(true);

        }

        else if(Input::get('range') == "year"){
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount, sum(price) as sum_price')
                    ->where('updated_at', 'LIKE', $year)
                    ->groupBy('name')
                    ->orderBy('sum_amount', 'desc')
                    ->orderBy('name')
                    ->paginate(200);

        $data = DB::table('bill_details')
        ->select('name', DB::raw('SUM(bill_details.amout) as amount_sales'))
        ->where('updated_at', 'LIKE', $year)
        ->groupBy('name')
        ->orderBy('amount_sales', 'desc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Amount Sales")
        ->title('กราฟแสดงยอดอันดับการขาย')
        ->dimensions(1000, 500)
        ->labels($data->pluck('name'))
        ->values($data->pluck('amount_sales'))
        ->responsive(true);

        }
        else if(Input::get('range') == "month") {
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount, sum(price) as sum_price')
                    ->whereBetween('updated_at', [$date_start, $date_end])
                    ->groupBy('name')
                    ->orderBy('sum_amount', 'desc')
                    ->orderBy('name')
                    ->paginate(200);

        $data = DB::table('bill_details')
        ->select('name', DB::raw('SUM(bill_details.amout) as amount_sales'))
        ->whereBetween('updated_at', [$date_start, $date_end])
        ->groupBy('name')
        ->orderBy('amount_sales', 'desc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Amount Sales")
        ->title('กราฟแสดงยอดอันดับการขาย')
        ->dimensions(1000, 500)
        ->labels($data->pluck('name'))
        ->values($data->pluck('amount_sales'))
        ->responsive(true);

        }
         else $result = false;  
         $count = count($result);

         
        return View('adminPharmacy.a_top',compact('result','count'),['chart'=>$chart]);
    }
    
    public function topstaff2() {
        $date       = Input::get('keyword') . "%";
        $date_start = substr($date, 0, 8) . "01";
        $date_end   = substr($date, 0, 8) . "31";

        $year = substr($date, 0, 4) . '%';
        $counts = 0;
        Session::flash('keyword', Input::get('keyword'));
        Session::flash('range', Input::get('range'));
        if(Input::get('range') == "date"){
            $results = DB::table('bills')
                    ->selectRaw('*, sum(sum) as sum_sum')
                    ->where('updated_at', 'like', $date)
                    ->groupBy('staff')
                    ->orderBy('sum_sum', 'desc')
                    ->orderBy('updated_at')
                    ->paginate(25);
        

        $data = DB::table('bills')
        ->select('staff', DB::raw('SUM(bills.sum) as total_sales'))
        ->where('updated_at', 'like', $date)
        ->groupBy('staff')
        ->orderBy('total_sales', 'desc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Total Sales")
        ->title('กราฟแสดงอันดับยอดขายเภสัชกร')
        ->dimensions(1000, 500)
        ->labels($data->pluck('staff'))
        ->values($data->pluck('total_sales'))
        ->responsive(true);
    }

        else if(Input::get('range') == "year"){
            $results = DB::table('bills')
                    ->selectRaw('*, sum(sum) as sum_sum')
                    ->where('updated_at', 'LIKE', $year)
                    ->groupBy('staff')
                    ->orderBy('sum_sum', 'desc')
                    ->orderBy('updated_at')
                    ->paginate(25);
        

        $data = DB::table('bills')
        ->select('staff', DB::raw('SUM(bills.sum) as total_sales'))
        ->where('updated_at', 'LIKE', $year)
        ->groupBy('staff')
        ->orderBy('total_sales', 'desc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Total Sales")
        ->title('กราฟแสดงอันดับยอดขายเภสัชกร')
        ->dimensions(1000, 500)
        ->labels($data->pluck('staff'))
        ->values($data->pluck('total_sales'))
        ->responsive(true);
    }

        else if(Input::get('range') == "month") {
            $results = DB::table('bills')
                    ->selectRaw('*, sum(sum) as sum_sum')
                    ->whereBetween('updated_at', [$date_start, $date_end])
                    ->groupBy('staff')
                    ->orderBy('sum_sum', 'desc')
                    ->orderBy('updated_at')
                    ->paginate(25);
        

        $data = DB::table('bills')
        ->select('staff', DB::raw('SUM(bills.sum) as total_sales'))
        ->whereBetween('updated_at', [$date_start, $date_end])
        ->groupBy('staff')
        ->orderBy('total_sales', 'desc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Total Sales")
        ->title('กราฟแสดงอันดับยอดขายเภสัชกร')
        ->dimensions(1000, 500)
        ->labels($data->pluck('staff'))
        ->values($data->pluck('total_sales'))
        ->responsive(true);
    }
        else $results = false;  
         $count = count($results);

        return View('adminPharmacy.a_topstaff',['chart'=>$chart])->with('results', $results);
    }

    public function reportAd() {
        return View('adminPharmacy.a_report');
    }

    // public function pdf()
    // {
    //     $bill_details = BillDetail::all();
    //     $pdf = PDF::loadView('adminPharmacy.pdf', ['bill_details' => $bill_details]);
    //     return $pdf->stream();
    // }
 
    // public function pdfdown()
    // {
    //     $bill_details = BillDetail::all();
    //     $pdf = PDF::loadView('adminPharmacy.pdf', ['bill_details' => $bill_details]);
    //     return $pdf->download('report.pdf');
    // }

    public function reportAd2() {
        $date       = Input::get('keyword') . "%";
        $date_start = substr($date, 0, 8) . "01";
        $date_end   = substr($date, 0, 8) . "31";

        $year = substr($date, 0, 4) . '%';
        $count = 0;
        Session::flash('keyword', Input::get('keyword'));
        Session::flash('range', Input::get('range'));

        if(Input::get('range') == "date"){
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount')
                    ->where('updated_at', 'like', $date)
                    ->groupBy('id')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(200);

         $data = DB::table('bill_details')
        ->select('name', DB::raw('SUM((bill_details.price-bill_details.sale) * bill_details.amout) as total_sales'))
        ->where('updated_at', 'like', $date)
        ->groupBy('name')
        ->orderBy('name', 'asc')
        ->get();


        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Total Sales")
        ->title('กราฟแสดงรายงานการขาย')
        ->dimensions(1000, 500)
        ->labels($data->pluck('name'))
        ->values($data->pluck('total_sales'))
        ->responsive(true);


        }

        else if(Input::get('range') == "year"){
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount')
                    ->where('updated_at', 'LIKE', $year)
                    ->groupBy('id')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(200);

        $data = DB::table('bill_details')
        ->select('name', DB::raw('SUM((bill_details.price-bill_details.sale) * bill_details.amout) as total_sales'))
        ->where('updated_at', 'LIKE', $year)
        ->groupBy('name')
        ->orderBy('name', 'asc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Total Sales")
        ->title('กราฟแสดงรายงานการขาย')
        ->dimensions(1000, 500)
        ->labels($data->pluck('name'))
        ->values($data->pluck('total_sales'))
        ->responsive(true);

        }
        else if(Input::get('range') == "month") {
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount')
                    ->whereBetween('updated_at', [$date_start, $date_end])
                    ->groupBy('id')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(200);

        $data = DB::table('bill_details')
        ->select('name', DB::raw('SUM((bill_details.price-bill_details.sale) * bill_details.amout) as total_sales'))
        ->whereBetween('updated_at', [$date_start, $date_end])
        ->groupBy('name')
        ->orderBy('name', 'asc')
        ->get();

        $chart = Charts::create('bar', 'highcharts')
        ->elementLabel("Total Sales")
        ->title('กราฟแสดงรายงานการขาย')
        ->dimensions(1000, 500)
        ->labels($data->pluck('name'))
        ->values($data->pluck('total_sales'))
        ->responsive(true);

        }
         else $result = false;  
         $count = count($result);
        return View('adminPharmacy.a_report',compact('result','count'), ['chart' => $chart]);
    }

    public function reportAdpdf() {
        $date       = Input::get('keyword') . "%";
        $date_start = substr($date, 0, 8) . "01";
        $date_end   = substr($date, 0, 8) . "31";

        $year = substr($date, 0, 4) . '%';
        $count = 0;
        Session::flash('keyword', Input::get('keyword'));
        Session::flash('range', Input::get('range'));

        if(Input::get('range') == "date"){
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount')
                    ->where('updated_at', 'like', $date)
                    ->groupBy('id')
                    ->orderBy('bill_id')
                    ->orderBy('id', 'asc')
                    ->paginate(200);
        }

        else if(Input::get('range') == "year"){
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount')
                    ->where('updated_at', 'LIKE', $year)
                    ->groupBy('id')
                    ->orderBy('bill_id')
                    ->orderBy('id', 'asc')
                    ->paginate(200);

        }
        else if(Input::get('range') == "month") {
            $result = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount')
                    ->whereBetween('updated_at', [$date_start, $date_end])
                    ->groupBy('id')
                    ->orderBy('bill_id')
                    ->orderBy('id', 'asc')
                    ->paginate(200);

        }
         else $result = false;  
         $count = count($result);
        // return View('adminPharmacy.a_report',compact('result','count'));
         $pdf = PDF::loadView('adminPharmacy.pdf',compact('result','count'));
        return $pdf->stream();
    }

}
