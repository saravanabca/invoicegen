<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\CompanyModel;
use App\Models\InvoiceDraftsModel;
use App\Models\ClientModel;
use App\Models\UserModel;
use App\Models\NotesModel;
use App\Models\TermsModel;
use App\Models\BankDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF; // Make sure to import the PDF facade
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Stevebauman\Location\Facades\Location;
use View;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Models\SignatureModel;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\Controller;

class SettingController extends Controller
{


    public function setting()
    {

        $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();

        if ($companyactive) {
            $companydetails = CompanyModel::where('flag', 1)
                ->where('auth_mail', auth()->user()->email)
                ->get();
        } else {
            // Handle the case where there is no active company
            $companydetails = collect(); // or handle accordingly
        }


        if ($companyactive) {
            $signaturedetails = SignatureModel::where('flag', 1)
                ->where('auth_mail', auth()->user()->email)
                ->where('company_id', $companyactive->id)
                ->get();
        } else {
            // Handle the case where there is no active company
            $signaturedetails = collect(); // or handle accordingly
        }


        if ($companyactive) {
            $notesdetails = NotesModel::where('flag', 1)
                ->where('auth_mail', auth()->user()->email)
                ->where('company_id', $companyactive->id)
                ->get();
        } else {
            // Handle the case where there is no active company
            $notesdetails = collect(); // or handle accordingly
        }
    
        if ($companyactive) {
            $termsdetails = TermsModel::where('flag', 1)
                ->where('auth_mail', auth()->user()->email)
                ->where('company_id', $companyactive->id)
                ->get();
        } else {
            // Handle the case where there is no active company
            $termsdetails = collect(); // or handle accordingly
        }

       
        
      
      return view('user.settings',compact('signaturedetails','companydetails','notesdetails','termsdetails'));
    }

    public function user_profile()
{
    $userdetails = User::where('flag', 1)
    ->where('email', auth()->user()->email)
    ->get();
    // dd($invoicedetails);
// Return the view with billing details
    return response()->json(['userdetails' => $userdetails]);
}

public function user_profile_update(Request $request)
{
    try{


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // other fields...
        ]);
    
        if (!is_array($validatedData)) {
            // Convert to array if needed
            $validatedData = (array)$validatedData;
        }
  
        $user = auth()->user();
    
        if ($user) {

            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $originalFileName = $image->getClientOriginalName();
            
                // Replace empty spaces with underscores in the filename
                $newFileName = time() . '_' . str_replace(' ', '_', $originalFileName);
                // dd($newFileName);
            
                // Move the uploaded image to the desired directory
                $image->move(public_path('uploads/avatar/'), $newFileName);
                  // dd($image);
            
                // Assign the file path to the food_image attribute
                $user->avatar = 'uploads/avatar/' . $newFileName;
          
            }
            
            $user->update($validatedData);
        }
    

   return response()->json([
      'success' => true,
      'message' => 'User Updated Successfuly'
  ]);
}
  catch (Exception $e) {
    return response()->json([
        // 'success' => false,
        'message' => $e->getMessage()
    ]); // Custom status code for bad request
}
   
}
    



// company details:
public function company_add(Request $request)
{
    try{

      
      $companyData = $request->all();

      $company = new CompanyModel;
  
      $company->fill($companyData); 
  
     $company->auth_mail = auth()->user()->email;

      if ($request->hasFile('company_logo')) {
        $image = $request->file('company_logo');
        $originalFileName = $image->getClientOriginalName();
    
        // Replace empty spaces with underscores in the filename
        $newFileName = time() . '_' . str_replace(' ', '_', $originalFileName);
        // dd($newFileName);
    
        // Move the uploaded image to the desired directory
        $image->move(public_path('uploads/company_logo/'), $newFileName);
          // dd($image);
    
        // Assign the file path to the food_image attribute
        $company->company_logo = 'uploads/company_logo/' . $newFileName;
  
    }

      
    $existingActiveCompanyCount = CompanyModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->count();

    // If no existing active terms, set the new term as active
    if ($existingActiveCompanyCount == 0) {
        $company->company_active = 1;
    } else {
        $company->company_active = 0; // Ensure the new term is inactive if there are already active terms
    }


    $company->save();

   return response()->json([
      'status' =>'company_add_success',
      'status_value' => true,
      'message' => 'company Created Successfuly'
  ]);
}
  catch (Exception $e) {
    return response()->json([
        'status_value' => false,
        'message' => $e->getMessage()
    ]); // Custom status code for bad request
}
   
}


