<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use PDF;
use App\Models\Invoice;
use App\Models\Refund;
use App\Models\Subscribe;
use App\Models\ProductImage;
use Session;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Notification;
use App\Notifications\DemoNotification;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\JoinClause;




class AdminController extends Controller
{
    public function view_category(){
        if( Auth::id() && Auth::user()->usertype == 1 ){
            $data = category::all();
            return view('admin.dashboard.include.category',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function add_category(Request $request){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $data = new Category;
            $data->category_name = $request->category_name;
            if($request->hasFile('image')) {

                $image = $request->file('image');
                $name = $image->hashName();
                $destinationPath = public_path('/storage/uploads');
                $data->image = $image->move($destinationPath, $name);
                $data->image = $name;

                }

            $data->save();
            return redirect()->back()->with('message','Category Added Successfully');
        }else{
            return redirect('login');
        }

    }

    public function delete_category($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $data = Category::find($id);
            $image_name = $data->image;
            $image_path = public_path('/storage/uploads/'.$image_name);
            if(file_exists($image_path)){
              unlink($image_path);
            }
            $data->delete();
            return redirect()->back()->with('message','Category wass deleted Successfully');
        }else{
            return redirect('login');
        }
    }

    public function delete_product($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            // Remove Image From Storage Folder and media table
            $product = product::findOrFail($id);
            $imgName = ProductImage::where('producId',$id)->get();
            foreach($imgName as $imageNamee){
                $image_name = $imageNamee->imageName;
                $image_path = public_path('/storage/uploads/'.$image_name);
                if(file_exists($image_path)){
                  unlink($image_path);
                }
            }
            $imgName = ProductImage::select('imageName')->where('producId',$id)->delete();
            $product->delete();
            $cart = cart::where('productId', $id)->delete();
            $image = ProductImage::where('producId',$id)->delete();
            Alert::success('Product wass deleted Successfully');

            return redirect()->back();

        }else{
            return redirect('login');
        }
    }

