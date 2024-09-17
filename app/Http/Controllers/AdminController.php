<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClientModel;
use App\Models\TemplateModel;
use App\Models\InvoiceModel;
use App\Models\InvoiceDraftsModel;
use App\Models\User;
use Illuminate\Support\Facades\File;


use DataTables;




class AdminController extends Controller
{
    public function dashboard()
{
    $userdcount = User::count();
    $Invoicecount = InvoiceModel::where('flag', 1)->count();
    $InvoiceDraftscount = InvoiceDraftsModel::where('flag', 1)->count();
    $Clientscount = ClientModel::where('flag', 1)->count();
    $Templatescount = TemplateModel::where('flag', 1)->count();
    
    return view('admin.admin_dashboard',compact('userdcount','Invoicecount','InvoiceDraftscount','Clientscount','Templatescount'));
}

// users:

public function user_list()
{
     return view('admin.user_list');
}


function user_list_get(Request $request)
{


    
    $userdetails = User::get();

    return response()->json(['userdetails' => $userdetails]);
  
}


public function admin_invoice_list()
{
     return view('admin.admin_invoice_list');
}



function invoice_list_get(Request $request)
{

    $invoicedetails = InvoiceModel::where('flag', 1)->get();

    return response()->json(['invoicedetails' => $invoicedetails]);
  
}



public function admin_invoiceDrafts_list()
{
     return view('admin.admin_invoiceDrafts_list');
}



function invoiceDrafts_list_get(Request $request)
{

    $invoicedetails = InvoiceDraftsModel::where('flag', 1)->get();

    return response()->json(['invoicedetails' => $invoicedetails]);
  
}


public function admin_clients_list()
{
     return view('admin.admin_clients_list');
}



function clients_list_get(Request $request)
{

    $clientdetails = ClientModel::where('flag', 1)->get();
    return response()->json(['clientdetails' => $clientdetails]);
  
}



// templates:
public function admin_template()
{
     return view('admin.admin_template');
}

public function admin_temp_addpage()
{
     return view('admin.admin_temp_addpage');
}

function admin_template_get(Request $request)
{

    $templatedata = TemplateModel::where('flag', 1)->get();
    return response()->json(['templatedata' => $templatedata]);
  
}




function admin_template_add(Request $request)
{
    try {
        $image_url = $request->input('image_url');
        $image_urls = $request->input('image_urls');
        $template_name = $request->input('template_name');
        dd($image_url);
        $images = $request->input('images');

        $template = TemplateModel::create($request->all());

        foreach ($images as $image) {
            // Decode the image data
            $imageData = file_get_contents($image);
            $imageName = time() . '_' . basename($image);
            $path = public_path('images/' . $imageName);

            // Save the image to the public path
            file_put_contents($path, $imageData);

            // Store the image path in the database
            Image::create([
                'path' => 'images/' . $imageName
            ]);
        }
        // Check if a client with the same billing email already exists
        // dd($client);
        $template->save();

        return response()->json([
            'success' => true,
            'message' => 'Template added successfully'
        ]);


    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500); // Internal Server Error
    }
  
}


public function admin_template_update(Request $request) {
    try {
        // Retrieve invoice ID from the request
        $user_id = $request->input('user_id');
        // dd($user_id);
        // Find the existing invoice by ID
        $template = TemplateModel::where('id', $user_id)->where('flag', 1)->first();
      
        // If the invoice is not found, return an error
        if (!$template) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice not found or inactive'
            ]);
        }

        // Update the invoice with the request data
       $updatedRows = $template->update($request->except('id'));

       if ($request->hasFile('image_url')) {
        $image = $request->file('image_url');
        $originalFileName = $image->getClientOriginalName();
    
        // Replace empty spaces with underscores in the filename
        $newFileName = time() . '_' . str_replace(' ', '_', $originalFileName);
    
        // Move the uploaded image to the desired directory
        $image->move(public_path('/uploads/template_image/'), $newFileName);
          // dd($image);
    
        // Assign the file path to the food_image attribute
        $template->image_url = '/uploads/template_image/' . $newFileName;
        $template->save();

    }  

        // Handle logo image upload...
        // Handle signature image upload...
        if ($updatedRows == 1) {
            return response()->json([    
                'success' => true,
                'message' => 'Client Updated Successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Client Updated not Successfully'
            ]);
        }

     
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]); // Custom status code for bad request
    }
}

public function admin_template_delete(Request $request)
{
    $id = $request->input('user_id');
    $user_id = [$id]; 
    $imageUrls  = TemplateModel::whereIn('id', $user_id)->pluck('image_url');
    // dd($templates);
    foreach ($imageUrls as $imageUrl) {
        // Check if the template has an existing image and if the file exists
        if (!empty($imageUrl) && File::exists(public_path($imageUrl))) {
            // Delete the existing image file
            File::delete(public_path($imageUrl));
        }
    }

    TemplateModel::whereIn('id', $user_id)->update(['flag' => 0]);

    return response()->json(['success' => true]);
}

}