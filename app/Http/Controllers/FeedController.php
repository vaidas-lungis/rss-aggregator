<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feed;
use App\Http\Requests\FeedRequest;
use App\Http\Requests\FeedUpdateRequest;
use App\Http\Requests\StoreFeedRequest;
use App\Repositories\FeedCategoryRepository;
use App\Repositories\FeedRepository;
use Illuminate\Support\Facades\DB;
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
     * Store a newly created resource in storage.
     * @param FeedRequest    $request
     * @param FeedRepository $feedRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FeedRequest $request, FeedRepository $feedRepository)
    {
        Log::debug('Store feed', ['url' => $request->url]);
        $id = $feedRepository->create(['url' => $request->url]);
        Log::info('Store feed saved', ['url' => $request->url, 'feed_id' => $id]);

        return redirect()->route('feed.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        $categories = Category::
        leftJoin('feed_category', 'feed_category.category_id', 'categories.id')
            ->select(DB::raw('categories.*, feed_category.id as assigned'))->get();

        return view('feeds.show', compact('feed', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param                        $id
     * @param FeedUpdateRequest      $request
     * @param FeedCategoryRepository $feedCategoryRepository
     * @return \Illuminate\Http\Response
     */
    public function update($id, FeedUpdateRequest $request, FeedCategoryRepository $feedCategoryRepository, FeedRepository $feedRepository)
    {
        Log::debug('Feed update', ['feed_id' => $id]);

        $feedRepository->update($id, $request->all());

        if ($request->categories) {
            $feedCategoryRepository->reset($id);
            $feedCategoryRepository->create($id, $request->categories);
        }

        Log::info('Feed updated', ['feed_id' => $id]);
        return redirect()->route('feed.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param                $id
     * @param FeedRepository $feedRepository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FeedRepository $feedRepository)
    {
        Log::debug('Feed delete', ['feed_id' => $id]);
        $feedRepository->remove($id);
        Log::info('feed deleted', ['feed_id' => $id]);
        return redirect()->route('feed.index');
    }
}
