<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
// use App\Http\Controllers\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:Create-Category', ['only'=>['AddCategory', 'storeCategory']]);
        $this->middleware('permission:Update-Category', ['only'=>['EditCategory', 'updateCategory']]);
        $this->middleware('permission:Delete-Category', ['only'=>['destroyCategory']]);


        $this->middleware('permission:Create-Post', ['only'=>['AddProduct', 'storeProduct']]);
        $this->middleware('permission:Update-Post', ['only'=>['EditProduct', 'updateProduct']]);
        $this->middleware('permission:Delete-Post', ['only'=>['destoryProduct']]);


    }
    // ######################################## View Admin Profile ########################################

    public function viewProfile($id){
        $user = User::find($id);
        // return $user;
        return view('admin.pages.Update-Admin-Profile', compact('user'));
    }

    public function UpdateProfile(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => [
                        'required',
                        'email',
                        Rule::unique('users', 'email')->ignore($id),
                    ],
            'phoneNumber' => 'required|numeric|min_digits:9|max_digits:11',
            'address' => 'required|alpha|between:5,50',
        ],[
           'name.required' => 'Name is Required',
           'email.required' => 'Email is Required',
           'phoneNumber.required' => 'Phone Number is Required',
           'address.required' => 'Address is Required',
        ]);
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
            'address' => $request->address,
        ]);
        toastr()->success('Profile Updated Successfully!', ['timeOut'=>6000]);
        return redirect()->back();
    }


    public function changePassword(){
        return view('admin.pages.change-Password');
    }


    public function UpdatePassword(Request $req, $id){
        $req->validate([
            'password' => 'required|confirmed|alpha_num|min:9|max:10',
            'password_confirmation' => 'required',
        ]);
      $user = User::find($id);

          if($req->password == $req->password_confirmation){
              $user->update([
              'password' => Hash::make($req->password)
            ]);
          }

      toastr()->success('Password has been Changed!', ['timeOut'=>6000]);
      return redirect()->back();

    }





    // ######################################## category page coding ########################################
    public function AddCategory(){
        return view('admin.pages.Add-Category');
    }

    public function storeCategory(Request $request){
       $request->validate([
        'category_name'=> 'required',
        'category_image'=> 'required|mimes:png,jpg,jpeg|max:10000',
       ]);

            //    upload image

    $image_name = time().'.'.$request->category_image->extension();
    $request->category_image->move(public_path('upload_category_images'), $image_name);

    $category = Category::create([
        'category_name' => $request->category_name,
        'category_image' => $image_name,
        'created_at' => Carbon::now()->format('d-M-Y')
    ]);
    // toastr()->success('Category Added Successfully!', ['timeOut'=>6000]);
    if($category){
        toastr()->success('Category Added Successfully!', ['timeOut'=>6000]);
    }
    return redirect()->route('admin.viewCategory');

    }



    // show All Category

    public function show(){
        $category = Category::latest()->get();
        return view('admin.pages.view-category', compact('category'));
    }

    public function EditCategory($id){
        $category = Category::find($id);
        return view('admin.pages.update-category', compact('category'));
    }

    public function updateCategory(Request $request, $id){

        $request->validate([
            'category_name'=> 'required',
            'category_image'=> 'nullable|mimes:png,jpg,jpeg|max:10000',
        ]);

        $category = Category::find($id);

        // upload image if it is edited!
        if(isset($request->update_category_image)){
            $image_name = time(). "." .$request->update_category_image->extension();
            $request->update_category_image->move(public_path('upload_category_images'), $image_name);
            $category->category_image = $image_name;
        }

       $category->category_name = $request->category_name;
       $save = $category->save();

       if($save){
        toastr()->success('Category has been Updated!', ['timeOut'=>6000]);
       }
       return redirect()->route('admin.viewCategory');
    }


    // delete Category

    public function destroyCategory($id){


        $category = Category::find($id);

        $image_path = public_path('upload_category_images/'.$category->category_image);
        if(File::exists($image_path)){
            File::delete($image_path);
        }

        $category->delete();   //delete category
        $category->products()->delete();    // delete products which are related to the category
        toastr()->success('category has been deleted!', ['timeOut'=>6000]);
        return redirect()->route('admin.viewCategory');
    }



    // ######################################## Product page coding ########################################


    public function showProducts(){
        $products = Product::with('category')->latest()->get();
        return view('admin.pages.view-products', compact('products'));
    }


    public function AddProduct(){
        $category_names = Category::get();
        return view('admin.pages.Add-Product', compact('category_names'));
    }
    public function storeProduct(Request $request){

        $request->validate([
            'title'=> 'required',
            'quantity'=> 'required',
            'price'=> 'required',
           'discount' => 'nullable|numeric|min:0|max:100',
            'category'=> 'required',
            'description'=> 'required',
            'image'=> 'required|mimes:png,jpg,jpeg|max:10000',
           ],[
            'title.required' => 'Product Title is Required',
            'quantity.required'=> 'Quantity is Required',
            'price.required'=> 'Price is Required',
            'category.required'=> 'Category is Required',
            'description.required'=> 'Description is Required',
            'image.required'=> 'Image is Required',
           ]);

           $product_img_name = time().'.'.$request->image->extension();
           $request->image->move(public_path('upload_product_images'), $product_img_name);

           $productAdd = Product::create([
            'product_title' => $request->title,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'discount_price' => $request->discount,
            'category_id' => $request->category,
            'product_description' => $request->description,
            'product_image' => $product_img_name,
           ]);

           if($productAdd){
               toastr()->success('Product Added Successfully!', ['timeOut'=>6000]);
           }
        //    return redirect()->back();
           return redirect()->route('admin.viewProduct');


    }




    public function EditProduct($id){
        $product = Product::find($id);
        $category_names = Category::all();
        return view('admin.pages.Update-Product', compact('product', 'category_names'));
    }


    public function updateProduct(Request $request, $id){
        $request->validate([
            'title'=> 'required',
            'quantity'=> 'required',
            'price'=> 'required',
           'discount' => 'nullable|numeric|min:0|max:100',
            'category'=> 'required',
            'description'=> 'required',
            'image'=> 'nullable|mimes:png,jpg,jpeg|max:10000',
           ]);

           $product = Product::find($id);
           if(isset($request->image)){
            $product_img_name = time().'.'.$request->image->extension();
           $request->image->move(public_path('upload_product_images'), $product_img_name);

           $product->product_image = $product_img_name;
           }

           $product->product_title = $request->title;
           $product->quantity = $request->quantity;
           $product->price = $request->price;
           $product->discount_price = $request->discount;
           $product->category_id = $request->category;
           $product->product_description = $request->description;
           $productSave = $product->save();

           if($productSave){
               toastr()->success('Product Updated Successfully!', ['timeOut'=>6000]);
           }
           return redirect()->route('admin.viewProduct');
    }


    // delete Product

    public function destoryProduct($id){

        $product = Product::find($id);

        $image_path = ('upload_product_images/'.$product->product_image);

        if(File::exists($image_path)){
            File::delete($image_path);
        }


       $productDelete = $product->delete();
        if($productDelete){
            toastr()->success('Product has been deleted!', ['timeOut'=>6000]);
        }
        return redirect()->route('admin.viewProduct');


    }

    // view single product details

    public function productDetail($id){

        $product = Product::with('category')->find($id);
        return view('admin.pages.view-single-products', compact('product'));

    }

    // View Orders

    public function viewOrder(){
        $orders = Order::with('OrderDetail')->with('user')->get();
        return view('admin.pages.ViewOrders', compact('orders'));
    }

    // after clicking on delivered btn the order will be delivered on the customer address
    public function orderDelivered($id){

        $order = Order::find($id);
        $order->update([
            'delivery_status' => "Delivered"
        ]);
        return redirect()->back();
    }
}
