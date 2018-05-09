<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Http\Requests\FeedRequest;
use App\Http\Requests\StoreFeedRequest;
use Illuminate\Support\Facades\Log;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Feed::simplePaginate(10);
        return view('feeds.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeedRequest $request, Feed $feed)
    {
        Log::debug('Store feed', ['url' => $request->url]);
        $feed->url = $request->url;
        $feed->save();
        Log::info('Store feed saved', ['url' => $request->url, 'feed_id' => $feed->id]);

        return redirect()->route('feed.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        return view('feeds.show', compact('feed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed, FeedRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Feed $feed, FeedRequest $request)
    {
        Log::debug('Feed update', ['feed_id' => $feed->id]);

        $feed->url = $request->url;
        if (!$feed->isDirty()){
            Log::debug('Feed update failed', ['request' => $request->all()]);
        }
        $feed->save();
        Log::info('Feed updated', ['feed_id' => $feed->id]);
        return redirect()->route('feed.show', [$feed]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed)
    {
        Log::debug('Feed delete', ['feed_id' => $feed->id]);
        $feed->delete();
        Log::info ('feed deleted', ['feed_id' => $feed->id]);
        return redirect()->route('feed.index');
    }
}
