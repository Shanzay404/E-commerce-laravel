<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            $categories = Category::count();
            $productCount = Product::count();
            $order = Order::count();
            $users = User::where('usertype', 0)->count();
            return view('admin.dashboard', compact('categories', 'productCount', 'users', 'order'));
        }else{

            return view('frontend.pages.index');
        }

    }


    // show website frontend page
    public function index(){

        // send products to the frontend homepage products section
        $products = Product::all();
        return view('frontend.pages.index', compact('products'));

    }


    // shop page shows all categories

    public function shop(){
        $categories = Category::all();
        $products = Product::latest()->simplePaginate(9);
        return view('frontend.pages.shop', compact('categories', 'products'));
        // return $products;

    }


    // show category based products
    public function CategoryProducts($id){


        try {
            $Id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }

        $category = Category::find($Id);
        $categories = Category::all();

        if (!$category) {
            return abort(404);
        }

        $products = Product::where('category_id', $category->id)->paginate(3);
        // return $category;

        return view('frontend.pages.shop-Category-products', compact('categories', 'products', 'category'));
    }
    public function product(Request $request, $id){



         // Decrypt the ID from the encrypted hash
         try {
            $Id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404); // In case decryption fails
        }

        // Fetch the product using the decrypted ID
        $product = Product::find($Id);

        if (!$product) {
            return abort(404);
        }


       $relatedProducts = Product::where('category_id', $product->category_id)->get();

        return view('frontend.pages.shop-details', compact('product', 'relatedProducts'));

    }






    // cash On delivery

    public function cash_order(){
       $userId = Auth::id();

       $orders = Cart::with('product')->where('user_id', $userId)->get();

       foreach ($orders as $order) {

            Order::create([
                'username' => $order->name,
                'email' => $order->email,
                'user_id' => $order->phone_no,
                'phone' => $order->address,
                'address' => $order->user_id,
                'product_id' => $order->product_id,
                'product_title' => $order->product_title,
                'product_img' => $order->product_img,
                'product_quantity' => $order->product_quantity,
                'product_price' => $order->product_price,
                'payment_status' => "Cash On Delivery",
                'delivery_status' => 'Processing',
            ]);


            $cartId = $order->id;

            $cart = Cart::find($cartId);
            $cart->delete();

       }
       return redirect()->route('home.shop')->withSuccess("Thank You, We've Recieved Your Order! We'll Contact You Soon");
    }
}



