<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\CustomerModel;
use App\Models\InvoiceDraftsModel;
use App\Models\ClientModel;
use App\Models\CompanyModel;
use App\Models\SignatureModel;
use App\Models\NotesModel;
use App\Models\TermsModel;
use App\Models\BankDetail;
use App\Models\UserModel;
use App\Models\TemplateActiveModel;
use Illuminate\Support\Facades\Auth;
use PDF; // Make sure to import the PDF facade
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Stevebauman\Location\Facades\Location;
use View;
use Illuminate\Support\Str;



use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{

    public function invoice()
    {

        $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();

        if ($companyactive) {
            $invoicedetails = InvoiceModel::where('flag', 1)
                ->where('auth_mail', auth()->user()->email)
                ->where('company_id', $companyactive->id)
                ->get();
        } else {
            // Handle the case where there is no active company
            $invoicedetails = collect(); // or handle accordingly
        }
        return view('user.invoice',compact('invoicedetails'));
      
    }

    public function create_invoice_page()
    {
        $invoice_page = true;

        $companyactive = CompanyModel::where('flag', 1)
        ->where('company_active', 1)
        ->where('auth_mail', auth()->user()->email)
        ->first();

        $latestInvoice = InvoiceModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->orderBy('invoice_number', 'desc')
        ->select('invoice_number')
        ->first();

        $getsignature = SignatureModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeSignature = $getsignature->where('signature_active', 1)->first();

        $getnotes = NotesModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeNotes = $getnotes->where('notes_active', 1)->first();

        
        $getterms = TermsModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeTerms = $getterms->where('terms_active', 1)->first();



        $getbank = BankDetail::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->orWhereNull('auth_mail')
        ->get();

        $activeBank = $getbank->where('bank_active', 1)->first();

        // Determine the new invoice number
        $invoice_number = $latestInvoice ? $latestInvoice->invoice_number + 1 : 1;

        return view('user.create_invoice',compact('invoice_page','invoice_number','getsignature','activeSignature','activeNotes','getnotes','activeTerms','getterms','getbank','activeBank'));

    }


    public function invoice_add($id)
    {
        $invoice_page = false;

        $customerdetails = CustomerModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('id',$id)
        ->first();


        $companyactive = CompanyModel::where('flag', 1)
        ->where('company_active', 1)
        ->where('auth_mail', auth()->user()->email)
        ->first();

        $latestInvoice = InvoiceModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->orderBy('invoice_number', 'desc')
        ->select('invoice_number')
        ->first();


        $getsignature = SignatureModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeSignature = $getsignature->where('signature_active', 1)->first();

        $getnotes = NotesModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeNotes = $getnotes->where('notes_active', 1)->first();

        
        $getterms = TermsModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeTerms = $getterms->where('terms_active', 1)->first();



        $getbank = BankDetail::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->orWhereNull('auth_mail')
        ->get();

        $activeBank = $getbank->where('bank_active', 1)->first();


    // Determine the new invoice number
      $invoice_number = $latestInvoice ? $latestInvoice->invoice_number + 1 : 1;

       return view('user.create_invoice',compact('customerdetails','invoice_page','invoice_number','getsignature','activeSignature','activeNotes','getnotes','activeTerms','getterms','getbank','activeBank'));
    }

    public function edit_invoice($id)
    {
        $invoice_page = false;

        $companyactive = CompanyModel::where('flag', 1)
        ->where('company_active', 1)
        ->where('auth_mail', auth()->user()->email)
        ->first();

        $getsignature = SignatureModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeSignature = $getsignature->where('signature_active', 1)->first();

        $getnotes = NotesModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeNotes = $getnotes->where('notes_active', 1)->first();

        
        $getterms = TermsModel::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->get();

        $activeTerms = $getterms->where('terms_active', 1)->first();



        $getbank = BankDetail::where('flag',1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->orWhereNull('auth_mail')
        ->get();

        $activeBank = $getbank->where('bank_active', 1)->first();

        $invoicedetails = InvoiceModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('id',$id)
        ->first();
        
      return view('user.edit_invoice',compact('invoicedetails','invoice_page','getsignature','activeSignature','activeNotes','getnotes','activeTerms','getterms','getbank','activeBank'));
    }

    public function checkInvoiceUnique(Request $request)
    {
        $invoice_number = $request->input('invoice_number');

        $companyactive = CompanyModel::where('flag', 1)
        ->where('company_active', 1)
        ->where('auth_mail', auth()->user()->email)
        ->first();
        // Query to check if the invoice number exists
        $exists = InvoiceModel::where('invoice_number', $invoice_number)->where('auth_mail', auth()->user()->email)->where('company_id', $companyactive->id)->where('flag', 1)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function invoice_create(Request $request)
    {
        try{


            $invoiceData = $request->all();
            $invoice = new InvoiceModel;
        
            $invoice->fill($invoiceData);
        
            // Set the auth_mail property to the authenticated user's email
            $invoice->auth_mail = auth()->user()->email;
            // dd($invoice);
            
            $activeCompanies = CompanyModel::where('company_active', 1)
            ->where('flag', 1)
            ->where('auth_mail', auth()->user()->email)
            ->pluck('id'); // Get an array of IDs
        
            $companyIdsString = $activeCompanies->implode(',');

            // Assign the string of IDs to the company_id field
            $invoice->company_id = $companyIdsString;

            // dd($invoice);


            // Dump and die to inspect the $invoice object

        $invoice->save();
       return response()->json([
          'success' => true,
          'message' => 'Invoice Created Successfuly'
      ]);
    }
      catch (Exception $e) {
        return response()->json([
            // 'success' => false,
            'message' => $e->getMessage()
        ]); // Custom status code for bad request
    }
       
    }


    public function invoice_update(Request $request)
    {
        try{


            $invoiceId = $request->input('invoice_id');
            // dd($invoiceid);
            // InvoiceModel::whereIn('id', $invoiceid)->update();


            $invoice_number = $request->input('invoice_number');

            $companyactive = CompanyModel::where('flag', 1)
                ->where('company_active', 1)
                ->where('auth_mail', auth()->user()->email)
                ->first();
    
            if (!$companyactive) {
                return response()->json(['success' => false, 'message' => 'Active company not found.'], 404);
            }
    
            $invoiceExists = InvoiceModel::where('invoice_number', $invoice_number)
                ->where('auth_mail', auth()->user()->email)
                ->where('company_id', $companyactive->id)
                ->where('flag', 1)
                ->where('id', '!=', $invoiceId) // Exclude current invoice from check
                ->exists();
    
            if ($invoiceExists) {
                return response()->json(['success' => false,'message' => 'Invoice number already exists.']);
            }

            $invoice = InvoiceModel::find($invoiceId);

            if (!$invoice) {
                return response()->json(['success' => false, 'message' => 'Invoice not found.'], 404);
            }
    
            // Fill the invoice with new data
            $invoice->fill($request->except(['invoice_id'])); // Exclude 'invoice_id' from fill
    
            // Save the updated invoice
            $invoice->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Invoice Updated Successfully'
            ]);

       return response()->json([
          'success' => true,
          'message' => 'Invoice Updated Successfuly'
      ]);
    }
      catch (Exception $e) {
        return response()->json([
            // 'success' => false,
            'message' => $e->getMessage()
        ]); // Custom status code for bad request
    }
       
    }

    
 public function invoice_get()
{
    $companyactive = CompanyModel::where('flag', 1)
    ->where('company_active', 1)
    ->where('auth_mail', auth()->user()->email)
    ->first();

    $customer = CustomerModel::where('flag', 1)
    ->where('auth_mail', auth()->user()->email)
    ->first();

if ($companyactive) {
    $invoicedetails = InvoiceModel::where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->where('company_id', $companyactive->id)
        ->with(['company', 'customer']) 
        ->get();
} else {
    $invoicedetails = collect(); // Empty collection if no active company found
}
// dd($invoicedetails);

return response()->json([
    'invoicedetails' => $invoicedetails
]);

}


public function invoice_delete(Request $request)
{
    $id = $request->input('selectedId');
    // dd($id);
    if (!is_array($id)) {
      $id = [$id]; // Convert string to array
  }
    // dd($id);

    // Delete records with IDs in $ids array
    // InvoiceModel::whereIn('id', $id)->delete();
    
    // Soft delete :

    InvoiceModel::whereIn('id', $id)->update(['flag' => 0]);

    return response()->json([
      'status' => true,
      'message' => 'Invoice Deleted Successfully'
  ]);

}


public function searchCustomers(Request $request)
    {
        $searchTerm = $request->input('search');

        $companyactive = CompanyModel::where('flag', 1)
        ->where('company_active', 1)
        ->where('auth_mail', auth()->user()->email)
        ->first();

        if ($searchTerm) {
            $customers = CustomerModel::where('customer_name', 'like', '%'.$searchTerm.'%')
                ->where('auth_mail', auth()->user()->email)
                ->where('company_id', $companyactive->id)
                ->where('flag', 1)
                ->select('customer_name', 'id')
                ->get();
        } else {
            $customers = CustomerModel::select('customer_name', 'id')
                ->where('auth_mail', auth()->user()->email)
                ->where('flag', 1)
                ->where('company_id', $companyactive->id)
                ->get(); // Fetch all customers if no search term
        }
    
        return response()->json($customers);
    }
  

    public function invoiceDateFilter(Request $request)
    {
        $rangedate = $request->input('daterange_By');
        // dd($rangedate);
        if (!empty($rangedate)) {
            $date_Arr = explode(' - ', $rangedate);
            $startDate = date("Y-m-d", strtotime($date_Arr[0])) . ' 00:00:00';
            $endDate = date("Y-m-d", strtotime($date_Arr[1])) . ' 23:59:59';
        } else {
            $startDate = \Carbon\Carbon::now()->subDays(60)->format('Y-m-d H:i:s');
            $endDate = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        }
    
        $query = InvoiceModel::query()
            ->where('flag', 1)
            ->where('auth_mail', auth()->user()->email)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate])
                    ->orWhereBetween('updated_at', [$startDate, $endDate]);
            });
    
    
        $user = $query->get();
        // dd($user);
        // return the results or process them as needed
        return response()->json($user);
    }
    

}