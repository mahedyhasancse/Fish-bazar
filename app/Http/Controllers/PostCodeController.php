<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCode;

class PostCodeController extends Controller
{
    public function index(){
        $posts=PostCode::latest()->get();
        return view('postcode',compact('posts'));
    }
    public function store(Request $request){
     $this->validate($request,[
         'post_code'=>'required',
     ]);
     PostCode::create([
         'post_code'=>$request['post_code'],
     ]);
     toastr()->success('Add  Successfully!');
     return redirect()->back();
    }
    public function delete(PostCode $post){
      $post->delete();
      toastr()->success('Deleted Successfully!');
      return redirect()->back();
    }
}