public function company_update(Request $request)
{
    try{
      $company_id = $request->input('company_id');
        // dd($company_id);
      // Find the company by ID
      $company = CompanyModel::find($company_id);
      if ($company) {
        $company->update($request->all());

        $company->auth_mail = auth()->user()->email;
        
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $originalFileName = $image->getClientOriginalName();
        
            // Replace empty spaces with underscores in the filename
            $newFileName = time() . '_' . str_replace(' ', '_', $originalFileName);
            // dd($newFileName);
        
            // Move the uploaded image to the desired directory
            $image->move(public_path('uploads/company_logo/'), $newFileName);
              // dd($image);
        
            // Assign the file path to the food_image attribute
            $company->company_logo = 'uploads/company_logo/' . $newFileName;
      
        }
        $company->save();

        return response()->json([
          'status' => 'company_update_success',
          'status_value' => true,
          'message' => 'company Updated Successfully'
      ]);
      }
      else{
        return response()->json([
          'status' => 'company_update_fail',
          'status_value' => false,
          'message' => 'company Not Found'
      ]);
      }
  



}
catch (Exception $e) {
  return response()->json([
      'status' => 'company_update_fail',
      'status_value' => false,
      'message' => $e->getMessage()
  ]);
}
   
}

public function company_get()
{
    $companydetails = CompanyModel::where('flag', 1)
    ->where('auth_mail', auth()->user()->email)
    ->get();
    
    // dd($companydetails);
// Return the view with billing details
    return response()->json(['companydetails' => $companydetails]);
}

public function company_delete(Request $request)
{
    $id = $request->input('selectedId');

    // Ensure $id is an array
    if (!is_array($id)) {
        $id = [$id]; // Convert string to array
    }

    // Check if any of the selected companies is currently active
    $activeCompanyBeingDeleted = CompanyModel::whereIn('id', $id)
        ->where('company_active', 1)
        ->exists();

    // Deactivate (soft delete) records with IDs in $id array
    CompanyModel::whereIn('id', $id)->update(['flag' => 0, 'company_active' => 0]);

    // If a currently active company is being deactivated
    if ($activeCompanyBeingDeleted) {
        // Deactivate all currently active companies for the authenticated user
        // CompanyModel::where('flag', 1)
        //     ->where('company_active', 1)
        //     ->where('auth_mail', auth()->user()->email)
        //     ->update(['company_active' => 0]);

        // Find the most recent company with flag 1 for the authenticated user
        $latestCompany = CompanyModel::where('flag', 1)
            ->where('auth_mail', auth()->user()->email)
            ->orderBy('updated_at', 'desc')
            ->first();

        // If a company is found, set it as active
        if ($latestCompany) {
            $latestCompany->update(['company_active' => 1]);
        }
        CompanyModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['company_active' => 1]);

    }

    return response()->json([
        'status' => true,
        'message' => 'Company deleted successfully'
    ]);
}


public function company_active(Request $request)
{
    $id = $request->input('companyactiveid');
    
    if (!is_array($id)) {
        $id = [$id]; // Convert string to array
    }

    try {
        DB::beginTransaction();

        // Reset all other records' temp_active_status to 0
        CompanyModel::query()->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['company_active' => 0]);

        // Set the selected term to active
        CompanyModel::whereIn('id', $id)->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['company_active' => 1]);

         DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Company activated successfully.',
        ]);
    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => 'Failed to activate terms: ' . $e->getMessage(),
        ], 500);
    }
}

public function check_company_active(){
try{

    $companyactivedetails = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();
    // dd($companyactivedetails);
    return response()->json(['companyactivedetails' => $companyactivedetails]);


}
catch (\Exception $e) {

    DB::rollBack();

    return response()->json([
        'status' => false,
        'message' => 'Failed to activate terms: ' . $e->getMessage(),
    ], 500);
}

}



// Signature:


