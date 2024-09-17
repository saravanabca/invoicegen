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

class FeedbackController extends Controller
{

    public function feedback()
    {
        
      return view('user.feedback');
    }

    public function contact()
    {
        
      return view('user.contact');
    }
}