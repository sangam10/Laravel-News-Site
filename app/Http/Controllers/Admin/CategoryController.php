<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')->with([
            'categories' => $this->categoryInterface->all(),
        ]);
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        $isCategoryAdded = $this->categoryInterface->create($value);
        if ($isCategoryAdded)
            return back()->with('success', 'successfully added');
        return back()->with('error', 'oops! fail to add new category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $is_updated = $this->categoryInterface->update($request->validate([
            'category_name' => 'required|unique:categories'
        ]), $id);
        if ($is_updated) {
            return back()->with('success', 'category successfully updated');
        }
        return back()->with('error', ' Oops! failed to update category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->categoryInterface->delete($id);
        if ($isDeleted) {
            return back()->with('success', 'successfully deleted');
        }
        return back()->with('error', 'failed to delete!!');
    }
}
