<?php

namespace App\Http\Controllers;

use App\FeedItem;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedItems = FeedItem::simplePaginate(10);
        return view('home', compact('feedItems'));
    }
}
