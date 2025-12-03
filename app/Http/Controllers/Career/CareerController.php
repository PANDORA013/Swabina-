<?php

namespace App\Http\Controllers\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CareerController extends Controller
{

    public function karir()
    {
        
        return view('karir.karir-professional');
    }
    public function karirEng()
    {
        
        return view('eng.karir-eng.karir-eng');
    }

}
