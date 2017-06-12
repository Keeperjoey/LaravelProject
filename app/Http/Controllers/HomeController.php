<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

        $nodes = Node::all();
        return view('front.index')->with('nodes', $nodes);
    }
}
