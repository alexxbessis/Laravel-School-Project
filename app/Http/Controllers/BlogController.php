<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index (){
        $title = "Laravel c'est chanmé !";
        return view('blog.homepage', compact('title', $title));
    }

    public function apropos(){
        $array = [
            'skills' => [
                'HTML5/CSS3',
                'PHP',
                'Javascript',
            ]
        ];
        return view('blog.apropos')->with($array);
    }
}
