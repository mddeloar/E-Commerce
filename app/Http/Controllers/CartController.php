<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
	public function add_to_cart(Request $request)
	{
		$qty=$request->qty;
		$product_id=$request->product_id;
		$product_info=DB::table('tbl_products')
					->where('product_id',$product_id)
					->first();
					
		$data['qty']=$qty;
		$data['id']=$product_info->product_id;
		$data['name']=$product_info->product_name;
		$data['price']=$product_info->product_price;
		$data['options']['image']=$product_info->product_image;

		Cart::add($data);
		return Redirect::to('/show-cart');
	}

	public function show_cart()
	{
		$all_publish_category=DB::table('tbl_category')
							->where('publication_status',1)
							->get();

		$manage_published_category=view('pages.add_to_cart')
    		->with('all_publish_category',$all_publish_category);
    	return view('layout')
    		->with('pages.add_to_cart',$manage_published_category);
	}

	public function delete_to_cart($rowId)
	{
		Cart::update($rowId,0);
		return Redirect::to('/show-cart');
	}

	public function update_cart(Request $request)
	{
		$qty=$request->qty;
		$rowId=$request->rowId;

		Cart::update($rowId,$qty);
		return Redirect::to('/show-cart');


	}

	public function review_rating(Request $request)
	{
		$data=array();
    	$data['reviewer_name']=$request->reviewer_name;
    	$data['reviewer_email']=$request->reviewer_email;
    	$data['review']=$request->review;
    	$data['product_id']=$request->product_id;

    	DB::table('tbl_review')->insert($data);
    	$product_by_details=DB::table('tbl_products')
    					->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    					->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    					->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    					->where('tbl_products.product_id',$request->product_id)
    					->where('tbl_products.publication_status',1)
                        ->first();
    					/*->first();*/
        /*$product_review=DB::table('tbl_review')
                        ->where('product_id',$product_id)
                        ->get();*//*
                        ->join('tbl_review','tbl_products.product_id','=','tbl_review.product_id')*/


    	$manage_product_by_details=view('pages.product_details')
    		->with('product_by_details',$product_by_details);
        /*$product_review=view('pages.product_details')
            ->with('product_review',$manage_product_by_details);*/
    	return view('layout')
    		->with('pages.product_details',$manage_product_by_details);
    	/*return Redirect::to('/view_product/9');*/
    	/*return Redirect::to('/view_product/'.'$request->product_id');*/

	}



    
}
