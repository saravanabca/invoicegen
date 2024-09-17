<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\CustomerModel;
use App\Models\CompanyModel;
use App\Models\InvoiceDraftsModel;
use App\Models\ClientModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use PDF; // Make sure to import the PDF facade
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Stevebauman\Location\Facades\Location;
use View;
use Illuminate\Support\Str;



use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    // public function dashboard()
    // {
    //     $invoicedetails = InvoiceModel::where('flag', 1)
    //     ->where('auth_mail', auth()->user()->email)
    //     ->get();
    //   return view('user.dashboard',compact('invoicedetails'));
      
    // }

    public function customer()
    {
      $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();
      if ($companyactive) {
        $customerdetails = CustomerModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();
    } else {
        // Handle the case where there is no active company
        $customerdetails = collect(); // or handle accordingly
    }

    if ($companyactive) {
        $invoicedetails = InvoiceModel::where('flag', 1)
            ->where('auth_mail', auth()->user()->email)
            ->where('company_id', $companyactive->id)
            ->get();
    } else {
        // Handle the case where there is no active company
        $invoicedetails = collect(); // or handle accordingly
    }

      return view('user.customer',compact('customerdetails','invoicedetails'));
    }

    public function customer_add(Request $request)
    {
        try{
        $customerData = $request->all();
        // Create a new instance of InvoiceModel
        $customer = new CustomerModel;
    
        // Set the properties from the request data
        $customer->fill($customerData); 

        $customer->auth_mail = auth()->user()->email;

        $activeCompanies = CompanyModel::where('company_active', 1)
        ->where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->pluck('id'); // Get an array of IDs
    
        $companyIdsString = $activeCompanies->implode(',');

        // Assign the string of IDs to the company_id field
        $customer->company_id = $companyIdsString;

        // dd($invoice);

        $customer->save();
       return response()->json([
          'status' =>'customer_add_success',
          'status_value' => true,
          'message' => 'Customer Created Successfuly'
      ]);
    }
      catch (Exception $e) {
        return response()->json([
            'status_value' => false,
            'message' => $e->getMessage()
        ]); // Custom status code for bad request
    }
       
    }


    public function customer_update(Request $request)
    {
        try{

          $customer_id = $request->input('customer_id');

          // Find the customer by ID
          $customer = CustomerModel::find($customer_id);
          if ($customer) {
            $customer->update($request->all());

            $customer->auth_mail = auth()->user()->email;
    
    
            $customer->save();
            
            return response()->json([
              'status' => 'customer_update_success',
              'status_value' => true,
              'message' => 'Customer Updated Successfully'
          ]);
          }
          else{
            return response()->json([
              'status' => 'customer_update_fail',
              'status_value' => false,
              'message' => 'Customer Not Found'
          ]);
          }
      



    }
    catch (Exception $e) {
      return response()->json([
          'status' => 'customer_update_fail',
          'status_value' => false,
          'message' => $e->getMessage()
      ]);
  }
       
    }

    public function customer_get()
    {
      $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();

        $customerdetails = CustomerModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->withCount('invoices')
        ->orderBy('id', 'desc')
        ->get();
        
        // dd($customerdetails);
    // Return the view with billing details
        return response()->json(['customerdetails' => $customerdetails]);
    }

    public function customer_delete(Request $request)
{
    $id = $request->input('selectedId');
    // dd($id);
    if (!is_array($id)) {
      $id = [$id]; // Convert string to array
  }

    // Delete records with IDs in $ids array
    // CustomerModel::whereIn('id', $id)->delete();
    CustomerModel::whereIn('id', $id)->update(['flag' => 0]);

    return response()->json([
      'status' => true,
      'message' => 'Customer Deleted Successfully'
  ]);

}

public function customer_invoice_add(Request $request)
    {
       
      $id = $request->input('customer_id');
      // dd($id);

        $customerdetails = CustomerModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('id',$id)
        ->get();
        // dd($invoicedetails);
    // Return the view with billing details
        return response()->json(['customerdetails' => $customerdetails]);
    } 



    public function get_single_customer_invoice(Request $request)
    {
      $customer_id = $request->input('customer_id');
      // dd($customer_id);

      $companyactive = CompanyModel::where('flag', 1)
      ->where('company_active', 1)
      ->where('auth_mail', auth()->user()->email)
      ->first();
  
      $customer = CustomerModel::where('flag', 1)
      ->where('auth_mail', auth()->user()->email)
      ->first();

      $customername = CustomerModel::select('customer_name')->where('flag', 1)
      ->where('auth_mail', auth()->user()->email)
      ->where('id',$customer_id)
      ->get();

      // dd($customername);

      if ($companyactive) {

        $custominvoicedetails = InvoiceModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('customer_id',$customer_id)
        ->where('company_id', $companyactive->id)
        ->with(['company', 'customer']) 
        ->get();

      } else {
        $custominvoicedetails = collect(); // Empty collection if no active company found
    }
    //  dd($custominvoicedetails);
        return response()->json(['custominvoicedetails' => $custominvoicedetails,'customername'=> $customername]);
    }



    public function checkCompanyTable()
{
    // Assuming you have a Company model to interact with your company table
    $companies = CompanyModel::where('auth_mail', auth()->user()->email)->where('flag', 1)->get();

    if ($companies->isEmpty()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Add a company to create an invoice'
        ]);
    } else {
        return response()->json([
            'status' => 'success',
            'message' => 'Company table is not empty.'
        ]);
    }
}

    
}