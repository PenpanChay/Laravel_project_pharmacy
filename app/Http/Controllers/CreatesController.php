<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Stock;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Bill;
use App\BillDetail;
use Redirect;
use Validator;
use Session;
use App\User;
use PDF;
use Charts;
use App\query;

class CreatesController extends Controller
{
    //

    // public function createimg(){
    //     return view("file");
    // }
    private $curr_raw_time;
    private $curr_date;
    private $curr_date_time;
    public function __construct() {
        date_default_timezone_set('Asia/Bangkok');
        $this->curr_raw_time = getdate();
        $this->curr_date = $this->curr_raw_time['year'] . '-' . $this->curr_raw_time['mon'] . '-' . $this->curr_raw_time['mday'];
        $this->curr_date_time = $this->curr_raw_time['year'] . '-' . $this->curr_raw_time['mon'] . '-' . $this->curr_raw_time['mday'] . ' ' . $this->curr_raw_time['hours'] . ':' . $this->curr_raw_time['minutes'] . ':' . $this->curr_raw_time['seconds'];
    }
    
    public function shop() {
        $bill = DB::table('bills')->orderBy('id', 'desc');
        if (!$bill->first()) {
            DB::table('bills')->insert(['sum' => 0, 'created_at' => $this->curr_date_time, 'updated_at' => $this->curr_date_time]);
            $bill = DB::table('bills')->orderBy('id', 'desc');
        }
        $bill->update(['updated_at' => $this->curr_date_time]);
        $bill = $bill->first();
        
        $bill_details = DB::table('bill_details')->where('bill_id', $bill->id)->get();
        
        $total = 0;
        $total_sale = 0;
        foreach ($bill_details as $i) {
            $total+= ($i->amout * ($i->price-$i->sale));
            $total_sale+= ($i->amout * $i->sale);
        }

        return View('adminPharmacy.a_cheer')->with('bill_details', $bill_details)->with('bill', $bill)->with('total', $total)->with('total_sale', $total_sale);
    }
    
    //เพิ่มยาในหน้าขาย
    public function addDrug($id) {
        
        //return $id;
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        $drug = DB::table('stocks')->where('id', $id)->first();
        $exist_drug = DB::table('bill_details')->where('bill_id', $bill->id)->where('drug_id', $drug->id);
        
        if ($exist_drug->count()) {
            $exist_drug->increment('amout');
        }
        else {
            
            DB::table('bill_details')
                ->insert(['bill_id' => $bill->id, 
                    'drug_id' => $drug->id, 
                    'code' => $drug->code, 
                    'name' => $drug->name, 
                    'name_imgdrug' => $drug->name_imgdrug,
                    'type' => $drug->type, 
                    'size' => $drug->size, 
                    'description' => $drug->description,
                    'amout' => 1, 
                    'price' => $drug->price,
                    'sale' => $drug->sale,
                    'mfd' => $drug->mfd, 
                    'exp' => $drug->exp,
                    'created_at' => $this->curr_date,
                    'updated_at' => $this->curr_date]);
        }
        
        
        
        return Redirect::to('shop');
    }
    
    //เแสดงการอัฟเดตบิล
    public function postBillUpdate() {
        $ids = Input::get('id');
        $amounts = Input::get('amount');
        $sum = Input::get('sum');
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        
        for ($i = 0; $i < sizeof($ids); $i++) {
            DB::table('bill_details')->where('bill_id', $bill->id)->where('id', $ids[$i])->update(['amout' => $amounts[$i]]);
        }
        
        DB::table('bills')->where('id', $bill->id)->update(['sum' => $sum, 'updated_at' => $this->curr_date_time]);
        
        return 'true';
    }
    
    //เซฟบิล
    
