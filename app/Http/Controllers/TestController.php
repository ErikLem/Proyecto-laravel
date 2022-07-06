<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    public function index(){
        
        $Value = User::find(70);
        $Value_1 = $Value->role;
        return $Value_1;
      
    
    }
}
