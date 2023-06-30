<?php

namespace App\Http\Controllers\LandLord;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index(){
        return Inertia::render('LandLord/Welcome');
    }
}
