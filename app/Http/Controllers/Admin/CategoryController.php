<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategorRequest;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.adminHome', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('admin.createCategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminCategorRequest $request)
    {

        $category = new Category;
        $category->category_name = $request->category_name;
        if ($request['category_status']) {
            $category->parent_id = $request->category_status;
        }
        $save = $category->save();
        if ($save) {

            return redirect()->route('admin.index');
        }

        return back()->with('fail', 'Something went wrong,try again later');
    }

    public function edit($id)
    {

        $edit_category = Category::find($id);
        $categories = Category::get();

        return view('admin.editCategory',compact('edit_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCategorRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {

            return redirect()->back();
        }
        $category->update([
                "category_name" => $request->category_name,
                "parent_id" => $request->category_status,
            ]);

            return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back();
        }

        $category->delete();
        return response()->json();
    }

}
