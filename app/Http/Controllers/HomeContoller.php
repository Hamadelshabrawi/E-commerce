<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\Refund;
use App\Models\Invoice;
use App\Models\Subscribe;
use App\Models\productscomment;
use RealRashid\SweetAlert\Facades\Alert;
use Notification;
use App\Notifications\DemoNotification;
use Illuminate\Support\Facades\Validator;
use Session;
use Stripe;
use Carbon\Carbon;
use App\Models\ProductImage;

use Illuminate\Support\Facades\DB;


class HomeContoller extends Controller
{
    public function index(){

        // show only enable products
        $products = product::where('active','=',1)->orderBy('id','DESC')->limit(8)->get();

        // check and remove the products which was remove manual  
        $crashedCarIds = Product::pluck('id')->all();
        $catsnotexsist = cart::whereNotIn('productId', $crashedCarIds)->delete();

        // remove product from cart if product was changes to disable  
        $productsdisabled = DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.productId')
        ->where('active', '=' , 0)
        ->delete();

        $Category = Category::where('active','1')->get() ;

        $countcart = Cart::where('userId', Auth::id())->count();
        $Latestproducts = product::where('active','=',1)->where('featured','Latest')->where('quantity','>','2')->orderBy('id','DESC')->limit(3)->get();
        $Latestproducts1 = product::where('active','=',1)->where('featured','Latest')->where('quantity','>','2')->orderBy('id','ASC')->limit(3)->get();
        $TopRatedproducts = product::where('active','=',1)->where('featured','Top Rated')->where('quantity','>','2')->orderBy('id','DESC')->limit(3)->get();
        $TopRatedproducts1 = product::where('active','=',1)->where('featured','Top Rated')->where('quantity','>','2')->orderBy('id','ASC')->limit(3)->get();
        $Reviewproducts = product::where('active','=',1)->where('featured','Review')->where('quantity','>','2')->orderBy('id','DESC')->limit(3)->get();
        $Reviewproducts1 = product::where('active','=',1)->where('featured','Review')->where('quantity','>','2')->orderBy('id','ASC')->limit(3)->get();

        return view('home.userpage',compact('products','Category','countcart','Latestproducts','Latestproducts1','TopRatedproducts','TopRatedproducts1','Reviewproducts','Reviewproducts1'));

    }

    public function more_details($id){
        if(Auth::user()){
            $user_id = Auth::user()->id ;
            $products = product::find($id);
            $comment = Productscomment::where('product_id','=',$id)->whereNotNull('comment')->get();
            $commentDisable = Productscomment::where('product_id','=',$id)->where('user_id',$user_id)->whereNotNull('comment')->count();
            $countcomment = $comment->count();
            $isLike = DB::select("SELECT * FROM productscomments INNER JOIN products  ON productscomments.product_id = products.id where product_id = $id AND  user_id = $user_id AND comment IS NULL ");
            $previousYear = Carbon::now()->subYears(2);
            $checkPreviusProductOrder = Order::SELECT('created_at')->where('user_id',$user_id)->where('product_id',$id)->whereYear('created_at','>',$previousYear)->count();
            $result = array_column($isLike, 'isLike');
                if(empty($result)){
                    $result = null;

                }else{
                    $result = $result[0];
                }
                    $countcart = Cart::where('userId', Auth::id())->count();
                    $productImage = ProductImage::select('imageName')->where('producId', $id)->get();
                    $productImagee = ProductImage::select('imageName')->where('producId', $id)->get();
                    return view('home.single_product',compact('productImage','productImagee','products','comment','countcomment','result','countcart','commentDisable','checkPreviusProductOrder'));
        }else{
            $products = product::find($id);
            $comment = Productscomment::where('product_id','=',$id)->whereNotNull('comment')->get();
            $countcomment = $comment->count();
            $productImage = ProductImage::where('producId', $id)->get();
            $productImagee = ProductImage::select('imageName')->where('producId', $id)->get();
            return view('home.single_product',compact('productImage','productImagee','products','comment','countcomment'));
        }
    }

    public function logout() {

        Auth::logout();
    
        return redirect('/login');
    
    }

    public function my_order(){
        if(Auth::id()){
            $userId = Auth::user()->id;
            $user_name = Auth::user()->name;
            $my_order = invoice::where('user_id',$userId)->get();
            // dd($my_order);
            return view('home.dashboard.myOrder',compact('my_order','user_name'));
        }else{
            return redirect('login');
        }
    }

