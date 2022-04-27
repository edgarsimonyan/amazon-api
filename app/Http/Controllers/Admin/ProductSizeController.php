<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSizeRequest;
use App\Models\Admin\Size;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes =  Size::get();
        return view('admin.productSize',compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.productCreateSize');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSizeRequest $request)
    {
        $ProductSize = new Size;
        $ProductSize->size = $request->size;
            $save = $ProductSize->save();
            if ($save) {
                return back()->with('success', 'New category has successfully added in database');
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
        $edit_size = Size::find($id);
        return view('admin.editSize',compact('edit_size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductSizeRequest $request, $id)
    {
        $size = Size::find($id);
        if (!$size) {
            return redirect()->back();
        }
        $size->update([
            "size" => $request->size,
        ]);
        return redirect()->route('adminSize.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);

        if (!$size) {
            return redirect()->back();
        }

        $size->delete();
        return response()->json();
    }
}
