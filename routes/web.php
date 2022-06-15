<?php
use Illuminate\Support\Facades\Input as input;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'CreatesController@welcome'); 


Route::get('/about', function () {
    return view('about');
});

Route::get('/promotion', function () {
    return view('promotion');
});

// Route::get('/stock', function () {
//     return view('stock');
// });

Route::get('/stock', 'CreatesController@stock'); 
Route::get('stock/show/{id}', 'CreatesController@show');


//shopAd
Route::get('/shop', 'CreatesController@shop');
Route::post('billupdate', 'CreatesController@postBillUpdate');
Route::post('billsave', 'CreatesController@postBillSave');
Route::get('bill/clear', 'CreatesController@getClear');
Route::get('shop/delete/{id}', 'CreatesController@deleteQuestion');


Route::post('shop', 'Createscontroller@postShop');
Route::get('adddrug/{id}', 'Createscontroller@addDrug');
//end

//shopEm
Route::get('/shopEm', 'CreatesController@shopEm');
Route::post('billupdateEm', 'CreatesController@postBillUpdateEm');
Route::post('billsaveEm', 'CreatesController@postBillSaveEm');
Route::get('billEm/clear', 'CreatesController@getClearEm');
Route::get('shopEm/delete/{id}', 'CreatesController@deleteQuestionEm');


Route::post('shopEm', 'Createscontroller@postShopEm');
Route::get('adddrugEm/{id}', 'Createscontroller@addDrugEm');
//end


Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/homeUs', 'HomeController@index');
Route::get('/aboutUs', 'HomeController@indexaboutU');
Route::get('/profileUs', 'HomeController@indexprofileU');
Route::get('/promotionUs', 'HomeController@indexpromotionU');
Route::get('/stockUs', 'CreatesController@stockUs');
Route::get('stockUs/show/{id}', 'CreatesController@showUs');


Route::get('/homeAd', 'AdminController@index')->name('admin.dashboard'); 
Route::get('/aboutAd', 'AdminController@indexaboutAd');
Route::get('/addpromotionAd', 'AdminController@indexaddpromotionAd');

Route::get('/adduserAd', 'AdminController@indexadduserAd');
Route::get('/addadminAd', 'AdminController@indexaddadminAd');
Route::get('/addemployAd', 'AdminController@indexaddemployAd');
Route::get('/addstockAd', 'AdminController@indexaddstockAd');
Route::get('/profileAd', 'AdminController@indexprofileAd');
Route::get('/promotionAd', 'AdminController@promotionAd');
Route::get('/promotionUs', 'AdminController@promotionUs');
Route::get('/promotionEm', 'AdminController@promotionEm');


// Route::get('/reportAd', 'AdminController@indexreportAd');



Route::get('/stockAd', 'CreatesController@stockAd'); 
Route::post('addstockAd/insert', 'CreatesController@add');
Route::get('stockAd/update/{id}', 'CreatesController@update');
Route::post('stockAd/edit/{id}', 'CreatesController@edit');
Route::get('stockAd/show/{id}', 'CreatesController@showAd');
Route::get('stockAd/delete/{id}', 'CreatesController@delete');

Route::get('/stockAdreport/pdfdrug', 'CreatesController@pdfdrug');
Route::get('/stockAdreport/pdfdrugdown', 'CreatesController@pdfdrugdown');


Route::post('addpromotionAd/insert', 'AdminController@addpromotion');
Route::get('promotionAd/delete/{id}', 'AdminController@deletepromotion');

Route::post('addpromotionEm/insert', 'EmployeeController@addpromotion');
Route::get('promotionEm/delete/{id}', 'EmployeeController@deletepromotion');

// Route::post('addadminAd/insert', 'AdminController@addAdmin'); 
// Route::get('adminAd/update/{id}', 'AdminController@updateAdmin'); 
// Route::post('adminAd/edit/{id}', 'AdminController@editAdmin'); 
// Route::get('/adminAd/show/{id}', 'AdminController@showAdmin'); 
// Route::get('adminAd/delete/{id}', 'AdminController@deleteAdmin'); 

Route::get('/adminAd', 'AdminController@adminAd');
Route::get('/employAd', 'AdminController@employAd');
// Route::post('addemployAd/insert', 'AdminController@addEmploy'); 
// Route::get('employAd/update/{id}', 'AdminController@updateEmploy'); 
// Route::post('employAd/edit/{id}', 'AdminController@editEmploy'); 
// Route::get('/employAd/show/{id}', 'AdminController@showEmploy'); 
// Route::get('employAd/delete/{id}', 'AdminController@deleteEmploy'); 






Route::post('adduserAd/insert', 'AdminController@addUser'); 
Route::get('userAd/update/{id}', 'AdminController@updateUser'); 
Route::post('userAd/edit/{id}', 'AdminController@editUser'); 
Route::get('/userAd/show/{id}', 'AdminController@showUser'); 
Route::get('userAd/delete/{id}', 'AdminController@deleteUser'); 

