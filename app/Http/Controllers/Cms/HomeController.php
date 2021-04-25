<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();

        return view('cms.home.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $categorys = Category::all();
        $listFramImages = Category::arrDefault;

        return view('cms.home.create', compact('product', 'categorys', 'listFramImages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $fileColors = [];
            $fileImages = [];
            if (!empty($request->file('prodcut_color')['file'])) {
                foreach ($request->file('prodcut_color')['file'] as $key => $file) {
                    $name = time() . rand(1, 100) . $file->getClientOriginalExtension();
                    $file->move(public_path('files'), $name);
                    $fileColors[$key] = $name;
                }
            }
            // dd($request->prodcut_color['file'][0]->getClientOriginalName());
            if ($request->hasfile('product_images')) {
                foreach ($request->file('product_images') as $key => $file) {
                    $name = time() . rand(1, 100) . $file->getClientOriginalExtension();
                    $file->move(public_path('files'), $name);
                    $fileImages[$key] = $name;
                }
            }
            $colorData = $request->prodcut_color;
            $colorData['file'] = $fileColors;

            $product = new Product();
            $product->name = $request->name;
            $product->images = $fileImages;
            $product->color = $colorData;
            $product->size = $request->product_size;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->promotion_price = $request->promotion_price;
            $product->exist = $request->exist;
            $product->description = $request->description;
            $product->save();

            return redirect()->route('product.index');
        } catch (\Exception $e) {
            return redirect()->route('product.index');
        }
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
        $product = Product::find($id);
        $categorys = Category::all();
        $listFramImages = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

        return view('cms.home.edit', compact('product', 'categorys', 'id', 'listFramImages'));
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
        try {
            $fileColors = [];
            $fileImages = [];
            if (!empty($request->file('prodcut_color')['file'])) {
                foreach ($request->file('prodcut_color')['file'] as $key => $file) {
                    $name = time() . rand(1, 100) . $file->getClientOriginalExtension();
                    $file->move(public_path('files'), $name);
                    $fileColors[$key] = $name;
                }
            }
            // dd($request->prodcut_color['file'][0]->getClientOriginalName());
            if ($request->hasfile('product_images')) {
                foreach ($request->file('product_images') as $key => $file) {
                    $name = time() . rand(1, 100) . $file->getClientOriginalExtension();
                    $file->move(public_path('files'), $name);
                    $fileImages[$key] = $name;
                }
            }
            $product = Product::find($id);

            $colorData = $request->prodcut_color;
            $groupColor = ($fileColors + $product->color['file']);

            $colorData['file'] = $groupColor;
            $product->images = ($fileImages + $product->images);
            $product->color = $colorData;
            $product->name = $request->name;
            $product->size = $request->product_size;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->promotion_price = $request->promotion_price;
            $product->exist = $request->exist;
            $product->description = $request->description;
            $product->save();

            return redirect()->route('product.index');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index');
    }
}
