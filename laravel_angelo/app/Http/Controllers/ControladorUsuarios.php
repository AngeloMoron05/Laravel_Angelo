<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ControladorUsuarios extends Controller
{
    public function control(){
        return response()->json("Angelo, mensaje por medio del controlador");
    }
}
