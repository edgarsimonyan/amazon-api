<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductColorRequest;
use App\Models\Admin\Color;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors =  Color::get();
        return view('admin.productColor',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.productCreateColor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductColorRequest $request)
    {
        $ProductColor = new Color;
        $ProductColor->color = $request->color;
        $save = $ProductColor->save();
        if ($save) {
            return $this->index();
        }
        return back()->with('fail', 'Something went wrong,try again later');
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
        $edit_color = Color::find($id);
        return view('admin.editColor',compact('edit_color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductColorRequest $request, $id)
    {
        $color = Color::find($id);
        if (!$color) {
            return redirect()->back();
        }
        $color->update([
            "color" => $request->color,
        ]);
        return redirect()->route('adminColor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);

        if (!$color) {
            return redirect()->back();
        }

        $color->delete();
        return response()->json();
    }

}
