<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel as Product;
use App\BidModel;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	function __construct(){
		 $this->middleware('auth');
		 
	}
	
	function isAdministrator(){
		
			
		
	}
    public function dashboard(){
		if(! Auth::user()->is_admin){
			 return redirect('/home');
		 }
		$pageData['active']   = 'dashboard';
		return view('admin/dashboard/dashboard')->with($pageData);
	}
	
	function productManagement(){
		if(! Auth::user()->is_admin){
			 return redirect('/home');
		 }
		$pageData['active'] = 'product';
		$pageData['products'] = Product::all();
		return view('admin/products/product')->with($pageData);
	}
	function manageProduct($id){
		if(! Auth::user()->is_admin){
			 return redirect('/home');
		 }
		$pageData['productInfo'] = Product::find($id);
		
		$myBid = BidModel::where('productId', $id)->orderBy('amount', 'DESC');;
		$pageData['highestBid'] 	= $myBid->first()->amount;
		$pageData['avarageBid'] = $myBid->get()->count() > 0 ? ($myBid->get()->sum('amount') / $myBid->get()->count()) : 0;
		return view('admin/products/summary')->with($pageData);
	}
	
	function update(Request $request, $id){
		if(! Auth::user()->is_admin){
			 return redirect('/home');
		 }
		$product = Product::find($id);
		$product->name = $request->input('name');
		$product->sku  = $request->input('sku');
		$product->description = $request->input('description');
		$product->price = $request->input('price');
		$product->save();
		return $this->manageProduct($id);
	}
}
