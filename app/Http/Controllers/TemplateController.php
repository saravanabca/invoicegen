<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\CustomerModel;
use App\Models\TemplateActiveModel;
use App\Models\InvoiceDraftsModel;
use App\Models\ClientModel;
use App\Models\UserModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF; // Make sure to import the PDF facade
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Stevebauman\Location\Facades\Location;
use View;
use Illuminate\Support\Str;



use App\Http\Controllers\Controller;

class TemplateController extends Controller
{




    
    public function template()
    {
      
      return view('user.template');
    }


   
// public function template_active(Request $request)
// {

//     $tempname = $request->input('temp_name');
   
//     // dd($tempname);
//     if (!is_array($tempname)) {
//       $tempname = [$tempname]; // Convert string to array
//   }

//     TemplateActiveModel::whereIn('template_name', $tempname)->update(['temp_active_status' => 1]);

//     return response()->json([
//       'status' => true,
//       'message' => 'Template Updated Successfully'
//   ]);

// }


public function template_active(Request $request)
{
    $tempname = $request->input('temp_name');
   
    // if (!is_array($tempname)) {
    //     $tempname = [$tempname]; // Convert string to array
    // }

    // Begin a transaction
    // DB::beginTransaction();

    try {
        // Set all temp_active_status to 0
        // TemplateActiveModel::query()->update(['temp_active_status' => 0]);

        // Set temp_active_status to 1 for the specified template names
        // TemplateActiveModel::whereIn('template_name', $tempname)->update(['temp_active_status' => 1]);
        User::where('email', auth()->user()->email)->update(['template_name' => $tempname]);

        // Commit the transaction
        // DB::commit();

        // $activeTemplate = TemplateActiveModel::where('temp_active_status', 1)->first();
        $activeTemplate = User::where('email', auth()->user()->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Selected template has been updated to the default template',
            'active_template' => $activeTemplate->template_name
        ]);
    } catch (\Exception $e) {
        // Rollback the transaction on error
        // DB::rollBack();
        
        // Log the error or handle it as needed
        return response()->json([
            'status' => false,
            'message' => 'Template Update Failed',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function getTemplateContent(Request $request)
    {
        $templateName = $request->input('template_name');

        // Define the view file for each template
        $views = [
            'temp_1' => 'user.templates.temp_1',
            'temp_2' => 'user.templates.temp_2',
            'temp_3' => 'user.templates.temp_3',
        ];

        // Check if the requested template exists
        if (!array_key_exists($templateName, $views)) {
            return response()->json(['content' => 'Error loading template'], 400);
        }

        // Render the template view
        $view = View::make($views[$templateName])->render();

        return response()->json(['content' => $view]);
    }

public function active_invoice()
{
   
    try {
       
        // $activeTemplate = TemplateActiveModel::where('temp_active_status', 1)->first();
        $activeTemplate = User::where('email', auth()->user()->email)->first();


        return response()->json([
            'status' => true,
            'active_template' => $activeTemplate->template_name
        ]);
    } catch (\Exception $e) {
        // Rollback the transaction on error
        // DB::rollBack();
        
        // Log the error or handle it as needed
        return response()->json([
            'status' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}

    
}