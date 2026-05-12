<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }
        // public function about()
        // {
        //     return view('frontend.about');
        // }
    
        public function visit_to_srilanka()
        {
            return view('frontend.inbound');
        }
    
        public function outbound()
        {
            return view('frontend.outbound');
        }
    
        // public function blog()
        // {
        //     return view('frontend.blog');
        // }
    
        // public function contact()
        // {
        //     return view('frontend.contact');
        // }
}
