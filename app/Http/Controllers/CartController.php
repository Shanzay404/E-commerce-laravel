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
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

       // add product to the cart

       public function add_cart(Request $request, $id){

        if(Auth::id()){

        $userId = auth()->user()->id;
        $user = Auth::user();

        try {
            $Id = Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }

        $product = Product::find($Id);

        if (!$product) {
            return abort(404);
        }

     \Cart::session($userId)->add(array(
            'id' => $product->id, // inique row ID
            'name' => $product->product_title,
            'price' => (float)$product->price - (((float)$product->discount_price * (float)$product->price)/100),
            'quantity' => $request->quantity,
            'attributes' => array(
                'username' => $user->name,
                'email' => $user->email,
                'phone_no' => $user->phone,
                'address' => $user->address,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'product_img' => $product->product_image,
                'product_category' => $product->category_id,
            ),
        ));

        toastr()->success('Product Added to the Cart!', ['timeOut'=>6000]);
        // toastr.success('hi', '', []);

        return redirect()->back();

        }else{
            return redirect('login');
        }
    }


    // view Cart

    public function show_cart(){

        if(Auth::id()){

            $userId = Auth::id();
            $cart = \Cart::session($userId)->getContent();
            $cart->each(function($item) {

                $item->product = Product::find($item->attributes->product_id);

            });

            $subTotal = \Cart::session($userId)->getTotal();
            // die;
            return view('frontend.pages.shopping-cart', compact('cart', 'subTotal'));
        }
        else
        {
            return redirect('login');
        }

    }

    // Update Cart


    public function update_cart(Request $request, $id) {
        if (Auth::check()) {
            $userId = Auth::id();

            $productPrice = $request->input('cart_item_price');
            $newQuantity = $request->input('cart_item_quantity');

            // Update the cart item with new quantity
           \Cart::session($userId)->update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $newQuantity,
                ],
                'price' => $productPrice,
            ]);

            // Calculate the subtotal after the update
             $subTotal = \Cart::session($userId)->getSubTotal();
             toastr()->success('Cart updated successfully!', ['timeOut'=>6000]);
            return redirect()->back()->with('subTotal', $subTotal);
        } else {
            return redirect('login');
        }
    }

    // remove cart item from the cart

    public function remove_cart($id){

        $userId = Auth::id();
        \Cart::session($userId)->remove($id);
        return redirect()->back();

    }



    // After CheckOut Items will be added to the Order and Order detail table

    public function checkout_order(Request $request){

        $userId = Auth::id();
        $cart =\Cart::session($userId)->getContent();

        $TotalPrice = \Cart::getTotal();


        $order = Order::create([
            'total_price' => $TotalPrice,
            'user_id' => $userId,
            'created_at' => Carbon::now()->format('d-M-Y')
        ]);

         // Create order details

         foreach ($cart as $cart_item) {
            $order_detail = OrderDetail::create([
                'item_id' => $cart_item->id,
                'item_price' => $cart_item->price,
                'item_name' => $cart_item->name,
                'item_quantity' => $cart_item->quantity,
                'item_category' => $cart_item->attributes->product_category,
                'order_id' => $order->id,
            ]);
         }

        //  clear the cart
        \Cart::session($userId)->clear();

        toastr()->success("Thank You, We've Recieved Your Order! We'll Contact You Soon!", ['timeOut'=>6000]);
        return redirect()->route('home.shop');

    }


}