    public function postBillSave() {
        // return Input::all();
        $ids = Input::get('id');

        $amounts = Input::get('amount');
        $sum = Input::get('total');
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        $staff = Input::get('staff');

        if(!$ids) {
            return "bill is empty";
        }
        
        for ($i = 0; $i < sizeof($ids); $i++) {
            $curr_bill_detail = DB::table('bill_details')->where('id', $ids[$i])->first();
            //return var_dump($curr_bill_detail->drug_id);
            $curr_drug = DB::table('stocks')->where('id', $curr_bill_detail->drug_id)->first();


            if($curr_drug->amout < $curr_bill_detail->amout) {
                //$amounts[$i] = $curr_drug->amout;

                return ' มี (' . $curr_drug->amout . ') ' . $curr_drug->name . ' หมดค่ะ.';
            }

            DB::table('bill_details')->where('bill_id', $bill->id)->where('id', $ids[$i])->update(['amout' => $amounts[$i]]);
            $bDetail = DB::table('bill_details')->where('bill_id', $bill->id)->where('id', $ids[$i])->first();
            
        }

        
        $inserted = DB::table('bills')->where('id', $bill->id)->update(['sum' => $sum, 'staff' => $staff,'updated_at' => $this->curr_date_time]);

        // DB::table('bills')->where('id', Input::get('bill_id'))->update(['sum' => Input::get('grand_total') ]);
        // DB::table('bills')->insert(['sum' => 0, 'created_at' => $this->curr_date_time, 'updated_at' => $this->curr_date_time]);

        $bill_update = Bill::where('id', Input::get('bill_id'))->update(['sum' => Input::get('grand_total')]);
        $bill_new = Bill::create(['staff' => $staff, 'sum' => 0]);
        
        $drug_in_bill = DB::table('bill_details')->where('bill_id', $bill->id)->get();

        
        foreach ($drug_in_bill as $drug) {
            $drug_update = Stock::find($drug->drug_id);
            if($drug_update->amout < $drug->amout) {
                $drug_update->amout = 0;
            } else {
                $drug_update->amout = $drug_update->amout - $drug->amout;
            }
            $drug_update->save();
        }
        return 'true';
    }
    //ลบข้อมูลในหน้า shop หากมีการยกเลิกการขาย
    public function getClear() {
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        DB::table('bill_details')->where('bill_id', $bill->id)->delete();
        
        return Redirect::back();
    }
    
    //เพิ่มยา
    public function postShop() {
        
        $cat = Input::get('cat');
        $keyword = '%' . Input::get('keyword') . '%';
        $stocks = DB::table('stocks')->where($cat, 'like', $keyword)->paginate(25);
        
        //$stocks = stock::paginate(25);
        $stocks->setPath('stock');
        return View('adminPharmacy.a_cheerpost')->with(['stocks' => $stocks, 'keyword' => Input::get('keyword'), 'cat' => $cat]);
    }
    
    public function deleteQuestion($id) {
        
        $question = DB::table('bill_details')->where('id', $id)->delete();
        return Redirect::back();
    }

    //shopEm
    public function shopEm() {
        $bill = DB::table('bills')->orderBy('id', 'desc');
        if (!$bill->first()) {
            DB::table('bills')->insert(['sum' => 0, 'created_at' => $this->curr_date_time, 'updated_at' => $this->curr_date_time]);
            $bill = DB::table('bills')->orderBy('id', 'desc');
        }
        $bill->update(['updated_at' => $this->curr_date_time]);
        $bill = $bill->first();
        
        $bill_details = DB::table('bill_details')->where('bill_id', $bill->id)->get();
        
        $total = 0;
        $total_sale = 0;
        foreach ($bill_details as $i) {
            $total+= ($i->amout * ($i->price-$i->sale));
            $total_sale+= ($i->amout * $i->sale);
        }
        return View('EmployeePharmacy.e_cheer')->with('bill_details', $bill_details)->with('bill', $bill)->with('total', $total)->with('total_sale', $total_sale);
    }
    
