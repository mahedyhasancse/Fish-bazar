<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Train;

class TrainController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        

        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/Train/' . '/image/' . $filename;
            $file->move(public_path() . "/Train/" . "/image/", $filename);
        }
        Train::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $path,
        ]);
        toastr()->success('Add Info Successfully!');
        return redirect()->back();
    }


    public function update(Request $request,Train $train)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',


        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/Train/' . '/image/' . $filename;
            $file->move(public_path() . "/Train/" . "/image/", $filename);
        }
        else{
            $path=$train->image;
        }
      $train->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $path,
        ]);
        toastr()->success('Update Info Successfully!');
        return redirect()->route('find.us');
    }
    
    public function delete(Train $train)
    {
        $image_path = public_path() . $train->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $train->delete();
        toastr()->success('Delete Successfully');
        return redirect()->back();
    }
    public function edit(Train $train)
    {
        return view('admin.findUs.edit2',compact('train'));
    }
}