    public function show_my_invoice($id){

        if(Auth::id()){
        $AuthUserId = Auth::user()->id;
        
        // $checkInvoiveOwn = invoice::where('user_id',$AuthUserId)->where('order_id',$id)->get();
        $checkInvoiveOwn = DB::select(" select * from invoices where user_id = $AuthUserId AND order_id = $id");

        if(!empty($checkInvoiveOwn)){

        $orders_invoice = Order::where('order_id',$id)->get();

        $orders_invoice_name = Order::where('order_id',$id)->first();



        $price = order::where('order_id', '=', $id)->sum('price_muliply_qty');
        $totalPrice = order::where('order_id', '=', $id)->sum('Total_price');

        $diff = DB::select("SELECT SUM(price_muliply_qty-Total_price) AS DIFF FROM orders WHERE order_id = $id");
        $difference = array_column($diff, 'DIFF');
        $difference = $difference[0];

        $totalDiscount = $price - $difference ;
        // dd($totalDiscount);

            return view('home.dashboard.user_single_invoice',compact('orders_invoice','orders_invoice_name','price','difference','totalDiscount'));
        }else{

            return redirect()->back();

        }
    }else{
        return redirect('login');
    }
    }

    public function showcart(){
        if(Auth::id()){

        // check and remove the products which was remove manual  
        $crashedCarIds = Product::pluck('id')->all();
        $catsnotexsist = cart::whereNotIn('productId', $crashedCarIds)->delete();

        // remove product from cart if product was changes to disable  
        $products = DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.productId')
        ->where('active', '=' , 0)
        ->delete();

        $user = Auth::user()->id;
        $cart = cart::all();
        $product = Product::all();
        $cart =Cart::where('userId','=',$user)
                    ->get();


        $quan = DB::select(" select quantity from carts where userId = $user");
        $price = cart::where('userId', '=', $user)->sum('price_muliply_qty');
        $diff = DB::select("SELECT SUM(price_muliply_qty-totalPrice) AS DIFF FROM carts WHERE userId = $user");
        $difference = array_column($diff, 'DIFF');
        $difference = $difference[0];
        $totalDiscount = $price - $difference ;
        $Category = Category::all();
        $countcart = Cart::where('userId', Auth::id())->count();



        // $cartts = cart::select('*')->where('productId',$id)->where('userId',$user)->get();
        //     dd($cartts);
        return view('home.cart',compact('cart','totalDiscount','price','difference','Category','countcart'));

               }else{
            return redirect('login');
        } 
    }

