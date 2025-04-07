<?php

use App\Http\Controllers\{
    CartController,
    CheckoutController,
    HomeController,
    productController,
    ReviewController,
    UserController,
    WishlistController
};
use App\Http\Controllers\Admin\{CouponController,
    UserController as AdminUserController,
    ProductController as AdminProductController,
    ReviewController as AdminReviewController,
    RoleController,
    CategoryController,
    OrderController
};
use App\Http\Middleware\UserRole;
use Illuminate\Support\Facades\Route;

Route::middleware([UserRole::class . ':admin'])->group(function () {
    Route::get('/admin/roles', [RoleController::class, 'index']);
    Route::get('/admin/role', [RoleController::class, 'create']);
    Route::post('/admin/role', [RoleController::class, 'store']);

    Route::get('/admin/role/{role}', [RoleController::class, 'edit']);
    Route::patch('/admin/role/{role}', [RoleController::class, 'update']);
    Route::delete('/admin/role/{role}', [RoleController::class, 'destroy']);

    Route::get('/admin/user/roles', [AdminUserController::class, 'roles']);
    Route::get('/admin/user/{user}/role/{role}', [AdminUserController::class, 'editRole']);
    Route::patch('/admin/user/{user}/role', [AdminUserController::class, 'updateRole']);

    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::get('/admin/category', [CategoryController::class, 'create']);
    Route::post('/admin/category', [CategoryController::class, 'store']);

    Route::get('/admin/category/{category}', [CategoryController::class, 'edit']);
    Route::patch('/admin/category/{category}', [CategoryController::class, 'update']);
    Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy']);

    Route::get('/admin/coupons', [CouponController::class, 'index']);
    Route::get('/admin/coupon', [CouponController::class, 'create']);
    Route::post('/admin/coupon', [CouponController::class, 'store']);

    Route::get('/admin/coupon/{coupon}', [CouponController::class, 'edit']);
    Route::patch('/admin/coupon/{coupon}', [CouponController::class, 'update']);
    Route::delete('/admin/coupon/{coupon}', [CouponController::class, 'destroy']);
});

Route::middleware([UserRole::class . ':admin,seller'])->group(function () {
    Route::get('/admin', [AdminUserController::class, 'index']);

    Route::get('/admin/user/{user}', [AdminUserController::class, 'edit']);
    Route::patch('/admin/user/{user}', [AdminUserController::class, 'update']);
    Route::delete('/admin/user/{user}', [AdminUserController::class, 'destroy']);

    Route::get('/admin/products', [AdminProductController::class, 'index']);
    Route::get('/admin/product', [AdminProductController::class, 'create']);
    Route::post('/admin/product', [AdminProductController::class, 'store']);

    Route::get('/admin/product/{product}', [AdminProductController::class, 'edit']);
    Route::patch('/admin/product/{product}', [AdminProductController::class, 'update']);
    Route::delete('/admin/product/{product}', [AdminProductController::class, 'destroy']);

    Route::get('/admin/product/image/{product}', [AdminProductController::class, 'createImage']);
    Route::post('/admin/product/image/{product}', [AdminProductController::class, 'storeImage']);
    Route::delete('/admin/product/image/{productImage}', [AdminProductController::class, 'destroyImage']);

    Route::get('/admin/orders', [OrderController::class, 'index']);

    Route::get('/admin/order/{order}', [OrderController::class, 'edit']);
    Route::patch('/admin/order/{order}', [OrderController::class, 'update']);
    Route::delete('/admin/order/{order}', [OrderController::class, 'destroy']);

    Route::get('/admin/order/items/{order}', [OrderController::class, 'editItems']);
    Route::patch('/admin/order/item/{orderItem}', [OrderController::class, 'updateItems']);
    Route::delete('/admin/order/item/{orderItem}', [OrderController::class, 'destroyItems']);

    Route::get('/admin/reviews', [AdminReviewController::class, 'index']);

    Route::get('/admin/review/{review}', [AdminReviewController::class, 'edit']);
    Route::patch('/admin/review/{review}', [AdminReviewController::class, 'update']);
    Route::delete('/admin/review/{review}', [AdminReviewController::class, 'destroy']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contacts', [HomeController::class, 'contacts']);
Route::get('/search', [HomeController::class, 'search']);

Route::get('/feedback', [HomeController::class, 'feedback']);
Route::post('/feedback', [HomeController::class, 'store']);

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');

Route::get('/catalog/{category?}', [ProductController::class, 'index']);
Route::get('/product/{product}', [ProductController::class, 'show']);

Route::get('product/{product}/review/{review}/edit', [ProductController::class, 'show']);
Route::patch('product/{product}/review/{review}', [ReviewController::class, 'update']);
Route::delete('product/{product}/review/{review}', [ReviewController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::patch('/users/{user}', [UserController::class, 'update']);

    Route::get('/users/{user}/addresses', [UserController::class, 'addresses']);
    Route::patch('/users/{user}/addresses', [UserController::class, 'updateAddress']);

    Route::get('/users/{user}/cards', [UserController::class, 'cards']);
    Route::get('/users/{user}/card/{card}', [UserController::class, 'cards']);
    Route::patch('/users/{user}/card/{card}', [UserController::class, 'updateCard']);

    Route::get('/users/{user}/password', [UserController::class, 'password']);
    Route::patch('/users/{user}/password', [UserController::class, 'updatePassword']);

    Route::get('/users/{user}/orders', [UserController::class, 'orders']);
    Route::get('/users/{user}/orders/pending', [UserController::class, 'orders']);
    Route::get('/users/{user}/orders/delivered', [UserController::class, 'orders']);
    Route::get('/users/{user}/orders/canceled', [UserController::class, 'orders']);
    Route::get('/users/{user}/order/{order}', [UserController::class, 'order']);

    Route::patch('/users/{user}/photo', [UserController::class, 'updatePhoto']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::get('product/{product}/review', [ReviewController::class, 'create']);
    Route::post('product/{product}/review', [ReviewController::class, 'store']);

    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist/{product}', [WishlistController::class, 'store']);
    Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/{product}', [CartController::class, 'store']);
    Route::patch('/cart/{cartItem}', [CartController::class, 'update']);
    Route::delete('/cart/{product}', [CartController::class, 'destroy']);

    Route::post('/coupon', [CartController::class, 'coupon']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'store']);
    Route::get('/complete', [CheckoutController::class, 'complete']);
});