    //เพิ่มยาในหน้าขาย
    public function addDrugEm($id) {
        
        //return $id;
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        $drug = DB::table('stocks')->where('id', $id)->first();
        $exist_drug = DB::table('bill_details')->where('bill_id', $bill->id)->where('drug_id', $drug->id);
        
        if ($exist_drug->count()) {
            $exist_drug->increment('amout');
        }
        else {
            
            DB::table('bill_details')
                ->insert(['bill_id' => $bill->id, 
                    'drug_id' => $drug->id, 
                    'code' => $drug->code, 
                    'name' => $drug->name, 
                    'type' => $drug->type, 
                    'size' => $drug->size, 
                    'amout' => 1, 
                    'price' => $drug->price, 
                    'sale' => $drug->sale,
                    'mfd' => $drug->mfd, 
                    'exp' => $drug->exp,
                    'created_at' => $this->curr_date,
                    'updated_at' => $this->curr_date]);
        }
        
        return Redirect::to('shopEm');
    }
    
    //เแสดงการอัฟเดตบิล
    public function postBillUpdateEm() {
        $ids = Input::get('id');
        $amounts = Input::get('amount');
        $sum = Input::get('sum');
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        
        for ($i = 0; $i < sizeof($ids); $i++) {
            DB::table('bill_details')->where('bill_id', $bill->id)->where('id', $ids[$i])->update(['amout' => $amounts[$i]]);
        }
        
        DB::table('bills')->where('id', $bill->id)->update(['sum' => $sum, 'updated_at' => $this->curr_date_time]);
        
        return 'true';
    }
    
    //เซฟบิล
    
    public function postBillSaveEm() {
        // return Input::all();
        $ids = Input::get('id');

        $amounts = Input::get('amount');
        $sum = Input::get('total');
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        $staff = Input::get('staff');

        if(!$ids) {
            return "bill is empty";
        }
        
        for ($i = 0; $i < sizeof($ids); $i++) {
            $curr_bill_detail = DB::table('bill_details')->where('id', $ids[$i])->first();
            //return var_dump($curr_bill_detail->drug_id);
            $curr_drug = DB::table('stocks')->where('id', $curr_bill_detail->drug_id)->first();


            if($curr_drug->amout < $curr_bill_detail->amout) {
                //$amounts[$i] = $curr_drug->amout;

                return ' มี (' . $curr_drug->amout . ') ' . $curr_drug->name . 'หมดค่ะ.';
            }

            DB::table('bill_details')->where('bill_id', $bill->id)->where('id', $ids[$i])->update(['amout' => $amounts[$i]]);
            $bDetail = DB::table('bill_details')->where('bill_id', $bill->id)->where('id', $ids[$i])->first();
            
        }

        
        $inserted = DB::table('bills')->where('id', $bill->id)->update(['sum' => $sum, 'staff' => $staff,'updated_at' => $this->curr_date_time]);

        // DB::table('bills')->where('id', Input::get('bill_id'))->update(['sum' => Input::get('grand_total') ]);
        // DB::table('bills')->insert(['sum' => 0, 'created_at' => $this->curr_date_time, 'updated_at' => $this->curr_date_time]);

        $bill_update = Bill::where('id', Input::get('bill_id'))->update(['sum' => Input::get('grand_total')]);
        $bill_new = Bill::create(['staff' => $staff, 'sum' => 0]);
        
        $drug_in_bill = DB::table('bill_details')->where('bill_id', $bill->id)->get();

        
        foreach ($drug_in_bill as $drug) {
            $drug_update = Stock::find($drug->drug_id);
            if($drug_update->amout < $drug->amout) {
                $drug_update->amout = 0;
            } else {
                $drug_update->amout = $drug_update->amout - $drug->amout;
            }
            $drug_update->save();
        }
        return 'true';
    }
    //ลบข้อมูลในหน้า shop หากมีการยกเลิกการขาย
    public function getClearEm() {
        $bill = DB::table('bills')->orderBy('id', 'desc')->first();
        DB::table('bill_details')->where('bill_id', $bill->id)->delete();
        
        return Redirect::back();
    }
    