    public function view_product(){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $category = category::where('active','1')->get();
            return view('admin.dashboard.include.product',compact('category'));
        }else{
            return redirect('login');
        }

    }

    public function show_product(){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $products = product::paginate(20);
            return view('admin.dashboard.include.show_product',compact('products'));
        }else{
            return redirect('login');
        }
    }

    public function admin_searchProduct(Request $request){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $search = $request->name;
            $products = product::SELECT('*')->where('title','LIKE',"%$search%")->orWhere('Sku','LIKE',"%$search%")->paginate(20);
            return view('admin.dashboard.include.show_product_search_result',compact('products'));
        }else{
            return redirect('login');
        }
    }

    public function autocomplete(Request $request)
    {
        $res = Product::select("title")
                ->where("title","LIKE","%{$request->name}%")
                ->orWhere('Sku','LIKE',"%$request->name%")
                ->get();
        return response()->json($res);
    }

       public function search(){
            return view('admin.dashboard.search');
        }

    public function edit_product($id){

        $userType = Auth::user()->usertype;
        if(   $userType == 1 && Auth::id()){
            $products = product::find($id);
            $category = category::where('active','1')->get();
            // dd($category);
            $media = ProductImage::where('producId',$id)->get();
            $mediaa = ProductImage::where('producId',$id)->get();
            return view('admin.dashboard.include.edit_product',compact('products','category','media','mediaa'));
        }else{
            return redirect('login');
        }
    }

    public function pdf_product($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $products = product::find($id);
            $pdf = PDF::loadView('admin.dashboard.include.product_pdf',compact('products'));
            return $pdf->download('product.pdf');
        }else{
            return redirect('login');
        }
    }

    public function add_product(Request $request){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $validate  = Validator::make($request->all(), [
                'image' => 'required',
                'Sku' => 'required|unique:products',
                'product_title' => 'required',
                'product_pricee' => 'required|numeric|integer|min:0',
            ]);


            if($validate->fails()){
                return back()->withErrors($validate)->withInput();
            }

            if($request->discount_price >= $request->product_pricee ){
                Alert::warning('msg','Discount is equal or greater  then price');
                return redirect()->back();
            }
            $product = new Product;
            $product->title = $request->product_title;
            $product->description = $request->description;
            $product->category = $request->category;
            $product->quantity = $request->quantity;
            $product->price = $request->product_pricee;
            $product->discount_price = $request->discount_price;
            $product->active = $request->active;
            $product->Sku = $request->Sku;
            $product->featured = $request->featured;
            $product->save();
            if($request->hasFile('image')) {

                foreach($request->file('image') as $file)
                {
                    $product_img = new ProductImage;
                    $product_img->producId = $product->id;


                    $name = $file->hashName();
                    $destinationPath = public_path('/storage/uploads');

                    $product_img->imageName = $file->move($destinationPath, $name);
                    $product_img->imageName = $name;

                    $product_img->save();
                }

            $productId = Product::where('id',$product->id)->update([
                    'image' => $name,
                ]);
            }
            Alert::success('Done','Product Was Added Successfully');

            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function edit_product_confirm(Request $request,$id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $validate  = Validator::make($request->all(), [
                'image' => 'required',
                'Sku' => 'required|unique:products',
                'product_title' => 'required',
                'product_pricee' => 'required|numeric|integer|min:0',
            ]);


            // if($validate->fails()){
            //     return back()->withErrors($validate)->withInput();
            // }

            if($request->discount_price >= $request->product_pricee ){
                Alert::warning('msg','Discount is equal or greater  then price');
                return redirect()->back();
            }
            $product = product::find($id);

            $product->title = $request->product_title;
            $product->description = $request->description;
            $product->category = $request->category;
            $product->featured = $request->featured;
            $product->quantity = $request->quantity;
            $product->price = $request->product_pricee;
            $product->discount_price = $request->discount_price;
            $product->active = $request->active;
            $product->Sku = $request->Sku;

            if($request->image) {
                // $productId = Product::select('id')->orderBy('id','DESC')->first();

                foreach($request->file('image') as $file)
                {
                    $product_img = new ProductImage;
                    $product_img->producId = $id;


                    $name = $file->hashName();
                    $destinationPath = public_path('/storage/uploads');

                    $product_img->imageName = $file->move($destinationPath, $name);
                    $product_img->imageName = $name;

                    $product_img->save();
                }
                $productId = Product::where('id',$id)->update([
                    'image' => $name,
                ]);
            }
            $product->save();
            return redirect()->back()->with('message','Product Was Updated Successfully');
        }else{
            return redirect('login');
        }
    }

    public function remove_image_edite_product($id){

        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $imgName = ProductImage::find($id);
            $image_name = $imgName->imageName;
            $image_path = public_path('/storage/uploads/'.$image_name);
            if(file_exists($image_path)){
              unlink($image_path);
            }
            ProductImage::find($id)->delete();
            return redirect()->back()->with('message','Product Image Was Deleted Successfully');

        }else{

            return redirect('login');
        }
    }


    public function show_order(){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $orders = Order::all();
            return view('admin.dashboard.include.show_order',compact('orders'));
        }else{
            return redirect('login');
        }
    }

    public function show_invoice(){

        if(  Auth::id() && Auth::user()->usertype == 1 ){
         $invoice = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                            ->select('invoices.*','users.name')
                            ->paginate(20);
            return view('admin.dashboard.include.show_invoice',compact('invoice'));

        }else{
                return redirect('login');
            }
    }

    public function Admin_invoice_search(Request $request)
    {

        $invoice = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
                            ->select('invoices.*','users.name')
                            ->where("order_id","LIKE","%{$request->search}%")
                            ->orWhere("name","LIKE","%{$request->search}%")
                            ->paginate(20);
        return view('admin.dashboard.include.show_invoice_search',compact('invoice'));
    }

    public function single_invoice($id){

        if(  Auth::id() && Auth::user()->usertype == 1 ){

            // $orders_invoice = DB::select(" select * from orders where order_id = $id");
            $orders_invoice = Order::where('order_id',$id)->get();
            $orders_invoice_name = Order::where('order_id',$id)->first();


            $price = order::where('order_id', '=', $id)->sum('price_muliply_qty');
            $totalPrice = order::where('order_id', '=', $id)->sum('Total_price');
            // dd($orders_invoice_name);

            $diff = DB::select("SELECT SUM(price_muliply_qty-Total_price) AS DIFF FROM orders WHERE order_id = $id");
            $difference = array_column($diff, 'DIFF');
            $difference = $difference[0];

            $totalDiscount = $price - $difference ;
            return view('admin.dashboard.include.single_invoice',compact('orders_invoice','orders_invoice_name','price','totalPrice','difference','totalDiscount'));

        }else{
            return redirect('login');
        }

    }

    public function cash_order(Request $request,$id){

        if( Auth::id()){
            $user = Auth::user()->id;
            $cart = Cart::find($id);
            $products = Product::all();

            // generate invoice id
            $oldOrderData = DB::select(" select MAX(id) from orders  ");
            $myarr = array_column($oldOrderData, 'MAX(id)');
            $Lastorder_id = $myarr[0] + 1;

            $cart = DB::select(" select * from carts where userId = $user");
            $Invoices = new Invoice;

            $price = cart::where('userId', '=', $user)->sum('price_muliply_qty');

            $diff = DB::select("SELECT SUM(price_muliply_qty-totalPrice) AS DIFF FROM carts WHERE userId = $user");
            $difference = array_column($diff, 'DIFF');
            $difference = $difference[0];

            $totalDiscount = $price - $difference ;

            $Invoices->total =  $totalDiscount;


            //           {   can also use this   }
            //  cart::where('userId', '=', $user)->get();


                foreach ($cart as $cart) {
                    $products = Product::all();

                    $order = new Order;
                    $order->user_id = Auth::user()->id;
                    $order->user_name= Auth::user()->name;
                    $order->user_phone = Auth::user()->phone;
                    $order->user_address = Auth::user()->address;
                    $order->user_email = Auth::user()->email ;

                    $order->product_id = $cart->productId;
                    $order->product_title = $cart->product_title;
                    $order->product_image = $cart->image;
                    $order->product_quantity = $cart->quantity;
                    $order->product_sale_price = $cart->price ;
                    $order->product_discount = $cart->discount ;
                    $order->Total_price = $cart->totalPrice ;

                    $order->price_muliply_qty = $cart->price_muliply_qty ;

                    $order->order_id  = $Lastorder_id ;
                    $order->admin_status = "No Action";

                    $order->payment_status = 'Cash on delivery';

                    $order->delivery_status = 'waiting for delivery';

                    $products_existing_qty = DB::select(" select quantity from products where id = $cart->productId");

                    $myarr = array_column($products_existing_qty, 'quantity');

                    $products_existing_qty = $myarr[0] ;

                        // update and decrease number of quantity after making order
                    product::where('id', $cart->productId)->update([
                        'quantity' => $products_existing_qty - $order->product_quantity,
                    ]);
                    $order->save();
                }

            $Invoices->order_id = $Lastorder_id;
            $Invoices->user_id = Auth::user()->id;
            $Invoices->delivery = 'waiting for delivery';
            $Invoices->paid_by = 'Cash on delivery';

            $Invoices->save();



            cart::where('userId', '=', $user)->delete();

            $details = [
                'greeting' => 'Hi',
                'body' => 'This is To modify you that , you was made an order By Cash On delivery',
                'thanks' => 'Thank you for using Hamad E-commerce',
                'actionText' => 'View My Site',
                'actionURL' => url('/'),
                'order_id' => 'Order id'
            ];
            $user = User::find($id);

            Notification::send($user, new DemoNotification($details));
            // Alert::success('We have recived Your order','We will contact you soon');
            return redirect()->back();
        }else{

            return view('auth.login');

        }
    }

    public function stripe($totalPrice){
        if(Auth::id()){

            return view('home.payment_order',compact('totalPrice'));

        }else{
            return redirect('login');
        }
    }

    public function stripePost(Request $request, $totalPrice)

    {
        if(Auth::id()){

            if($totalPrice >= 20 ) {
                $user = Auth::user()->id;

                // $cart = Cart::find($id);

                // generate invoice number
                $oldOrderData = DB::select(" select MAX(id) from orders  ");
                $myarr = array_column($oldOrderData, 'MAX(id)');
                $Lastorder_id = $myarr[0] + 1;

                $cart = DB::select(" select * from carts where userId = $user");

                //           {   can also use this   }
                //  cart::where('userId', '=', $user)->get();


                $Invoices = new Invoice;

                $price = cart::where('userId', '=', $user)->sum('price_muliply_qty');

                $diff = DB::select("SELECT SUM(price_muliply_qty-totalPrice) AS DIFF FROM carts WHERE userId = $user");
                $difference = array_column($diff, 'DIFF');
                $difference = $difference[0];

                $totalDiscount = $price - $difference ;

                $Invoices->total =  $totalDiscount;

                    foreach ($cart as $cart) {

                        $order = new Order;
                        $order->user_id = Auth::user()->id;
                        $order->user_name= Auth::user()->name;
                        $order->user_phone = Auth::user()->phone;
                        $order->user_address = Auth::user()->address;
                        $order->user_email = Auth::user()->email ;

                        $order->product_id = $cart->productId;
                        $order->product_title = $cart->product_title;
                        $order->product_image = $cart->image;
                        $order->product_quantity = $cart->quantity;
                        $order->product_sale_price = $cart->price ;
                        $order->product_discount = $cart->discount ;
                        $order->Total_price = $cart->totalPrice ;

                        $order->price_muliply_qty = $cart->price_muliply_qty ;

                        $order->order_id  = $Lastorder_id ;

                        $order->admin_status = "no action";

                        $order->payment_status = 'Paid';

                        $order->delivery_status = 'waiting for delevery';

                        $products_existing_qty = DB::select(" select quantity from products where id = $cart->productId");

                        $myarr = array_column($products_existing_qty, 'quantity');

                        $products_existing_qty = $myarr[0] ;

                        // update and decrease number of quantity after making order
                        product::where('id', $cart->productId)->update([
                            'quantity' => $products_existing_qty - $order->product_quantity,
                        ]);

                        $order->save();

                    }

                    $Invoices->order_id = $Lastorder_id;
                    $Invoices->user_id = Auth::user()->id;
                    $Invoices->delivery = 'waiting for delivery';
                    $Invoices->paid_by = 'Paid';

                    $Invoices->save();

                    cart::where('userId', '=', $user)->delete();

                    $details = [
                        'greeting' => 'Hi',
                        'body' => 'This is To modify you that , you was made an order And You was paid by card',
                        'thanks' => 'Thank you for using Hamad E-commerce',
                        'actionText' => 'View My Site',
                        'actionURL' => url('/'),
                        'order_id' => 'Order id'
                    ];
                    $id = Auth::user()->id;
                    $user = User::find($id);

                    Notification::send($user, new DemoNotification($details));


            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



            Stripe\Charge::create ([

                    "amount" => $totalPrice * 100,

                    "currency" => "usd",

                    "source" => $request->stripeToken,

                    "description" => "Payment Succsess"

            ]);

            Alert::success('success', 'Payment successful!');

            return redirect('/');
        }

    }else{
            return view('auth.login');
        }

    }


    public function change_delivery_to_Approve($id){

        $userType = Auth::user()->usertype;
        if(   $userType == 1 && Auth::id()){


        $approved =  invoice::find($id);
        $approved->delivery = 'Approved';
        $approved->save();

        return redirect()->back();

        }else{
            return redirect('login');
        }

    }

    public function show_users(){

        if(  Auth::id() && Auth::user()->usertype == 1 ){

            $users =  user::paginate(20);
            return view('admin.dashboard.include.show_users',compact('users'));

        }else{
            return redirect('login');
        }

    }

    public function Admin_users_search(Request $request){
        if(  Auth::id() && Auth::user()->usertype == 1 ){

            // $users =  user::paginate(20);
            $users = user::where("name","LIKE","%{$request->search}%")
            ->orWhere("email","LIKE","%{$request->search}%")
            ->paginate(20);
            return view('admin.dashboard.include.show_users_search',compact('users'));

        }else{
            return redirect('login');
        }

    }


    public function delete_user($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $users =  user::find($id);
            $users->delete();

            return redirect()->back()->with('message','user was Deleted');

        }else{
            return redirect('login');
        }

    }

    public function edit_userype_one($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
        $users =  user::find($id);
            if($users->usertype == '0'){
                $users->usertype = 1;
                $users->save();

                Alert::success('Done','user was Changes to admin');
                return redirect()->back();
            }else{
                $users->usertype = 0;

            }
        $users->save();
        Alert::success('Done','admin was Changes to user');
            return redirect()->back();
        }else{
            return redirect('login');
        }
}

    public function send_email($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $order = Order::find($id);

            return view('admin.dashboard.include.email_info',compact('order'));

        }else{
            return redirect('login');
        }

    }

    public function show_refund(){
        if(  Auth::id() && Auth::user()->usertype == 1 ){

            $refund = Refund::join('users', 'users.id', '=', 'refunds.user_id')
            ->select('refunds.*','users.name')
            ->paginate(20);
            $refunds = DB::select('SELECT Refunds.*,name as adminname FROM Refunds LEFT JOIN users ON Refunds.admin_id = users.id ');
            $adminname = array_column($refunds, 'adminname');

            return view('admin.dashboard.include.show_refund',compact('refund','adminname'));

        }else{
            return redirect('login');
        }
    }

    public function Admin_refund_search(Request $request){
        if(  Auth::id() && Auth::user()->usertype == 1 ){

            $refund = Refund::join('users', 'users.id', '=', 'refunds.user_id')
                            ->select('refunds.*','users.name')
                            ->where("name","LIKE","%{$request->search}%")
                            ->orWhere("order_id","LIKE","%{$request->search}%")
                            ->paginate(20);
                        // dd($refund);
                        $refunds = DB::select('SELECT Refunds.*,name as adminname FROM Refunds LEFT JOIN users ON Refunds.admin_id = users.id ');
                        $adminname = array_column($refunds, 'adminname');
            return view('admin.dashboard.include.show_refund_search',compact('refund','adminname'));

        }else{
            return redirect('login');
        }
    }

    public function refund_approve($id){
        $userType = Auth::user()->usertype;
            if(   $userType == 1 && Auth::id()){
                $adminid = Auth::user()->id;
                $refundd = Refund::find($id);

                if( $refundd->admin_approved == 'Approved' ){
                    Refund::where('id',$id)->update([
                        'admin_approved' => 'Pending',
                        'admin_id' => ' ',
                    ]);
                    return redirect()->back();
                }
            $userId= $refundd->user_id;
            $refundd->admin_approved = 'Approved';
            $refundd->admin_id = $adminid;
            $refundd->save();

            $refund = User::join('Refunds', 'users.id', '=', 'refunds.user_id')
            ->select('refunds.*','users.name')
        	->get();


            $id = $refundd->user_id;
            $user = User::find($id);
            $details = [
                'greeting' => 'Hi',
                'body' => 'This is To modify you that , Your refund was approved',
                'thanks' => 'Thank you for using Hamad E-commerce',
                'actionText' => 'View My Site',
                'actionURL' => url('/'),
                'order_id' => 'Order id'
            ];
            Notification::send($user, new DemoNotification($details));
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function send(Request $request,$id)
    {
        if(  Auth::id() && Auth::user()->usertype == 1 ){

            $user = User::find($id);
            $details = [
                'greeting' => 'Hi',
                'body' => 'This is To modify you that , you was made an order',
                'thanks' => 'Thank you for using Hamad E-commerce',
                'actionText' => 'View My Site',
                'actionURL' => url('/'),
                'order_id' => 'Order id'
            ];

            Notification::send($user, new DemoNotification($details));
            return redirect()->back()->with('message','The Email Was send Successfully');
        }else{
            return redirect('login');
        }
    }


    public function edit_categ_name(Request $request, $id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){

            $category = Category::find($id);

            $category->category_name = $request->category_name;
            $category->save();
            return redirect()->back();
        }else{

            return redirect('login');
        }
    }

    public function edit_categ_status($id){
        if(  Auth::id() && Auth::user()->usertype == 1 ){

            $category = Category::find($id);
            if($category->active == 0){
                $category->active = '1';
            }else{
                $category->active = '0';
            }
            $category->save();
            return redirect()->back();
        }else{

            return redirect('login');
        }
    }

        public function Show_subscribes(){
            if(  Auth::id() && Auth::user()->usertype == 1 ){
                $subscribe = DB::table('subscribes')
                            ->join('users', function (JoinClause $join) {
                                $join->on('subscribes.user_id', '=', 'users.id');
                            })
                            ->select('subscribes.*','users.name','users.email','users.usertype','users.phone','users.address','users.created_at')
                            ->paginate(20);
                return view('admin.dashboard.include.subscribe',compact('subscribe'));

            }else{

                return redirect('login');
            }
        }

        public function Admin_subscribe_search(Request $request){
            if(  Auth::id() && Auth::user()->usertype == 1 ){

                $subscribe = DB::table('subscribes')
                                ->join('users', function (JoinClause $join) {
                                    $join->on('subscribes.user_id', '=', 'users.id');
                                })
                                ->select('subscribes.*','users.name','users.email','users.usertype','users.phone','users.address','users.created_at')
                                ->where("name","LIKE","%{$request->search}%")
                                ->orWhere("subscribe_email","LIKE","%{$request->search}%")
                                ->paginate(20);
                return view('admin.dashboard.include.subscribe_search',compact('subscribe'));

            }else{
                return redirect('login');
            }
        }

    public function admin_delete_subscribe($id){

        if(  Auth::id() && Auth::user()->usertype == 1 ){
            $subscribe = Subscribe::find($id)->delete();
            Alert::success('Done','Subscribe was deleted successfully');

            return redirect()->back();

        }else{

            return redirect('login');
        }
    }


}