public function signature_add(Request $request)
{
    try {
        $request->validate([
            'signature_name' => 'required|string|max:255',
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'canvas_image' => 'nullable|image|mimes:png|max:2048'
        ]);

        $data = $request->only('signature_name');
        $data['auth_mail'] = auth()->user()->email;


        if ($request->hasFile('signature_image')) {
            // Delete the old signature image if it exists
         
            // Upload and store new signature image
            $signatureImage = $request->file('signature_image');
            $signatureImageFileName = uniqid() . '.' . $signatureImage->getClientOriginalExtension();
            $signatureImage->move(public_path('uploads/signature_image'), $signatureImageFileName);
            $data['signature_image'] = 'uploads/signature_image/' . $signatureImageFileName;
        }

        if ($request->hasFile('canvas_image')) {
            // Delete the old canvas image if it exists
          
            // Upload and store new canvas image
            $canvasImage = $request->file('canvas_image');
            $canvasImageFileName = uniqid() . '.' . $canvasImage->getClientOriginalExtension();
            $canvasImage->move(public_path('uploads/signature_image'), $canvasImageFileName);
            $data['canvas_image'] = 'uploads/signature_image/' . $canvasImageFileName;
        }

        
        $existingActiveNotesCount = SignatureModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->count();

        // Set the active flag for the new signature based on existing active notes
        if ($existingActiveNotesCount == 0) {
            $data['signature_active'] = 1;
        } else {
            $data['signature_active'] = 0;
        }

        
        $activeCompanies = CompanyModel::where('company_active', 1)
        ->where('flag', 1)
        ->where('auth_mail', auth()->user()->email)
        ->pluck('id'); // Get an array of IDs
    
        $companyIdsString = $activeCompanies->implode(',');

        $data['company_id'] = $companyIdsString;
        // Assign the string of IDs to the company_id field

        // Update the signature record with new data
        SignatureModel::create($data);

        return response()->json(['status_content'=> 'signature_add_success','status' => true, 'message' => 'Signature updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to update signature. ' . $e->getMessage()], 500);
    }

  }

  public function signature_get()
  {
    $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();

      $signaturedetails = SignatureModel::where('flag', 1)
      ->where('auth_mail', auth()->user()->email)
      ->where('company_id', $companyactive->id)
      ->get();
      
      // dd($companydetails);
  // Return the view with billing details
      return response()->json(['signaturedetails' => $signaturedetails]);
  }


  public function signature_update(Request $request)
  {
    try {
        $request->validate([
            'signature_name' => 'required|string|max:255',
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'canvas_image' => 'nullable|image|mimes:png|max:2048'
        ]);

        $data = $request->only('signature_name');
        $signatureId = $request->input('signature_id'); // Assuming you pass signature_id from the frontend for update

        $signature = SignatureModel::findOrFail($signatureId); // Fetch the existing signature record

        if ($request->hasFile('signature_image')) {
            // Delete the old signature image if it exists
            if ($signature->signature_image) {
                Storage::disk('public')->delete($signature->signature_image);
            }

            // Upload and store new signature image
            $signatureImage = $request->file('signature_image');
            $signatureImageFileName = uniqid() . '.' . $signatureImage->getClientOriginalExtension();
            $signatureImage->move(public_path('uploads/signature_image'), $signatureImageFileName);
            $data['signature_image'] = 'uploads/signature_image/' . $signatureImageFileName;
        }

        if ($request->hasFile('canvas_image')) {
            // Delete the old canvas image if it exists
            if ($signature->canvas_image) {
                Storage::disk('public')->delete($signature->canvas_image);
            }

            // Upload and store new canvas image
            $canvasImage = $request->file('canvas_image');
            $canvasImageFileName = uniqid() . '.' . $canvasImage->getClientOriginalExtension();
            $canvasImage->move(public_path('uploads/signature_image'), $canvasImageFileName);
            $data['canvas_image'] = 'uploads/signature_image/' . $canvasImageFileName;
        }

        // Update the signature record with new data
        $signature->update($data);

        return response()->json(['message' => 'Signature updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to update signature. ' . $e->getMessage()], 500);
    }
  
    }


    public function signature_delete(Request $request)
    {
        $id = $request->input('selectedId');
        // dd($id);
        if (!is_array($id)) {
          $id = [$id]; // Convert string to array
      }
    
        // Delete records with IDs in $ids array
        // NotesModel::whereIn('id', $id)->delete();
        SignatureModel::whereIn('id', $id)->update(['flag' => 0]);

        SignatureModel::where('signature_active', 1)->where('auth_mail', auth()->user()->email)->update(['signature_active' => 0]);

        // Find the most recent term with flag 1 and set it to active
        $latestSignatureNotes = SignatureModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->orderBy('updated_at', 'desc')->first();

        if ($latestSignatureNotes) {
            $latestSignatureNotes->update(['signature_active' => 1]);
        }
        
        SignatureModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['signature_active' => 1]);

        return response()->json([
          'status' => true,
          'message' => 'Signature Deleted Successfully'
      ]);
    
    }

    public function signature_active(Request $request)
    {
        $id = $request->input('signatureactiveid');
        
        if (!is_array($id)) {
            $id = [$id]; // Convert string to array
        }
    
        try {
            DB::beginTransaction();
    
              // Reset all other records' temp_active_status to 0
              SignatureModel::query()->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['signature_active' => 0]);
    
            // Set the selected term to active
            SignatureModel::whereIn('id', $id)->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['signature_active' => 1]);
    
             DB::commit();
    
            return response()->json([
                'status' => true,
                'message' => 'Signature activated successfully.',
            ]);
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return response()->json([
                'status' => false,
                'message' => 'Failed to activate terms: ' . $e->getMessage(),
            ], 500);
        }
    }
    