    public function remove_cart_product($id){
        if(Auth::id()){


        $cart = cart::find($id);
        $cart->delete();

        Alert::success('product was removed');
        return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function produc_search(Request $request)
    {
            $searchTextt = $request->searchText;

            $products = Product::where('active','=',"1")->where('title','LIKE',"%$searchTextt%")->orWhere('Sku','LIKE',"%$searchTextt%")->paginate(9);
            $Category = Category::where('active','1')->get();
            $countcart = Cart::where('userId', Auth::id())->count();

        return view('home.products_page_result',compact('products','Category','countcart'));
    } 


    public function add_cart(Request $request, $id){
    
        if(Auth::user()){
            $validator = Validator::make($request->all(), [
                'cartQty' => 'required|numeric'],[
                    'cartQty.required' => 'Number is must.',
                ]);
                $checkQuntity = Product::find($id);
                $checkQuntityy = $checkQuntity->quantity;
                if($checkQuntityy < $request->cartQty){
                    Alert::error('Worning','Quantity not exists');
        
                    return redirect()->back();
                }

                if ($validator->fails()) {
                    // return redirect()->back()->with('Error','The Sku is exsist');
                    Alert::error('Worning','Add Number of quantity');
        
                    return redirect()->back();
                }
            if( $request->cartQty > 0){

                $products = Product::find($id);
                    $userId = Auth::user()->id;
                $cart_prod_id = DB::select(" select * from carts where productId = $products->id AND userId = $userId");

                if (empty($cart_prod_id)) {

                    $user = Auth::user();
                    $cart = new Cart ;
                    $cart->userId = $user->id;
                    $cart->username = $user->name;
                    $cart->productId = $products->id;
                    $cart->product_title = $products->title;
                    $cart->discount = $products->discount_price;
                    $cart->price = $products->price;
                    $cart->Sku = $products->Sku;


                    $cart->quantity = $request->input('cartQty') ;
                    $cart->image = $products->image;
                    $cart->save();
                    Alert::success('Product Added Successfully','We have added product to cart');
                    return redirect()->back();
                } else {
                    
                    Cart::where('productId', $products->id)->update([
                        'quantity' =>  $request->input('cartQty') ,
                    ]);
                    Alert::success('Product update Successfully','We have update product to cart because you have added this product before');
                    return redirect()->back();
                } 
            }else{
                Alert::warning('Worning quantity','You must  add quantity');
                return redirect()->back();

            }

        }else{

            return view('auth.login');            
        
        }
    }


    public function Quick_add_cart($id){
    
        if(Auth::user()){

            $products = Product::find($id);
                $userId = Auth::user()->id;
            $cart_prod_id = DB::select(" select * from carts where productId = $products->id AND userId = $userId");

            if (empty($cart_prod_id)) {

                $user = Auth::user();
                $cart = new Cart ;
                $cart->userId = $user->id;
                $cart->username = $user->name;
                $cart->productId = $products->id;
                $cart->product_title = $products->title;
                $cart->discount = $products->discount_price;
                $cart->price = $products->price;
                $cart->Sku = $products->Sku;


                $cart->quantity = 1 ;
                $cart->image = $products->image;
                $cart->save();
                Alert::success('Product Added Successfully','We have added product to cart');
                return redirect()->back();

            }else{
                
                Alert::success('Product Was in card before','contenu browse our product');
                return redirect()->back();
            } 


        }else{

            return view('auth.login');            
        
        }
        
    }



    

    public function commentmessage(Request $request,$id){

        if(Auth::user()){
            if($request->commentMessage > 0){
                $products = product::find($id);
                $user = Auth::user();
                $userId = Auth::id();
                $checkPreviuseComment =  productscomment::where('product_id',$id)->where('user_id',$userId)->whereNotNull('comment')->count();
                if(empty($checkPreviuseComment)){
                    $productscomment = new productscomment;
                    $productscomment->product_id = $products->id;
                    $productscomment->product_title = $products->title;
                    $productscomment->user_id = $user->id;
                    $productscomment->user_name = $user->name;
                    $productscomment->comment = $request->commentMessage;
                    $productscomment->save();
                    return redirect()->back();
                }
                

            }else{
                Alert::warning('Enter Comment');
                return redirect()->back();
                }
            return redirect()->back();
        }else{

            return view('auth.login');            
        
        }
    }

    public function makeLike($id){
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $makeLike = Product::find($id);
            $ChechTheOldLike = DB::select(" select * from productscomments WHERE product_id = $id  AND  isLike = 1 AND user_id = $user_id ");   

            if(empty($ChechTheOldLike)){

                $user = Auth::user();
                $userId = Auth::user()->id;
                $productscomment = new productscomment;
                $productscomment->product_id = $makeLike->id;
                $productscomment->product_title = $makeLike->title;
                $productscomment->user_id = $userId;
                $productscomment->user_name = $user->name;
                $productscomment->isLike = '1';
                $productscomment->save();
                return redirect()->back();

            }else{

                $userId = Auth::user()->id;
                $makeLike = Product::find($id);
                productscomment::where('product_id', $makeLike->id)->where('isLike','1')->where('user_id',$userId)->delete();
            }

            return redirect()->back();
        }else{

            return view('auth.login');            
        
        }
    }

    public function delete_comment($id){
        if(Auth::id()){
            $comm = productscomment::find($id);
            $comm->delete();
            Alert::success('Comment was Deleted');
            return redirect()->back();

            }else{
                return redirect('login');
            }
        } 
    
    public function products_page(){

        $products = product::Where('active','=','1')->orderBy('id','DESC')->paginate(9);
        $countcart = Cart::where('userId', Auth::id())->count();

        return view('home.products_page',compact('products','countcart'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $res = Product::where("active","=","1")->where("title","LIKE","%$request->term%")->get();
    
        return response()->json($res);
    }

    public function refund(Request $request, $id)
    {
        if(Auth::user()){

        $UserId= Auth::user()->id;
        $checkOwnUser= DB::select(" select * from invoices where order_id = $id AND user_id = $UserId ");
        $checkprevirefund= DB::select(" select * from refunds where order_id = $id AND user_id = $UserId ");

        if(!empty($checkOwnUser) && empty($checkprevirefund)){

            $invoice = invoice::where('order_id',$id)->where('user_id',$UserId)->get();
            $refunds = new Refund;
            $refunds->user_id = $UserId;
            $refunds->order_id = $id;
            $refunds->reason = $request->reason;
            $refunds->replaceOrrefund = $request->replaceOrrefund;

            if($request->hasFile('image')){
            $image = $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imageName);
            $refunds->image = $imageName;
            }
            $refunds->save();



            $user= Auth::user()->id;
        $details = [
            'greeting' => 'Hi',
            'body' => 'This is To modify you that , you was made Refund',
            'thanks' => 'Thank you for using Hamad E-commerce',
            'order_id' => $id,
            'actionText' => 'View My Site',
            'actionURL' => url('/')
        ];
  
        // Notification::send($user, new DemoNotification($details));

        $email='hamadelshabrawi@gmail.com';

        Notification::route('mail', $email)->notify(new DemoNotification($details));
        Alert::success('Refund was Done Successfully','We will contact you via email as soon as possible');
        return redirect()->back();

    }else{
        Alert::warning('Worning','Wrong invoice or  You had made refurn for this order before');
        return redirect()->back();

    }

}else{
    return redirect()->back();

}

    }


    public function myRefund(){
        if(Auth::id()){
            $user_name = Auth::user()->name;
            $user_id = Auth::user()->id;
            $datarefund = Refund::where('user_id',$user_id)->get();
            // $datarefund = Refund::join('users', 'users.id', '=', 'refunds.admin_id')
            // ->where('user_id',$user_id)
            // ->select('refunds.*','users.name')
        	// ->get();

            $adminN = DB::select("SELECT Refunds.*,name as adminname FROM Refunds LEFT JOIN users ON Refunds.admin_id = users.id where Refunds.user_id = $user_id ");

            $adminName = array_column($adminN, 'adminname');
            // dd($adminName);

            // $datarefund = array_column($datarefunds, 'adminname');

            return view('home.dashboard.myRefund',compact('user_name','datarefund','adminName'));
        }else{
            return redirect()->back();
        }
    }

    public function mycomment(){
        if(Auth::id()){
            $user_name = Auth::user()->name;
            $user_id = Auth::user()->id;
            // $dataComment = Productscomment::where('user_id',$user_id)->whereNotNull('comment')->get();
            $dataComment = DB::select("SELECT * FROM products JOIN productscomments ON products.id=productscomments.product_id WHERE active = 1 AND user_id = $user_id AND comment IS NOT NULL ");
            return view('home.dashboard.mycomment',compact('user_name','dataComment'));
        }else{
            return redirect()->back();
        }
    }  
    
    public function remove_mycomment($id){
        if(Auth::id()){
            $user_name = Auth::user()->name;
            $user_id = Auth::user()->id;
            $dataComment = Productscomment::where('id',$id)->delete();

            Alert::success('Comment was Deleted successfully');

            return redirect()->back();

        }else{

            return redirect()->back();
        }
    }  
    public function subscribe(Request $request){
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $subscribeAll = subscribe::select('subscribe_email')->where('subscribe_email',$request->email)->get();
            if(count($subscribeAll) == 0 ) {

                $subscribe = new subscribe;
                $subscribe->user_Id = Auth::id();
                if (is_null($request->email) ) {
                    $subscribe->subscribe_email = Auth::user()->email;
                }else{
                    $subscribe->subscribe_email = $request->email;
                }
                $subscribe->save();
                Alert::success('Done','subscribe successfully');
                return redirect()->back();

            }else{
                Alert::info('Worning','you have make subscribe before');
                return redirect()->back();
            }


        }else{
        if(is_null(Auth::id())){
            $subscribeAll = subscribe::select('subscribe_email')->where('subscribe_email',$request->email)->get();
            if(count($subscribeAll) == 0 ) {

                $subscribe = new subscribe;
                $subscribe->user_Id = ' ';
                $subscribe->subscribe_email = $request->email;
                $subscribe->save();
                Alert::success('Done','subscribe successfully');
                return redirect()->back();

            }else{
                Alert::info('Worning','you have make subscribe before');
                return redirect()->back();
            }
        
        }
    }
    }

    public function remove_subscribe(){
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $subscribeAll = subscribe::where('user_Id',$user_id)->delete();
           
            Alert::success('Done','Subscribe was deleted successfully');
            return redirect()->back();

        }else{

            return redirect('/login');
        }
    }

}   