    //เพิ่มยา
    public function postShopEm() {
        
        $cat = Input::get('cat');
        $keyword = '%' . Input::get('keyword') . '%';
        $stocks = DB::table('stocks')->where($cat, 'like', $keyword)->paginate(25);
        
        //$stocks = stock::paginate(25);
        $stocks->setPath('stock');
        return View('EmployeePharmacy.e_cheerpost')->with(['stocks' => $stocks, 'keyword' => Input::get('keyword'), 'cat' => $cat]);
    }
    
    public function deleteQuestionEm($id) {
        
        $question = DB::table('bill_details')->where('id', $id)->delete();
        return Redirect::back();
    }
   //endshopEm
    

    public function search(Request $request){
        $search = $request->get('search');
        $stocks = DB::table('stocks')->where('code', 'like', '%'.$search.'%')->orwhere('name', 'like', '%'.$search.'%')->orwhere('groups', 'like', '%'.$search.'%')->paginate(5);
        return view('stock', ['stocks' => $stocks]);
    }
    
    public function searchAd(Request $request){
        $search = $request->get('search');
        $stocks = DB::table('stocks')->where('code', 'like', '%'.$search.'%')->orwhere('name', 'like', '%'.$search.'%')->orwhere('groups', 'like', '%'.$search.'%')->paginate(5);
        return view('adminPharmacy.a_stock', ['stocks' => $stocks]);
    }

    public function searchEm(Request $request){
        $search = $request->get('search');
        $stocks = DB::table('stocks')->where('code', 'like', '%'.$search.'%')->orwhere('name', 'like', '%'.$search.'%')->orwhere('groups', 'like', '%'.$search.'%')->paginate(5);
        return view('EmployeePharmacy.e_stock', ['stocks' => $stocks]);
    }

    public function searchUs(Request $request){
        $search = $request->get('search');
        $stocks = DB::table('stocks')->where('code', 'like', '%'.$search.'%')->orwhere('name', 'like', '%'.$search.'%')->orwhere('groups', 'like', '%'.$search.'%')->paginate(5);
        return view('userPharmacy.u_stock', ['stocks' => $stocks]);
    }

    // public function searchReport(Request $request){
    //     $search = $request->get('search');
    //     $bill_details = DB::table('bill_details')->where('updated_at', 'like', '%'.$search.'%')->paginate(15);
    //     return view('adminPharmacy.a_report', ['bill_details' => $bill_details]);
    // }

    

    public function stockAd(){
    	$stocks = DB::table('stocks')->orderBy('name', 'asc')->paginate(10);
    	return view('adminPharmacy.a_stock', ['stocks' => $stocks]);
    }

    public function stockEm(){
        $stocks = DB::table('stocks')->paginate(10);
        return view('EmployeePharmacy.e_stock', ['stocks' => $stocks]);
    }

    public function stockUs(){
        $stocks = DB::table('stocks')->paginate(10);
        return view('userPharmacy.u_stock', ['stocks' => $stocks]);
    }

    public function stock(){
        $stocks = DB::table('stocks')->paginate(10);
        return view('stock', ['stocks' => $stocks]);
    }

    public function welcome(){
         $stocks = DB::table('bill_details')
                    ->selectRaw('*, sum(amout) as sum_amount, sum(price) as sum_price')
                    ->groupBy('name')
                    ->orderBy('sum_amount', 'desc')
                    ->orderBy('name')
                    ->paginate(8);
        return view('welcome', ['stocks' => $stocks]);
    }

    // public function pdfdrug(Request $request,$id){
    //         $stocks = Stock::findOrFail($id);
    //         $pdf = PDF::loadView('adminPharmacy.pdfdrug',['stocks' => $stocks]);
    //         return $pdf->stream('result.pdf', array('Attachment'=>0));   
    // }

