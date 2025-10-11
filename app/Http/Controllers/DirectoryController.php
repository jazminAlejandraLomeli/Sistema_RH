<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    //

    public function index(){
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home.index')],            
            ['name' => 'Directorio']
        ];

        return view('directory.index', compact('breadcrumbs'));
    }
}
