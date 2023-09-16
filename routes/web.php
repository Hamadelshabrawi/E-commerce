<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeContoller;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Product;
use App\Models\invoice;
use App\Models\User;
use App\Models\subscribe;
use App\Models\Refund;
use App\Models\productscomment;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeContoller::class,'index']);
Route::get('logout', [HomeContoller::class, 'logout']);
Route::post('subscribe', [HomeContoller::class, 'subscribe']);
Route::get('/single_product', [HomeContoller::class,'single_product']);
Route::get('/more_details/{id}', [HomeContoller::class,'more_details']);
Route::get('produc_search',[HomeContoller::class,'produc_search']);
Route::post('commentmessage/{id}',[HomeContoller::class,'commentmessage']);
Route::get('products_page',[HomeContoller::class,'products_page']);
Route::get('autocomplete', [HomeContoller::class, 'autocomplete'])->name('autocomplete');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect', function (){

    if(Auth::user()->usertype == '1'){

        // data in admin panel
        $TotalProducts = Product::all()->count();
        $TotalOrderss = invoice::all()->count();
        $TotalUserss = User::where('usertype', '0')->count();
        $TotalAdmin = User::where('usertype', '1')->count();
        $TotalRevenue = invoice::all()->sum('total');
        $TotalOrderDelivery = invoice::where('delivery','=','Approved')->count();
        $TotalOrderWaitingApproval = invoice::where('delivery','=','waiting for delivery')->count();
        $TotalOrderPaid = invoice::where('paid_by','=','paid')->count();
        $TotalOrdercashOnDelivery = invoice::where('paid_by','=','Cash on delivery')->count();
        $subscribe = subscribe::all()->count();
         

        return view('admin.dashboard.home',compact('TotalProducts','subscribe','TotalOrderss','TotalUserss','TotalAdmin','TotalRevenue','TotalOrderDelivery','TotalOrderWaitingApproval','TotalOrderPaid','TotalOrdercashOnDelivery'));
    }else{
        $userid = Auth::user()->id;
        $user_name = Auth::user()->name;
        $total_order = invoice::where('user_id',$userid)->count();
        $total_refunds = Refund::where('user_id',$userid)->count();
        $total_comment = productscomment::where('user_id',$userid)->whereNotNull('comment')->count();
        $pending_orders = invoice::where('user_id',$userid)->where('delivery','waiting for delivery')->count();
        $subscribe = subscribe::where('user_id',$userid)->count();
        
        return view('home.dashboard.user',compact('user_name','total_order','total_refunds','total_comment','pending_orders','subscribe'));

    }
    
})->middleware(['auth','verified']);

// Route::get('/redirect', [HomeContoller::class,'redirect'])->middleware(['auth','verified','admin']);



Route::middleware('admin')->group(function(){

    Route::get('/view_category', [AdminController::class,'view_category']);
    Route::post('/add_category', [AdminController::class,'add_category']);
    Route::post('/delete_category/{id}', [AdminController::class,'delete_category']);
    Route::get('/view_product', [AdminController::class,'view_product']);
    Route::get('/show_product', [AdminController::class,'show_product']);
    Route::post('/add_product', [AdminController::class,'add_product']);
    Route::post('/delete_product/{id}', [AdminController::class,'delete_product']);
    Route::get('/edit_product/{id}', [AdminController::class,'edit_product']);
    Route::get('/pdf_product/{id}', [AdminController::class,'pdf_product']);
    Route::post('/edit_product_confirm/{id}', [AdminController::class,'edit_product_confirm']);
    Route::get('/cash_order/{id}', [AdminController::class,'cash_order']);
    Route::get('/stripe/{totalPrice}', [AdminController::class,'stripe']);
    Route::post('stripe/{totalPrice}', [AdminController::class ,'stripePost'])->name('stripe.post');
    Route::get('show_order',[AdminController::class,'show_order']);
    Route::get('show_invoice',[AdminController::class,'show_invoice']);
    Route::get('single_invoice/{id}',[AdminController::class,'single_invoice']);
    Route::post('change_delivery_to_Approve/{id}',[AdminController::class,'change_delivery_to_Approve']);
    Route::get('show_users',[AdminController::class,'show_users']);
    Route::post('delete_user/{id}',[AdminController::class,'delete_user']);
    Route::post('edit_userype_one/{id}',[AdminController::class,'edit_userype_one']);
    Route::get('send_email/{id}',[AdminController::class,'send_email']);
    Route::get('send/{id}',[AdminController::class,'send']);
    Route::get('show_refund', [AdminController::class, 'show_refund']);
    Route::post('refund_approve/{id}', [AdminController::class, 'refund_approve']);
    Route::post('edit_categ_name/{id}', [AdminController::class, 'edit_categ_name']);
    Route::post('edit_categ_status/{id}', [AdminController::class, 'edit_categ_status']);
    Route::get('Show_subscribes', [AdminController::class, 'Show_subscribes']);
    Route::post('admin_delete_subscribe/{id}', [AdminController::class, 'admin_delete_subscribe']);
    Route::post('remove_image_edite_product/{id}', [AdminController::class, 'remove_image_edite_product']);
    Route::get('admin_searchProduct', [AdminController::class, 'admin_searchProduct']);
    Route::get('search', [AdminController::class, 'search']);
    Route::get('Admin_invoice_search', [AdminController::class, 'Admin_invoice_search']);
    Route::get('Admin_users_search', [AdminController::class, 'Admin_users_search']);
    Route::get('Admin_refund_search', [AdminController::class, 'Admin_refund_search']);
    Route::get('Admin_subscribe_search', [AdminController::class, 'Admin_subscribe_search']);
});


Route::middleware('verified')->group(function(){

    Route::post('/add_cart/{id}', [HomeContoller::class,'add_cart']);
    Route::get('/showcart', [HomeContoller::class,'showcart']);
    Route::post('/remove_cart_product/{id}', [HomeContoller::class,'remove_cart_product']);
    Route::post('delete_comment/{id}',[HomeContoller::class,'delete_comment']);
    Route::post('makeLike/{id}',[HomeContoller::class,'makeLike']);
    Route::get('my_order', [HomeContoller::class, 'my_order'])->name('my_order');
    Route::get('show_my_invoice/{id}', [HomeContoller::class, 'show_my_invoice']);
    Route::post('refund/{id}', [HomeContoller::class, 'refund']);
    Route::get('myRefund', [HomeContoller::class, 'myRefund']);
    Route::get('mycomment', [HomeContoller::class, 'mycomment']);
    Route::post('remove_mycomment/{id}', [HomeContoller::class, 'remove_mycomment']);
    Route::post('remove_subscribe', [HomeContoller::class, 'remove_subscribe']);
    Route::post('Quick_add_cart/{id}', [HomeContoller::class, 'Quick_add_cart']);
});
