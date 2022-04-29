<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Size;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        return view('product.welcome', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::get();
        $sizes = Size::get();
        $categories = Category::get();

        return view('product.product', compact('colors', 'sizes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $colors = [];
        $sizes = [];
        $data[] = [];

        foreach ($request->colors as $color) {
            if ($color) {
                array_push($colors, $color);
            }
        }
        foreach ($request->sizes as $size) {
            if ($size) {
                array_push($sizes, $size);
            }
        }
        for ($i = 0; $i < count($request->images); $i++) {
            $image_name = time() . $i . '.' . $request->images[$i]->extension();
            if ($i === (int)$request->main) {
                $mainImageName = $image_name;
            }
        }
        $user = Auth::user();

        $product = $user->products()->create([
            "product_name" => $request->product_name,
            "description" => $request->description,
            "brand" => $request->brand,
            "price" => $request->price,
            "category_status" => $request->category_status,
            "main" => $mainImageName,
        ]);

        $product->colors()->attach($colors);
        $product->sizes()->attach($sizes);

        for ($i = 0; $i < count($request->images); $i++) {
            $image_name = time() . $i . '.' . $request->images[$i]->extension();
            $request->images[$i]->move(public_path('images/product-images'), $image_name);

            $data[$i] =
                [
                    'product_id' => $product->id,
                    'image_name' => $image_name,
                ];
        }
        $product->productImages()->insert($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $images = $product->productImages()->get();
        $colors = $product->colors()->get();
        $sizes = $product->sizes()->get();

        return view('product.productShow', compact('product', 'images', 'colors','sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('user_id', session('user')['id'])->find($id);
        if ($product) {
            $productSizes = [];
            $productColors = [];

            $images = $product->productImages()->get();
            $productSize = $product->sizes()->get();
            for ($i = 0; $i < count($productSize); $i++) {
                array_push($productSizes, $productSize[$i]->id);
            }

            $productColor = $product->colors()->get();
            for ($k = 0; $k < count($productColor); $k++) {
                array_push($productColors, $productColor[$k]->id);
            }

            $sizes = Size::all();
            $categories = Category::all();
            $colors = Color::all();

            return view('product.productEdit', compact('product', 'images', 'sizes', 'colors', 'categories', 'productColors', 'productSizes'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $colors = [];
            $sizes = [];
            foreach ($request->colors as $color) {
                if ($color) {
                    array_push($colors, $color);
                }
            }

            foreach ($request->sizes as $size) {
                if ($size) {
                    array_push($sizes, $size);
                }
            }
            $update = $product->update([
                "product_name" => $request->product_name,
                "description" => $request->description,
                "brand" => $request->brand,
                "price" => $request->price,
                "category_status" => $request->category_status,
            ]);
            $product->colors()->sync($colors);
            $product->sizes()->sync($sizes);
            if ($update) {

                return redirect()->route('product.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Auth::user()->products()->find($id);
        if (!$product) {
            return redirect()->back();
        }
        for ($i = 0; $i < count($product->productImages); $i++) {
            unlink(public_path('/images/product-images/') . $product->productImages[$i]->image_name);
        }
        $product->delete();

        return response()->json();
    }

    public function myProducts($id)
    {
        if (session('isAdmin') || $id == session('user')['id']) {
            $user = User::find($id);
            $products = $user->products()->get();
            return view('product.userProducts', compact('products'));
        }

        return redirect()->back();
    }

    public function addProductImage(ProductImagesRequest $request, $id)
    {
        $user_id = Auth::user()['id'];
        $product = Product::where('user_id', $user_id)->find($id);
        $data[] = [];
        if ($product) {
            for ($i = 0; $i < count($request->images); $i++) {
                $image_name = time() . $i . '.' . $request->images[$i]->extension();
                $request->images[$i]->move(public_path('images/product-images'), $image_name);
                $data[$i] =
                      [
                        'product_id' => $id,
                        'image_name' => $image_name,
                    ];

            }
            $product->productImages()->insert($data);

        }

        return redirect()->back();
    }

    public function removeImage(Request $request, $id)
    {
        $product = Product::find($request->product_id);
        if ($product) {
            $image = $product->productImages()->find($id);
            unlink(public_path('/images/product-images/') . $image->image_name);
            $image->delete();

            return response()->json();
        }
    }

    public function mainImage(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product) {
            $product->update(
                [
                    'main' => $request->image_name
                ]
            );
        }
        return redirect()->back();
    }

}