// Notes:

public function notes_data_add(Request $request)
{
    try{
    $notesData = $request->all();

    $notes = new NotesModel;

    $notes->fill($notesData);

    $notes->auth_mail = auth()->user()->email;


    $existingActiveNotesCount = NotesModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->count();

    // If no existing active terms, set the new term as active
    if ($existingActiveNotesCount == 0) {
        $notes->notes_active = 1;
    } else {
        $notes->notes_active = 0; // Ensure the new term is inactive if there are already active terms
    }
    // dd($notes);

    
    $activeCompanies = CompanyModel::where('company_active', 1)
    ->where('flag', 1)
    ->where('auth_mail', auth()->user()->email)
    ->pluck('id'); // Get an array of IDs

    $companyIdsString = $activeCompanies->implode(',');

    // Assign the string of IDs to the company_id field
    $notes->company_id = $companyIdsString;

    $notes->save();
   return response()->json([
      'status' =>'notes_add_success',
      'status_value' => true,
      'message' => 'Notes Created Successfuly'
  ]);
}
  catch (Exception $e) {
    return response()->json([
        'status_value' => false,
        'message' => $e->getMessage()
    ]); // Custom status code for bad request
}
   
}


public function notes_update(Request $request)
{
    try{
      $notes_id = $request->input('notes_id');

      // Find the notes by ID
      $notes = NotesModel::find($notes_id);

      if ($notes) {
        $notes->update($request->all());
        $notes->auth_mail = auth()->user()->email;
        $notes->save();
        return response()->json([
          'status' => 'notes_update_success',
          'status_value' => true,
          'message' => 'Notes Updated Successfully'
      ]);
      }
      else{
        return response()->json([
          'status' => 'notes_update_fail',
          'status_value' => false,
          'message' => 'notes Not Found'
      ]);
      }
  



}
catch (Exception $e) {
  return response()->json([
      'status' => 'notes_update_fail',
      'status_value' => false,
      'message' => $e->getMessage()
  ]);
}
   
}

public function notes_get()
{
    $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();

    $notesdetails = NotesModel::where('flag', 1)
    ->where('auth_mail', auth()->user()->email)
    ->where('company_id', $companyactive->id)
    ->get();
    
    // dd($notesdetails);
// Return the view with billing details
    return response()->json(['notesdetails' => $notesdetails]);
}

