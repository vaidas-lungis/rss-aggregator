<?php

namespace App\Http\Controllers;

use App\FeedItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @param Request  $request
     * @param FeedItem $feedItem
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FeedItem $feedItem)
    {
        if ($request->has('category')) {
            $feedItem
                ->join('feeds', 'feeds.id', 'feed_items.feed_id')
                ->join('feed_category', 'feed_category.feed_id', 'feeds.id')
                ->join('categories', 'categories.id', 'feed_category.category_id')
                ->where('categories.name', $request->get('category'));
        }
        $feedItems = $feedItem->simplePaginate(10);
        return view('home', compact('feedItems'));
    }
}
