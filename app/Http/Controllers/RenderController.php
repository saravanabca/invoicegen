<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\TemplateCategory;
use View;

class RenderController extends Controller
{
    public function index(Request $request){
        $view = '';
        switch ($request->page) {
                case 'signup':
                    $view = View::make('modal.common.signup')->render();
                    break;
                case 'login':
                    $view = View::make('modal.common.login')->render();
                    break;
                case 'forget':
                    $view = View::make('modal.common.forget')->render();
                    break;
                case 'verifyotp':
                    $view = View::make('modal.common.verifyotp')->render();
                    break;
            default:
                break;
        }
        return response()->json(['html' => $view]);
    }   
}