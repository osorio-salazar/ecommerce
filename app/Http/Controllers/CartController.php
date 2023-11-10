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
        return response()->json($cart->products);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();

        $productDatas = $request->input('productDatas');

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $productDatas['cantidad'] = 1;
            $cart->products = json_encode([$productDatas]);
            $cart->status = 1;
            $cart->products_total = $productDatas['price'] * $productDatas['cantidad'];
        } else {
            $products = json_decode($cart->products, true);

            $found = false;
            foreach ($products as $index => $product) {
                if ($product['id'] == $productDatas['id']) {
                    $products[$index]['cantidad'] += 1;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $productDatas['cantidad'] = 1;
                $products[] = $productDatas;
            }

            $total = 0;
            foreach ($products as $product) {
                $total += $product['price'] * $product['cantidad'];
            }
            $cart->products_total = $total;

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
        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();

        if ($cart) {
            $products = json_decode($cart->products, true);

            $productData = $request->input('productData');
            $productId = $productData['id'];

            foreach ($products as $index => $product) {
                if ($product['id'] == $productId) {
                    $products[$index]['cantidad'] = $productData['cantidad'];
                }
            }

            $total = 0;
            foreach ($products as $product) {
                $total += $product['price'] * $product['cantidad'];
            }
            $cart->products_total = $total;

            $cart->products = json_encode($products);
            $cart->save();
        }
    }


    public function destroy(Request $request, $id)
    {

        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();
        $products = json_decode($cart->products, true);

        $productId = $request->input('productId');

        foreach ($products as $key => $product) {
            if ($product['id'] == $productId) {
                unset($products[$key]);
            }
        }

        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['cantidad'];
        }
        $cart->products_total = $total;

        $cart->products = json_encode(array_values($products));
        $cart->save();

        return response()->json($cart);
    }
}
