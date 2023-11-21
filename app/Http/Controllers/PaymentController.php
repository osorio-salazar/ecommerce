<?php

namespace App\Http\Controllers;

require base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use MercadoPago;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;


class PaymentController extends Controller
{
    public function purchaseHistory() 
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)->get();

        return response()->json($purchases);
    }

    public function createPayment(Request $request)
    {

        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));


        $preference = new MercadoPago\Preference();

        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();

        $items = [];

        // foreach(json_decode($cart->products, true) as $product) {
        //     $item = new MercadoPago\Item;
        //     $item->title = $product['name'];
        //     $item->quantity = $product[''];


        // }
        if (!$cart || empty(json_decode($cart->products, true))) {
            return response()->json('El carrito está vacío', 400);
        }

        $items = [];
        foreach (json_decode($cart->products, true) as $product) {
            $item = new MercadoPago\Item;
            $item->title = $product['name'];
            $item->quantity = $product['cantidad'];
            $item->unit_price = $product['price'];
            $item->currency_id = "COP";
            $items[] = $item;
        }


        $preference->back_urls = array(
            "success" => "http://ecommerce.test/dashboard/miscompras/?success",
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );

        $preference->items = $items;
        $preference->payment_methods = array(
            "installments" => 1,

        );




        $preference->save();

        return response()->json($preference->id);
    }

    public function successPayment(Request $request)


    {
        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->first();


        $purchase = new Purchase;
        $purchase->user_id = $user->id;
        $purchase->products = $cart->products;
        $purchase->status = 1;
        $purchase->purchase_date = date('Y-m-d');
        $purchase->save();


        if ($cart) {
            $cart->products = json_encode([]);
            $cart->save();
        }


        return response()->json('Carrito eliminado, y guardada la compra');
    }

    public function paymentTest()
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)->get();

        foreach ($purchases as $purchase) {
            $purchase->products = json_decode($purchase->products);
        }

        return response()->json($purchase);
    }


    public function getMercadoPagoKey()
    {
        return response()->json([
            'public_key' => config('services.mercadopago.key'),
        ]);
    }
}
