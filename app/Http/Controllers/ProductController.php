<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bill;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;

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
            $bill->street = 'Địa chỉ user login 36 Duy Tân, Cầu giấy';
            $bill->total_order = $price * ($request->quantity ?? 1);
            $bill->name = 'User login';
            $bill->email = 'userlogin@gmail.com';
            $bill->phone = '0347578698';
            $bill->save();

            if (!empty($bill->id)) {
                $orderProduct->bill_id = $bill->id;
                $orderProduct->color = $request->color ?? '';
                $orderProduct->size = $request->size ?? '';
                $orderProduct->price = $request->price ?? 0;
                $orderProduct->promotion_price = $request->promotionPrice ?? 0;
                $orderProduct->quantity = $request->quantity ?? 1;
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

    public function delete($id)
    {
        $bill = Bill::find($id);
        $orderProduct = OrderProduct::where('bill_id', $bill->id);
        $orderProduct->delete();
        $bill->delete();

        return redirect()->route('product.listOrder');
    }

    public function store(Request $request)
    {
        try {
            $products = Bill::with('orderProduct', 'product')->where('status', 0)->get();
            $bills = Bill::where('status', 0)->get()->pluck('id');
            foreach ($bills as $billId) {
                DB::table('bills')
                    ->where('id', $billId)
                    ->update([
                        'street' => $request->street_address,
                        'name' => $request->name,
                        'email' => $request->email_address,
                        'phone' => $request->phone_number,
                        'note' => $request->note,
                        'status' => 1
                    ]);
            }
            if ($products->count() > 0) {
                $users = $request->email_address;
                $message = [
                    'type' => 'Thông tin đặt hàng',
                    'products' => $products,
                    'street' => $request->street_address,
                    'name' => $request->name,
                    'phone' => $request->phone_number,
                    'note' => $request->note,
                ];
                SendEmail::dispatch($message, $users)->delay(now()->addMinute(1));
            }

            return redirect()->route('web.home');
        } catch (\Exception $e) {
            dd($e);
        }
        
    }
}
