<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\ProductModel as Product;
use App\BidModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
    

    public function index()
    {
		return $this->products();
    }
	
	public function products(){
		$products = Product::all();
		$isLoggedIn = Auth::check();
		$pageData['isLoggedIn'] = $isLoggedIn;
		$pageData['products'] = $products;
		return view('home')->with($pageData);
	}
	
	
	public function show($id){
		$isLoggedIn = Auth::check();
		$updateProductViews  		= Product::find($id);
		$updateProductViews->views  = $updateProductViews->views+1;
		$updateProductViews->save();
		
		$productInfo = [];
		$productInfo['id'] 	= $id;
		$productInfo['productInfo'] =  Product::find($id);;
		$productInfo['name'] 		= '';
		
		$productInfo['isLoggedIn'] 	= $isLoggedIn;
		
		$myBid = BidModel::where('productId', $id)->orderBy('amount', 'DESC');;
		
		$productInfo['highestBid'] 	= $myBid->get()->count() > 0 ? $myBid->first()->amount:0;
		$avarage = $myBid->get()->count() > 0 ? ($myBid->get()->sum('amount') / $myBid->get()->count()) : 0;
		
				
		$productInfo['avarageBid'] 	= round($avarage);
		$productInfo['bidSubmitted'] 	= false;
		if($isLoggedIn){
			 $userInfo  = Auth::user();
			$productInfo['userInfo'] 	= $userInfo;
			
			$myBid = BidModel::where('email', $userInfo->email)
								->where('productId', $id)
								->first();
			//return var_dump($myBid->amount);	
			if(count($myBid) > 0){
				$productInfo['bidSubmitted'] 	= true;
				$productInfo['yourBid'] 	= $myBid->amount;
				
			}else{
				$productInfo['bidSubmitted'] 	= false;
			}
			
			//return $productInfo;
			
		}
		
		return view('modal/modal_page')->with($productInfo);
	}
	public function bid(Request $request, $id){
		
		$isLoggedIn = Auth::check();
		if($isLoggedIn){
			 $userInfo  = Auth::user();
			
		} 
		$email = $isLoggedIn ? $userInfo->email : strtolower($request->input('email'));
		
		$bids = BidModel::where('email', $email)
				->where('productId', $id)
				->count();
				
		if($bids < 1){
			$bid  = new BidModel;
			$bid->productId = $id;
			$bid->email 	= $email;
			$bid->amount 	= $request->input('amount');
			$bid->dateAdded = strtotime(date('Y-m-d H:i:s'));
			$bid->save();
		}
		
		echo  json_encode(['response' => true]);
	}
	public function bidNow(){
		$isLoggedIn = Auth::check();
		$pageData['isLoggedIn'] = $isLoggedIn;
		if($isLoggedIn){
			$pageData['userInfo'] = Auth::user();
		}
		
		return view('modal/components/bid_now')->with($pageData);
	}
	
	function logout(){
		Auth::logout();
		return redirect('home');
	}
}
