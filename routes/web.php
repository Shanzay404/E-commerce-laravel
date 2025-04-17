<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('homePage');
Route::get('/hello', [HomeController::class, 'hello'])->name('hello');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');
Route::get('/Shop', [HomeController::class, 'shop'])->name("home.shop");
Route::get('/Shop/category/{id}', [HomeController::class, 'CategoryProducts'])->name("home.categoryProducts");
Route::get('/Shop/product/{id}', [HomeController::class, 'product'])->name("home.product");

Route::post('/addToCart/{id}', [CartController::class, 'add_cart'])->name("home.add_cart");
Route::get('/show-cart', [CartController::class, 'show_cart'])->name("home.show_cart");
Route::put('/update_cart/{id}', [CartController::class, 'update_cart'])->name("home.update_cart");
Route::delete('/remove_cart/{id}', [CartController::class, 'remove_cart'])->name("home.remove_cart");
Route::get('/checkout', [CartController::class, 'checkout_order'])->name('home.checkout');




// users
Route::get('view-users', [UserController::class, 'viewUsers'])->name('admin.viewUsers');
Route::get('add-user', [UserController::class, 'addUser'])->name('admin.addUser');
Route::post('store-user', [UserController::class, 'storeUser'])->name('admin.storeUser');
Route::get('edit-user/{id}', [UserController::class, 'editUser'])->name('admin.editUser');
Route::put('update-user/{id}', [UserController::class, 'UpdateUser'])->name('admin.updateUser');
Route::delete('delete-user/{id}', [UserController::class, 'destroyUser'])->name('admin.deleteUser');



// permissions 
Route::group(['middleware' => ['role:Super-Admin|Admin']], function(){
    
    

Route::get('/add-Category', [AdminController::class, 'AddCategory'])->name('admin.addCategoryPage');
Route::post('/add-Category', [AdminController::class, 'storeCategory'])->name('admin.addCategory');
Route::get('/view-Category', [AdminController::class, 'show'])->name('admin.viewCategory');
Route::get('/edit-Category/{id}', [AdminController::class, 'EditCategory'])->name('admin.editCategory');
Route::put('/update-Category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
Route::delete('/delete-Category/{id}', [AdminController::class, 'destroyCategory'])->name('admin.deleteCategory');
Route::get('view-orders', [AdminController::class, 'viewOrder'])->name('admin.viewOrders');
Route::get('orderDelivered/{id}', [AdminController::class, 'orderDelivered'])->name('admin.orderDelivered');
Route::get('profile/{id}', [AdminController::class, 'viewProfile'])->name('admin.viewProfile');
Route::put('UpdateProfile/{id}', [AdminController::class, 'UpdateProfile'])->name('admin.UpdateAdmin');
Route::get('changePassword/', [AdminController::class, 'changePassword'])->name('admin.changePassword');
Route::post('UpdatePassword/{id}', [AdminController::class, 'UpdatePassword'])->name('admin.UpdatePassword');


// products

Route::get('/view-Products', [AdminController::class, 'showProducts'])->name('admin.viewProduct');
Route::get('/product-detail/{id}', [AdminController::class, 'productDetail'])->name('admin.productDetail');
Route::get('/Add-Product', [AdminController::class, 'AddProduct'])->name('admin.addProductPage');
Route::post('/Add-Product', [AdminController::class, 'storeProduct'])->name('admin.addProduct');
Route::get('/Edit-Product/{id}', [AdminController::class, 'EditProduct'])->name('admin.editProductPage');
Route::put('/update-Product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');
Route::delete('/delete-Product/{id}', [AdminController::class, 'destoryProduct'])->name('admin.deleteProduct');



Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
// ->middleware('permission:View Role');
// Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')
                                                //  ->middleware('permission:Delete-Role');
Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);
Route::put('roles/{roleId}/add-permission-to-role', [RoleController::class, 'addPermissionToRole']);

});


