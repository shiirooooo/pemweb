<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function cart()
    {
        return view('carts.index', [
            'carts' => Cart::where('user_id', auth()->id())->get(),
        ]);
    }

    public function addToCart(Product $product)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            if ($cart->quantity >= $product->stock) {
                Alert::error('Gagal', 'Stock tidak mencukupi!');
                return redirect()->back();
            }

            $cart->quantity++;
            $cart->save();

            Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang!');
            return redirect()->back();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);

            Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang!');
            return redirect()->back();
        }
    }

    public function updateCart(Request $request, Cart $cart)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', 'Jumlah produk tidak boleh kosong!');
            return redirect()->back();
        }

        if ($request->quantity > $cart->product->stock) {
            Alert::error('Gagal', 'Stock tidak mencukupi!');
            return redirect()->back();
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        Alert::success('Berhasil', 'Keranjang berhasil diupdate!');
        return redirect()->back();
    }

    public function removeFromCart(Cart $cart)
    {
        $cart->delete();

        Alert::success('Berhasil', 'Produk berhasil dihapus dari keranjang!');
        return redirect()->back();
    }

    public function checkout()
    {
        return view('carts.checkout', [
            'carts' => Cart::where('user_id', auth()->id())->get(),
        ]);
    }

    public function order()
    {
        $this->validate(request(), [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $carts = Cart::where('user_id', auth()->id())->get();

            foreach ($carts as $cart) {
                if ($cart->quantity > $cart->product->stock) {
                    Alert::error('Gagal', 'Stock tidak mencukupi!');
                    return redirect()->back();
                }
            }

            $total = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            foreach ($carts as $cart) {
                $cart->product->stock -= $cart->quantity;
                $cart->product->save();
            }

            $order = new Order();
            $order->invoice = $this->generateRandomInvoiceNumber();
            $order->name = request()->name;
            $order->phone = request()->phone_number;
            $order->address = request()->address;
            $order->total = $total;
            $order->user_id = auth()->id();
            $order->save();

            foreach ($carts as $cart) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_name = $cart->product->name;
                $orderDetail->price = $cart->product->price;
                $orderDetail->quantity = $cart->quantity;
                $orderDetail->subtotal = $cart->product->price * $cart->quantity;
                $orderDetail->photo = $cart->product->photo;
                $orderDetail->save();

                $cart->delete();
            }
            DB::commit();
            Alert::success('Berhasil', 'Pesanan berhasil dibuat!');
            return redirect()->route('orders.show', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Pesanan gagal dibuat!');
            return redirect()->back();
        }
    }

    function generateRandomInvoiceNumber(): String
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '#';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