public function notes_delete(Request $request)
{
$id = $request->input('selectedId');
// dd($id);
if (!is_array($id)) {
  $id = [$id]; // Convert string to array
}

// Delete records with IDs in $ids array
// NotesModel::whereIn('id', $id)->delete();
NotesModel::whereIn('id', $id)->update(['flag' => 0]);


NotesModel::where('notes_active', 1)->where('auth_mail', auth()->user()->email)->update(['notes_active' => 0]);

// Find the most recent term with flag 1 and set it to active
$latestActiveNotes = NotesModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->orderBy('updated_at', 'desc')->first();
if ($latestActiveNotes) {
    $latestActiveNotes->update(['notes_active' => 1]);
}

NotesModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['notes_active' => 1]);

return response()->json([
  'status' => true,
  'message' => 'Notes Deleted Successfully'
]);

}



public function notes_active(Request $request)
{
    $id = $request->input('notesactiveid');
    
    if (!is_array($id)) {
        $id = [$id]; // Convert string to array
    }

    try {
        DB::beginTransaction();

          // Reset all other records' temp_active_status to 0
        NotesModel::query()->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['notes_active' => 0]);

        // Set the selected term to active
        NotesModel::whereIn('id', $id)->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['notes_active' => 1]);

         DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Notes activated successfully.',
        ]);
    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => 'Failed to activate terms: ' . $e->getMessage(),
        ], 500);
    }
}


// terms:

public function terms_data_add(Request $request)
{
    try{
    $termsData = $request->all();

    $terms = new TermsModel;

    $terms->fill($termsData);

    $terms->auth_mail = auth()->user()->email;

    $existingActiveTermsCount = TermsModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->count();

    // If no existing active terms, set the new term as active
    if ($existingActiveTermsCount == 0) {
        $terms->terms_active = 1;
    } else {
        $terms->terms_active = 0; // Ensure the new term is inactive if there are already active terms
    }
    // dd($terms);
    
    $activeCompanies = CompanyModel::where('company_active', 1)
    ->where('flag', 1)
    ->where('auth_mail', auth()->user()->email)
    ->pluck('id'); // Get an array of IDs

    $companyIdsString = $activeCompanies->implode(',');

    // Assign the string of IDs to the company_id field
    $terms->company_id = $companyIdsString;

    $terms->save();
   return response()->json([
      'status' =>'terms_add_success',
      'status_value' => true,
      'message' => 'Terms & Condition Created Successfuly'
  ]);
}
  catch (Exception $e) {
    return response()->json([
        'status_value' => false,
        'message' => $e->getMessage()
    ]); // Custom status code for bad request
}
   
}


public function terms_update(Request $request)
{
    try{
      $terms_id = $request->input('terms_id');

      // Find the terms by ID
      $terms = TermsModel::find($terms_id);
      
      if ($terms) {
        $terms->update($request->all());
        $terms->auth_mail = auth()->user()->email;
        $terms->save();
        return response()->json([
          'status' => 'terms_update_success',
          'status_value' => true,
          'message' => 'Terms & Condition Updated Successfully'
      ]);
      }
      else{
        return response()->json([
          'status' => 'terms_update_fail',
          'status_value' => false,
          'message' => 'terms Not Found'
      ]);
      }
  



}
catch (Exception $e) {
  return response()->json([
      'status' => 'terms_update_fail',
      'status_value' => false,
      'message' => $e->getMessage()
  ]);
}
   
}

public function terms_get()
{
    $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();

    $termsdetails = TermsModel::where('flag', 1)
    ->where('auth_mail', auth()->user()->email)       
    ->where('company_id', $companyactive->id)
    ->get();
        // dd($termsdetails);
// Return the view with billing details
    return response()->json(['termsdetails' => $termsdetails]);
}

public function terms_delete(Request $request)
{
  $id = $request->input('selectedId');
  // dd($id);
  if (!is_array($id)) {
    $id = [$id]; // Convert string to array
  }

  // Delete records with IDs in $ids array
  // TermsModel::whereIn('id', $id)->delete();
  TermsModel::whereIn('id', $id)->update(['flag' => 0]);

  TermsModel::where('terms_active', 1)->where('auth_mail', auth()->user()->email)->update(['terms_active' => 0]);

  // Find the most recent term with flag 1 and set it to active
  $latestActiveTerm = TermsModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->orderBy('updated_at', 'desc')->first();
  if ($latestActiveTerm) {
      $latestActiveTerm->update(['terms_active' => 1]);
  }


  TermsModel::where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['terms_active' => 1]);


  return response()->json([
    'status' => true,
    'message' => 'Terms & Condition Deleted Successfully'
  ]);

}

