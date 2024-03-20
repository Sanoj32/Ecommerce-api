<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->searchQuery;
        $categories = Category::when($searchQuery, function ($query) use ($request, $searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%');
        })->paginate(10);
        return response([
            'message' => 'Categories retrieved successfully.',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return response([
            'message' => 'Category created successfully.',
            'product' => Category::create($request->validated())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response([
            'message' => 'Category retrieved successfully.',
            'product' =>$category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update($request->all());
        return response([
            'message' => 'Category updated successfully.',
            'product' =>$category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response([
            'message' => 'Category deleted successfully.'
        ]);
    }
}
