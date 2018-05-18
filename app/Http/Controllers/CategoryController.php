<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param CategoryRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::simplePaginate(10);
        return view('categories.index', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest    $request
     * @param CategoryRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request, CategoryRepository $repository)
    {
        $repository->create($request->all());
        return redirect()->route('category.index');
    }
}
