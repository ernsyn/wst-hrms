<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome'; 
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title',$title);
    }
    
    public function about() {
        $data = array(
            'title' => 'Services',
            'services' => ['Web design','Programming','SEO']
        );
        return view('pages.about')->with($data);
    }

    public function services() {
        return view('pages.services');
    }
}
