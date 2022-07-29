<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use App\Video;

class VideoController extends Controller
{
    public function index(){
        $videos=Video::all();
      return view('video',compact('videos'));
    }
    public function store(Request $request){
        $this->validate($request,[
         'links' =>'required',
        ]);
        
        if ($request->hasFile('links')) {
            $file = $request->file('links');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/weekly/' . '/video/' . $filename;
            $file->move(public_path() . "/weekly/" . "/video/", $filename);
        }
        Video::create([
            'links'=>$path,
        ]);
        toastr()->success('Video Add Successfully!');
        return redirect()->back();
    }
    public function delete(Video $video){
     $video->delete();
     $image_path = public_path() . $video->links;
     //dd($image_path);
     if (File::exists($image_path)) {
         File::delete($image_path);
         //unlink($image_path);
     }
     toastr()->success('Delete Successfully!');
     return redirect()->back();
    }
}
