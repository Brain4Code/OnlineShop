<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Srmklive\PayPal\Services\Paypal as PaypalClient;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Client;
use App\Models\Order;

class ClientsController extends Controller
{
    //
    public function home()
    {
        $products = Product::where('status', 1)->get();
        $sliders = Slider::where('status', 1)->get();
        return view('client.home')->with('sliders', $sliders)->with("products", $products);
    }

    public function shop()
    {
        $products = Product::get();
        return view('client.shop')->with('produits', $products);
    }

    public function cart(){
        return view('client.cart');
    }

    public function checkout(){
        if(Session::has('client'))
        return view('client.checkout');
        else
        return redirect('/login');
    }

    public function register(){
        return view('client.register');
    }

    public function signin(){
        return view('client.signin');
    }

    public function addtocart($id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
    }

    public function updateqty($id, Request $request){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->input('qty'));
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);
        return back();
    }

    public function removeitem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        Session::put('topCart', $cart->items);

        return back();
    }

    public function createaccount(Request $request){
        $this->validate($request, [
            "email"=>'email|required|unique:clients',
            "password"=>'required|min:6'

        ]);

        $client = new Client;
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return redirect()->with('status', "Compte crée avec success");
    }

    public function accessaccount(Request $request){
        $this->validate($request, [
            "email"=>'email|required',
            "password"=>'required'

        ]);

        $client = Client::where('email', $request->email)->first();
        if ($client) {
            # code...
            if(Hash::check($request->input('password'), $client->password)){
                Session::put('client', $client);
                return back()->with("status", 'Connecte avec success');
            }
            else{
                return back()->with("error", 'Mot de passe non correspondant');
            }
        }
        else{
            return back()->with("error", 'Cet adresse mail n\'appartient a aucun compte');
        }
    }

    public function logout(){
        Session::forget('client');
        return back();
    }

    public function pay(Request $request){
        try{
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $order = new Order;
            $order->nom = $request->input('firstname');
            $order->prenom = $request->input('lastname');
            $order->address = $request->input('address');
            $order->cart = serialize($cart);

            Session::put('order', $order);
            $provider = new PaypalClient;
            $provider->setApiCredentials(config("paypal"));
            $paypalToken = $provider->getAccessToken();

            $checkoutData = $this->checkoutData();
            $response = $provider->createOrder($checkoutData);



        }
        catch(\Exception $e) {
            return redirect('/cart')->with('error', $e->getMessage());

        }



       // $order->save();

        //Session::forget('cart');

        // return redirect('/cart')->with('status', 'Voter commande a ete enregistré');
    }

    private function checkoutData(){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $data['items'] = [];

        foreach($cart->items as $item ){
                $itemDetails=[
                'price' => $item['product_price'],
                ];

            $data['items'][] = $itemDetails;
        }

        $checkoutData = [
            'items' => $data['items'],
            'return_url' => url('/paymentSuccess'),
            'cancel_url' => url('/cart'),
            'invoice_id' => uniqid(),
            'invoice_description' => "order description",
            'total' => Session::get('cart')->totalPrice
        ];

        $checkoutData = [
            "intent"=>"CAPTURE",
            'application_context'=>[
                'return_url' => url('/paymentSuccess'),
                'cancel_url' => url('/cart'),
            ],
            'purchase_units' => [
                [
                    "amount"=>[
                        'currency_code'=>"USD",
                        "value"=> Session::get('cart')->totalPrice
                    ]
                ]
            ],
        ];
        return $checkoutData;
    }

    public function paymentSuccess(Request $request){

        try{

		    $token = $request->get('token');
        	$payerId = $request->get('PayerID');
        	$checkoutData = $this->checkoutData();

        	$provider = new PaypalClient();
        	$provider->setApiCredentials(config("paypal"));
            $paypalToken = $provider->getAccessToken();

        	$response = $provider->capturePaymentOrder($token);

            if(isset($response['status']) && $response["status"] == "COMPLETED" ){

                Session::get('order')->save();

                Session::forget('cart');
                Session::forget('topCart');

                return redirect('/cart')->with('status', 'Votre commande a été effectuée avec succès !! ');
            }

        }
        catch(\Exception $e){
            return redirect('/cart')->with('status', $e->getMessage());
        }
    }
}
