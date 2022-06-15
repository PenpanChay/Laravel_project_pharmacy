<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Promotion;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
        return view('EmployeePharmacy.e_home', ['stocks' => $stocks]);
    }

    public function indexaboutEm()
    {
        return view('EmployeePharmacy.e_about');
    }

    public function indexaddpromotionEm()
    {
        return view('EmployeePharmacy.e_addpromotion');
    }

    public function indexadduserEm()
    {
        return view('EmployeePharmacy.e_adduser');
    }

    public function indexaddstockEm()
    {
        return view('EmployeePharmacy.e_addstock');
    }

    public function indexchangepassEm()
    {
        return view('EmployeePharmacy.e_changepass');
    }

    public function indexprofileEm()
    {
        return view('EmployeePharmacy.e_profile');
    }


    public function indexsaleEm()
    {
        return view('EmployeePharmacy.e_sale');
    }

    

    public function indexstockEm()
    {
        return view('EmployeePharmacy.e_stock');
    }


    public function promotionEm(){
        $promotions = Promotion::all();
        return view('EmployeePharmacy.e_promotion', ['promotions' => $promotions]);
    }
    

    
    //




    //user
    public function userEm(){
        $users = User::all();
        return view('EmployeePharmacy.e_user', ['users' => $users]);
    }

    public function employEm(){
        $users = User::all();
        return view('EmployeePharmacy.e_employ', ['users' => $users]);
    }



    public function addUserEm(Request $request){
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
            // 'size_img' => 'required',
             // 'type_img' => 'required'
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
        return redirect('/userEm')->with('info', 'User Saved Successfully!');

    }

    public function updateUserEm($id){
        $users = User::find($id);

        return view('EmployeePharmacy.e_updateuser', ['users' => $users]);
    }

    public function editUserEm(Request $request, $id){
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

        User::where('id_user', $id)->update($data);
        return redirect('/userEm')->with('info', 'User Update Successfully!');
    }

    public function showUserEm($id){
        $users = User::find($id);

        return view('EmployeePharmacy.e_showuser', ['users' => $users]);

    }

    public function deleteUserEm($id){
        User::where('id_user', $id)
        ->delete();
        return redirect('/userEm')->with('info', 'User Deleted Successfully!');
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
        return redirect('/promotionEm')->with('info', 'Promotion Saved Successfully!');

    }

 
    public function deletepromotion($id){
        Promotion::where('id', $id)
        ->delete();
        return redirect('/promotionEm')->with('info', 'Promotion Deleted Successfully!');
    }
}
