<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendWelcomeEmail;

class HomeController extends Controller
{
    public function index(){

        //1
        Mail::to('account@mail.it')->send(new SendWelcomeEmail());

        //2
        //Mail::to(Auth::user()->email)->send(new SendWelcomeEmail());


        return view('admin.home');
    }
}