public function terms_active(Request $request)
{
    $id = $request->input('termsactiveid');
    
    if (!is_array($id)) {
        $id = [$id]; // Convert string to array
    }

    try {
        DB::beginTransaction();

          // Reset all other records' temp_active_status to 0
        TermsModel::query()->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['terms_active' => 0]);

        // Set the selected term to active
         TermsModel::whereIn('id', $id)->where('flag', 1)->where('auth_mail', auth()->user()->email)->update(['terms_active' => 1]);

         DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Terms activated successfully.',
        ]);
    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => 'Failed to activate terms: ' . $e->getMessage(),
        ], 500);
    }
}


  // bank Details :
  public function getBankDetails(Request $request)
  {
      $ifscCode = $request->input('ifsc_code');
      // dd($ifscCode);
      $client = new Client();
  
      try {
          $response = $client->request('GET', 'https://ifsc.razorpay.com/' . $ifscCode);
          $bankDetails = json_decode($response->getBody(), true);
  
          return response()->json([
              'status' => 'success',
              'data' => $bankDetails
          ], 200);
  
      } catch (\Exception $e) {
          return response()->json([
              'status' => 'error',
              'message' => 'Invalid IFSC code. Please check and try again'
          ], 500);
      }
  }

  public function bank_add(Request $request)
  {
      try{
      $bankData = $request->all();
  
      $bank = new BankDetail;
  
      $bank->fill($bankData);
  
      $bank->auth_mail = auth()->user()->email;
  
  
      $existingActivebankCount = BankDetail::where('flag', 1)->where('auth_mail', auth()->user()->email)->count();
  
      // If no existing active terms, set the new term as active
      if ($existingActivebankCount == 0) {
          $bank->bank_active = 1;
      } else {
          $bank->bank_active = 0; // Ensure the new term is inactive if there are already active terms
      }
      // dd($bank);
  
      
      $activeCompanies = CompanyModel::where('company_active', 1)
      ->where('flag', 1)
      ->where('auth_mail', auth()->user()->email)
      ->pluck('id'); // Get an array of IDs
  
      $companyIdsString = $activeCompanies->implode(',');
  
      // Assign the string of IDs to the company_id field
      $bank->company_id = $companyIdsString;
  
      $bank->save();
     return response()->json([
        'status' =>'bank_add_success',
        'status_value' => true,
        'message' => 'bank Created Successfuly'
    ]);
  }
    catch (Exception $e) {
      return response()->json([
          'status_value' => false,
          'message' => $e->getMessage()
      ]); // Custom status code for bad request
  }
     
  }
  
  
  public function bank_update(Request $request)
  {
      try{
        $bank_id = $request->input('bank_id');
  
        // Find the bank by ID
        $bank = BankDetail::find($bank_id);
  
        if ($bank) {
          $bank->update($request->all());
          $bank->auth_mail = auth()->user()->email;
          $bank->save();
          return response()->json([
            'status' => 'bank_update_success',
            'status_value' => true,
            'message' => 'bank Updated Successfully'
        ]);
        }
        else{
          return response()->json([
            'status' => 'bank_update_fail',
            'status_value' => false,
            'message' => 'bank Not Found'
        ]);
        }
    
  
  
  
  }
  catch (Exception $e) {
    return response()->json([
        'status' => 'bank_update_fail',
        'status_value' => false,
        'message' => $e->getMessage()
    ]);
  }
     
  }
  
  public function bank_get()
  {
      $companyactive = CompanyModel::where('flag', 1)->where('company_active', 1)->where('auth_mail', auth()->user()->email)->first();
      
      $bankdetails = BankDetail::where('flag', 1)
      ->where('auth_mail', auth()->user()->email)
      ->where('company_id', $companyactive->id)
      ->orWhereNull('auth_mail')
      ->get();
      
  // dd($bankdetails);
  // Return the view with billing details
      return response()->json(['bankdetails' => $bankdetails]);
  }
  
  public function bank_delete(Request $request)
  {
  $id = $request->input('selectedId');
  // dd($id);
  if (!is_array($id)) {
    $id = [$id]; // Convert string to array
  }
  
  // Delete records with IDs in $ids array
  // BankDetail::whereIn('id', $id)->delete();
  BankDetail::whereIn('id', $id)->update(['flag' => 0]);
  
  
  BankDetail::where('bank_active', 1)->where('auth_mail', auth()->user()->email)->orWhereNull('auth_mail')->update(['bank_active' => 0]);
  
  // Find the most recent term with flag 1 and set it to active
  $latestActivebank = BankDetail::where('flag', 1)->where('auth_mail', auth()->user()->email)->orWhereNull('auth_mail')->orderBy('updated_at', 'desc')->first();
  if ($latestActivebank) {
      $latestActivebank->update(['bank_active' => 1]);
  }
  
  BankDetail::where('flag', 1)->where('auth_mail', auth()->user()->email)->orWhereNull('auth_mail')->update(['bank_active' => 1]);
  
  return response()->json([
    'status' => true,
    'message' => 'Deleted successfully'
  ]);
  
  }
  
  
  
  public function bank_active(Request $request)
  {
      $id = $request->input('bankactiveid');
  
      if (!is_array($id)) {
          $id = [$id]; // Convert string to array
      }
  
      try {
          DB::beginTransaction();
  
          // Reset all other records' bank_active to 0
          BankDetail::query()
              ->where('flag', 1)
              ->where(function($query) {
                  $query->where('auth_mail', auth()->user()->email)
                        ->orWhereNull('auth_mail');
              })
              ->update(['bank_active' => 0]);
  
          // Set the selected bank to active
          BankDetail::whereIn('id', $id)
              ->where('flag', 1)
              ->where(function($query) {
                  $query->where('auth_mail', auth()->user()->email)
                        ->orWhereNull('auth_mail');
              })
              ->update(['bank_active' => 1]);
  
          DB::commit();
  
          return response()->json([
              'status' => true,
              'message' => 'updated successfully.',
          ]);
      } catch (\Exception $e) {
          DB::rollBack();
  
          return response()->json([
              'status' => false,
              'message' => 'Failed to activate bank: ' . $e->getMessage(),
          ], 500);
      }
  }
  
  public function getCompanyGstin(Request $request)
  {
      $gstinNumber = $request->input('company_gstin_number');

      // Validate GSTIN number format (can be adjusted as needed)
      if (!preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/', $gstinNumber)) {
          return response()->json([
              'success' => false,
              'message' => 'Enter Valid GSTN number'
          ]);
      }

      // Here, you would call the GST API to fetch details. For example purposes, we'll mock the response.
      // Make sure to replace this with actual API call.
      $client = new Client();
      $response = $client->get('https://actual-api-endpoint.com/gstin/' .$gstinNumber);

      if ($response->getStatusCode() == 200) {
          $data = json_decode($response->getBody(), true);
          return response()->json([
              'success' => true,
              'address' => $data['address'],
              'city' => $data['city'],
              'pincode' => $data['pincode'],
              'country' => $data['country']
          ]);
      }

      return response()->json([
          'success' => false,
          'message' => 'Failed to fetch GSTIN details'
      ]);
  }
  

  public function getCustomerGstin(Request $request)
  {
      $gstinNumber = $request->input('customer_gstin_number');

      // Validate GSTIN number format (can be adjusted as needed)
      if (!preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/', $gstinNumber)) {
          return response()->json([
              'success' => false,
              'message' => 'Enter Valid GSTN number'
          ]);
      }

      // Here, you would call the GST API to fetch details. For example purposes, we'll mock the response.
      // Make sure to replace this with actual API call.
      $client = new Client();
      $response = $client->get('https://actual-api-endpoint.com/gstin/' .$gstinNumber);

      if ($response->getStatusCode() == 200) {
          $data = json_decode($response->getBody(), true);
          return response()->json([
              'success' => true,
              'address' => $data['address'],
              'city' => $data['city'],
              'pincode' => $data['pincode'],
              'country' => $data['country']
          ]);
      }

      return response()->json([
          'success' => false,
          'message' => 'Failed to fetch GSTIN details'
      ]);
  }
}