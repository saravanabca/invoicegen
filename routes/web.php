<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\UserController;
// use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;
// use Itnext\IonicLaravel\AppleLoginController;
// use App\Http\Controllers\WebController;
use App\Http\Controllers\GstinVerificationController;


Route::post('/verify-gstin', [GstinVerificationController::class, 'verify']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
/**Rendering Page **/




Auth::routes();
Route::group(['middleware' => 'guest'], function()
{


    Route::post('/signup_auth', 'LoginController@signup_auth');
    Route::post('/login_auth', 'LoginController@login_auth');
    Route::post('/otp_mail', 'LoginController@otp_mail');
    Route::post('/otp-send', 'LoginController@otpsend')->name('otp.send');
    Route::post('/forget_password', 'LoginController@forget_password');
    Route::post('otp_forget_send/{id}', 'LoginController@otp_forget_send');
    Route::post('change-password/{id}', 'LoginController@changepass')->name('change.pass');
    Route::post('signup_email_verify', 'LoginController@signup_email_verify');
    
      
    
    Route::get('auth/google', 'LoginController@redirectToGoogle');
    Route::get('auth/google/callback', 'LoginController@handleGoogleCallback');

    
}); 
Route::post('redering-page', 'RenderController@index');

Route::get('/', 'WebController@homepage')->name('home'); 
Route::get('features', 'WebController@features')->name('features'); 
Route::get('templates', 'WebController@templates')->name('templates'); 
Route::get('faq', 'WebController@faq')->name('faq'); 

Route::group(['middleware' => 'auth'], function()
{
    // Page:
    Route::get('invoice', 'InvoiceController@invoice')->name('invoice'); 
    Route::get('create_invoice_page', 'InvoiceController@create_invoice_page');

    Route::get('customer', 'CustomerController@customer')->name('customer'); 
    Route::get('invoice_add/{id}', 'InvoiceController@invoice_add');
    Route::get('edit_invoice/{id}', 'InvoiceController@edit_invoice');

    Route::get('setting', 'SettingController@setting');
    Route::get('template', 'TemplateController@template');
    Route::get('feedback', 'FeedbackController@feedback');
    Route::get('contact', 'FeedbackController@contact');





    // Request:

    //Invoice:
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::post('invoice_create', 'InvoiceController@invoice_create');
    Route::post('invoice_update', 'InvoiceController@invoice_update');
    Route::get('invoice_get', 'InvoiceController@invoice_get');
    Route::get('search_customers', 'InvoiceController@searchCustomers');
    Route::post('invoice_delete', 'InvoiceController@invoice_delete');
    Route::post('check_invoice_unique', 'InvoiceController@checkInvoiceUnique');

    Route::get('invoiceDateFilter', 'InvoiceController@invoiceDateFilter');


    // customer:
    Route::post('customer_add', 'CustomerController@customer_add');
    Route::get('customer_get', 'CustomerController@customer_get');
    Route::post('customer_update', 'CustomerController@customer_update');
    Route::post('customer_delete', 'CustomerController@customer_delete');
    Route::post('get_single_customer_invoice', 'CustomerController@get_single_customer_invoice');
    Route::get('check-company-table', 'CustomerController@checkCompanyTable');


    // template:
    Route::post('template_active', 'TemplateController@template_active');
    Route::get('active_invoice', 'TemplateController@active_invoice');
    Route::post('get_template_content', 'TemplateController@getTemplateContent');

    // Settings:

    // user-profile
    Route::get('user_profile', 'SettingController@user_profile');
    Route::post('user_profile_update', 'SettingController@user_profile_update');

    // signature:
    Route::post('signature_add', 'SettingController@signature_add');
    Route::get('signature_get', 'SettingController@signature_get');
    Route::post('signature_update', 'SettingController@signature_update');
    Route::post('signature_delete', 'SettingController@signature_delete');
    Route::post('signature_active', 'SettingController@signature_active');
    

    // Company details :
    Route::post('company_add', 'SettingController@company_add');
    Route::get('company_get', 'SettingController@company_get');
    Route::post('company_update', 'SettingController@company_update');
    Route::post('company_delete', 'SettingController@company_delete');
    Route::post('company_active', 'SettingController@company_active');
    Route::get('check_company_active', 'SettingController@check_company_active');
    Route::get('getCompanyGstin', 'SettingController@getCompanyGstin');
    Route::get('getCustomerGstin', 'SettingController@getCustomerGstin');
    
    // bank details:
    Route::get('getBankDetails', 'SettingController@getBankDetails');
    Route::post('bank_add', 'SettingController@bank_add');
    Route::get('bank_get', 'SettingController@bank_get');
    Route::post('bank_update', 'SettingController@bank_update');
    Route::post('bank_delete', 'SettingController@bank_delete');
    Route::post('bank_active', 'SettingController@bank_active');

    // notes:
    Route::post('notes_data_add', 'SettingController@notes_data_add');
    Route::get('notes_get', 'SettingController@notes_get');
    Route::post('notes_update', 'SettingController@notes_update');
    Route::post('notes_delete', 'SettingController@notes_delete');
    Route::post('notes_active', 'SettingController@notes_active');
    
    // terms:
    Route::post('terms_data_add', 'SettingController@terms_data_add');
    Route::get('terms_get', 'SettingController@terms_get');
    Route::post('terms_update', 'SettingController@terms_update');
    Route::post('terms_delete', 'SettingController@terms_delete');
    Route::post('terms_active', 'SettingController@terms_active');
    
});





