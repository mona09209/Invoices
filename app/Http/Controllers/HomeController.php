<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // $count_all =Invoice::count();
        // $count_invoices1 = Invoice::where('value_status', 1)->count();
        // $count_invoices2 = Invoice::where('value_status', 2)->count();
        // $count_invoices3 = Invoice::where('value_status', 3)->count();

        // if($count_invoices2 == 0){
        //     $nspainvoices2=0;
        // }
        // else{
        //     $nspainvoices2 = $count_invoices2/ $count_all*100;
        // }

        //   if($count_invoices1 == 0){
        //       $nspainvoices1=0;
        //   }
        //   else{
        //       $nspainvoices1 = $count_invoices1/ $count_all*100;
        //   }

        //   if($count_invoices3 == 0){
        //       $nspainvoices3=0;
        //   }
        //   else{
        //       $nspainvoices3 = $count_invoices3/ $count_all*100;
        //   }

        return view('home');
    }
}