    // public function pdfdrug()
    // {
    //     $stocks = Stock::all();
    //     $pdf = PDF::loadView('adminPharmacy.pdfdrug', ['stocks' => $stocks]);
    //     return $pdf->stream();
    // }

    // public function pdfdrugdown()
    // {
    //     $stocks = Stock::all();
    //     $pdf = PDF::loadView('adminPharmacy.pdfdrug', ['stocks' => $stocks]);
    //     return $pdf->download('reportdrug.pdf');
    // }

    public function add(Request $request){
    	$this->validate($request, [
            'code' => 'required',
    		'name' => 'required',
            'size' => 'required',
    		 'type' => 'required',
    		 'description' => 'required',
             'indication' => 'required',
             'groups' => 'required',
    		 'price' => 'required',
             'sale' => 'required',
    		 'amout' => 'required',
             'unit' => 'required',
             'mfd' => 'required',
             'exp' => 'required'
             // 'size_img' => 'required',
             // 'type_img' => 'required'
    	]);

    	$stocks = new Stock;
        $stocks->code = $request->input('code');
        $stocks->name = $request->input('name');
        $stocks->size = $request->input('size');
        $stocks->type = $request->input('type');
        $stocks->groups = $request->input('groups');
        $stocks->description = $request->input('description');
        $stocks->indication = $request->input('indication');
        $stocks->price = $request->input('price');
        $stocks->sale = $request->input('sale');
        $stocks->amout = $request->input('amout');
        $stocks->unit = $request->input('unit');
        $stocks->mfd = $request->input('mfd');
        $stocks->exp = $request->input('exp');
        $stocks->size_imgdrug = $request->input('size_imgdrug');
        $stocks->type_imgdrug = $request->input('type_imgdrug');
        if(Input::hasFile('image')){
            $stock=Input::file('image');
            $stock->move(public_path(). '/frontend/images/', $stock->getClientOriginalName());

            $stocks->name_imgdrug = $stock->getClientOriginalName();
            $stocks->size_imgdrug = $stock->getClientsize();
            $stocks->type_imgdrug = $stock->getClientMimeType();
        }
        $stocks->save();
        return redirect('/stockAd')->with('info', 'Stock Saved Successfully!');

    }


    public function update($id){
        $stocks = Stock::find($id);

        return view('adminPharmacy.a_updatestock', ['stocks' => $stocks]);
    }

    public function edit(Request $request, $id){
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'size' => 'required',
             'type' => 'required',
             'groups' => 'required',
             'description' => 'required',
             'indication' => 'required',
             'price' => 'required',
             'sale' => 'required',
             'amout' => 'required',
             'unit' => 'required',
             'mfd' => 'required',
             'exp' => 'required'
             // 'size_img' => 'required',
             // 'type_img' => 'required'
        ]);
        $data = array(
            'code' => $request->input('code'),
            'name_imgdrug' => $request->input('name_imgdrug'),
            'name' => $request->input('name'),
            'size' => $request->input('size'),
            'type' => $request->input('type'),
            'groups' => $request->input('groups'),
            'description' => $request->input('description'),
            'indication' => $request->input('indication'),
            'price' => $request->input('price'),
            'sale' => $request->input('sale'),
            'amout' => $request->input('amout'),
            'unit' => $request->input('unit'),
            'mfd' => $request->input('mfd'),
            'exp' => $request->input('exp'),
            'size_imgdrug' => $request->input('size_imgdrug'),
            'type_imgdrug' => $request->input('type_imgdrug'),

        );
         
        Stock::where('id', $id)->update($data);
        return redirect('/stockAd')->with('info', 'Stock Update Successfully!');
    }

    public function showAd($id){
        $stocks = Stock::findorfail($id);

        return view('adminPharmacy.a_showstock', ['stocks' => $stocks]);

    }

 
    public function delete($id){
        Stock::where('id', $id)
        ->delete();
        return redirect('/stockAd')->with('info', 'Stock Deleted Successfully!');
    }

    public function showUs($id){
        $stocks = Stock::find($id);

        return view('userPharmacy.u_showstock', ['stocks' => $stocks]);

    }

