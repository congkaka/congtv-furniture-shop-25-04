<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bill;
use App\Models\OrderProduct;
use PHPUnit\Util\Json;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productId = request()->item;
        $products = Product::find($productId);
        $productEquivalents = Product::where('category_id', $products->category_id)->get();

        return view('pages.product.index', compact('products', 'productEquivalents'));
    }

    public function order(Request $request)
    {
        try {
            $bill = new Bill();
            $orderProduct = new OrderProduct();
            $price = $request->promotionPrice ?? 0;
            if ($price == 0) {
                $price = $request->price ?? 0;
            }
            $bill->user_id = 1;
            $bill->product_id = $request->productId ?? 0;
            $bill->street = '36 Duy Tân, Cầu giấy';
            $bill->total_order = $price * ($request->quantity ?? 1);
            $bill->name = 'Đinh Quốc Cường';
            $bill->email = 'cuongdq@gmail.com';
            $bill->phone = '0347578698';
            $bill->save();

            if (!empty($bill->id)) {
                $orderProduct->bill_id = $bill->id;
                $orderProduct->color = $request->color ?? '';
                $orderProduct->size = $request->size ?? '';
                $orderProduct->save();
            }

            // return redirect()->route('product.listOrder');
            return json_encode(['status' => 1,'url' =>route('product.listOrder'), 'message' => 'Đặt hàng thành công'] );
        } catch (\Exception $e) {
            return json_encode(['status' => 2, 'message' => 'Có lỗi xảy ra xin thử lại!!!'] );
        }
    }

    public function listOrder()
    {
        $data = Bill::with('orderProduct', 'product')->get();
        // dd($data);
        return view('pages.product.listorder', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
