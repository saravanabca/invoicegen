<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
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

class WebController extends Controller
{
    public function home(Request $request)
    {
           $ip = $request->ip(); /* Dynamic IP address */
        //   $ip = '162.159.24.227'; /* Static IP address */
          $currentUserInfo = Location::get($ip);
      return view('home',compact('currentUserInfo'));
    }


    public function homepage()
    {
      return view('web.homepage');
    }

    public function features()
    {
      return view('web.features');
    }

    public function templates()
    {
      return view('web.templatehome');
    }
    public function faq()
    {
      return view('web.faq');
    }



}