//em
    public function addEm(Request $request){
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'size' => 'required',
             'type' => 'required',
             'description' => 'required',
             'indication' => 'required',
             'groups' => 'required',
             'price' => 'required',
             'sale' => 'required',
             'amout' => 'required',
             'unit' => 'required',
             'mfd' => 'required',
             'exp' => 'required'
             // 'size_img' => 'required',
             // 'type_img' => 'required'
        ]);

        $stocks = new Stock;
        $stocks->code = $request->input('code');
        $stocks->name = $request->input('name');
        $stocks->type = $request->input('type');
        $stocks->size = $request->input('size');
        $stocks->groups = $request->input('groups');
        $stocks->description = $request->input('description');
        $stocks->indication = $request->input('indication');
        $stocks->price = $request->input('price');
        $stocks->sale = $request->input('sale');
        $stocks->amout = $request->input('amout');
        $stocks->unit = $request->input('unit');
        $stocks->mfd = $request->input('mfd');
        $stocks->exp = $request->input('exp');
        $stocks->size_imgdrug = $request->input('size_imgdrug');
        $stocks->type_imgdrug = $request->input('type_imgdrug');
        if(Input::hasFile('image')){
            $stock=Input::file('image');
            $stock->move(public_path(). '/frontend/images/', $stock->getClientOriginalName());

            $stocks->name_imgdrug = $stock->getClientOriginalName();
            $stocks->size_imgdrug = $stock->getClientsize();
            $stocks->type_imgdrug = $stock->getClientMimeType();
        }
        $stocks->save();
        return redirect('/stockEm')->with('info', 'Stock Saved Successfully!');

    }


    public function updateEm($id){
        $stocks = Stock::find($id);

        return view('EmployeePharmacy.e_updatestock', ['stocks' => $stocks]);
    }

    public function editEm(Request $request, $id){
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'size' => 'required',
             'type' => 'required',
             'groups' => 'required',
             'description' => 'required',
             'indication' => 'required',
             'price' => 'required',
             'sale' => 'required',
             'amout' => 'required',
             'unit' => 'required',
             'mfd' => 'required',
             'exp' => 'required'
             // 'size_img' => 'required',
             // 'type_img' => 'required'
        ]);
        $data = array(
            'code' => $request->input('code'),
            'name_imgdrug' => $request->input('name_imgdrug'),
            'name' => $request->input('name'),
            'size' => $request->input('size'),
            'type' => $request->input('type'),
            'groups' => $request->input('groups'),
            'description' => $request->input('description'),
            'indication' => $request->input('indication'),
            'price' => $request->input('price'),
            'sale' => $request->input('sale'),
            'amout' => $request->input('amout'),
            'unit' => $request->input('unit'),
            'mfd' => $request->input('mfd'),
            'exp' => $request->input('exp'),
            'size_imgdrug' => $request->input('size_imgdrug'),
            'type_imgdrug' => $request->input('type_imgdrug'),

        );
         
        Stock::where('id', $id)->update($data);
        return redirect('/stockEm')->with('info', 'Stock Update Successfully!');
    }

    public function showEm($id){
        $stocks = Stock::findorfail($id);

        return view('EmployeePharmacy.e_showstock', ['stocks' => $stocks]);

    }

 
    public function deleteEm($id){
        Stock::where('id', $id)
        ->delete();
        return redirect('/stockEm')->with('info', 'Stock Deleted Successfully!');
    }

    //end



    public function show($id){
        $stocks = Stock::find($id);

        return view('showstock', ['stocks' => $stocks]);

    }
}