Route::get('/userAd', 'AdminController@userAd');



//employee
Route::get('/homeEm', 'EmployeeController@index')->name('employee.dashboard'); 
Route::get('/aboutEm', 'EmployeeController@indexaboutEm');
Route::get('/addpromotionEm', 'EmployeeController@indexaddpromotionEm');
Route::get('/adduserEm', 'EmployeeController@indexadduserEm');
Route::get('/addstockEm', 'EmployeeController@indexaddstockEm');
Route::get('/profileEm', 'EmployeeController@indexprofileEm');
Route::get('/promotionEm', 'EmployeeController@promotionEm');
Route::get('/stockEm', 'CreatesController@stockEm'); 
Route::post('addstockEm/insert', 'CreatesController@addEm');
Route::get('stockEm/update/{id}', 'CreatesController@updateEm');
Route::post('stockEm/edit/{id}', 'CreatesController@editEm');
Route::get('stockEm/show/{id}', 'CreatesController@showEm');
Route::get('stockEm/delete/{id}', 'CreatesController@deleteEm');


Route::post('adduserEm/insert', 'EmployeeController@addUserEm'); 
Route::get('userEm/update/{id}', 'EmployeeController@updateUserEm'); 
Route::post('userEm/edit/{id}', 'EmployeeController@editUserEm'); 
Route::get('/userEm/show/{id}', 'EmployeeController@showUserEm'); 
Route::get('userEm/delete/{id}', 'EmployeeController@deleteUserEm'); 

Route::get('/userEm', 'EmployeeController@userEm');
Route::get('/employEm', 'EmployeeController@employEm');


//end

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){   
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

// Password reset routes
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});


Route::prefix('employee')->group(function(){   
Route::get('/login', 'Auth\EmployeeLoginController@showLoginFormEm')->name('employee.login');
Route::post('/login', 'Auth\EmployeeLoginController@loginEmployee')->name('employee.login.submit');

Route::get('/logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');

// Password reset routes
  Route::post('/password/email', 'Auth\EmployeeForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
  Route::get('/password/reset', 'Auth\EmployeeForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
  Route::post('/password/reset', 'Auth\EmployeeResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\EmployeeResetPasswordController@showResetForm')->name('employee.password.reset');
});
 
Route::get('/searchAd','CreatesController@searchAd');
Route::get('/searchEm','CreatesController@searchEm');
Route::get('/searchUs','CreatesController@searchUs');
Route::get('/search','CreatesController@search');


Route::get('/changepassAd', function(){
  return view('adminPharmacy.a_changepass');
});

Route::post('change/passwordad', function(){
  $User = User::find(Auth::user()->id);
  if(Hash::check(Input::get('passwordold'), $User['password']) && Input::get('password') == Input::get('password_confirmation')){
    $User->password = bcrypt(Input::get('password'));
    $User->save();
    return back()->with('success', 'Password Change!!');
  }
  else{
    return back()->with('error', 'Password Not Change!!');

    # code...
  }
});

Route::get('/changepassEm', function(){
  return view('EmployeePharmacy.e_changepass');
});

Route::post('change/passwordem', function(){
  $User = User::find(Auth::user()->id);
  if(Hash::check(Input::get('passwordold'), $User['password']) && Input::get('password') == Input::get('password_confirmation')){
    $User->password = bcrypt(Input::get('password'));
    $User->save();
    return back()->with('success', 'Password Change!!');
  }
  else{
    return back()->with('error', 'Password Not Change!!');

    # code...
  }
});

Route::get('/changepassUs', function(){
  return view('userPharmacy.u_changepass');
});

Route::post('change/passwordus', function(){
  $User = User::find(Auth::user()->id);
  if(Hash::check(Input::get('passwordold'), $User['password']) && Input::get('password') == Input::get('password_confirmation')){
    $User->password = bcrypt(Input::get('password'));
    $User->save();
    return back()->with('success', 'Password Change!!');
  }
  else{
    return back()->with('error', 'Password Not Change!!');

    # code...
  }
});

Route::get('expAd', 'AdminController@exp');
Route::get('outAd', 'AdminController@out');

Route::get('expEm', 'AdminController@expem');
Route::get('outEm', 'AdminController@outem');
// Route::get('stockAdreport/pdfdrug', 'CreatesController@pdfdrug');

Route::get('topdrug', 'Admincontroller@topdrug');
Route::get('topstaff', 'Admincontroller@topstaff');
Route::post('/topdrug2','AdminController@topdrug2');
Route::post('/topstaff2','AdminController@topstaff2');

Route::get('reportAd', 'Admincontroller@reportAd');
Route::post('/reportAd2','AdminController@reportAd2');

Route::post('/reportAdpdf', 'AdminController@reportAdpdf');
