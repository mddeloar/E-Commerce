<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function index()
    {
    	$this->AdminAuthCheck();
    	
    	return view('admin.add_slider');
    }

    public function all_slider()
    {
    	$this->AdminAuthCheck();
    	
    	$all_slider=DB::table('tbl_slider')->get();
    	$manage_slider=view('admin.all_slider')
    		->with('all_slider',$all_slider);
    	return view('admin.admin_layout')
    		->with('admin.all_slider',$manage_slider);


    	//return view('admin.all_category');
    }

    public function save_slider(Request $request)
    {
    	$data=array();
    	$data['publication_status']=$request->publication_status;
    	$image=$request->File('slider_image');
    	if ($image) {
    		$image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name=$image_name.'.'.$ext;
    		$upload_path='slider/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if ($success) {
    			$data['slider_image']=$image_url;

	    			DB::table('tbl_slider')->insert($data);
	    			Session::put('message','Slider Added Successfully !!');
	    			return Redirect('/add-slider');
    		}
    	}
    	$data['slider_image']='';
	    	DB::table('tbl_slider')->insert($data);
	    	Session::put('message','Slider Added Successfully without image !!');
	    	return Redirect('/add-slider');

    }


    //If active then unactive
    public function unactive_slider($slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->update(['publication_status' => 0]);
    	Session::put('message','Slider Unactivated Successfully !!');
    	return Redirect('/all-slider');
    }

    //If unactive then active
    public function active_slider($slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->update(['publication_status' => 1]);
    	Session::put('message','Slider Activated Successfully !!');
    	return Redirect('/all-slider');
    }

    public function delete_slider($slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id',$slider_id)
    		->delete();

    	Session::get('message','Slider Delete Successfully !');
    	return Redirect::to('/all-slider');


    }









    public function AdminAuthCheck()
    {
    	$admin_id=Session::get('admin_id');
    	if ($admin_id){
    		return;
    	}
    	else{
    		return Redirect::to('/admin')->send();
    	}
    }
}
