<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();
        if ($cart) {
            $cart->products = json_decode($cart->products);
        }
        return response()->json($cart);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();

        $productData = $request->input('productData');

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $productData['cantidad'] = 1;
            $cart->products = json_encode([$productData]);
            $cart->status = 1;
        } else {
            $products = json_decode($cart->products, true);

            $found = false;
            foreach ($products as $product) {
                if ($product['id'] == $productData['id']) {
                    $product['cantidad'] += 1;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $productData['cantidad'] = 1;
                $products[] = $productData;
            }

            $cart->products = json_encode($products);
        }

        $cart->save();

        return response()->json($cart);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
