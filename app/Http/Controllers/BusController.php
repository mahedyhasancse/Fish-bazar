<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Bus;
use App\Car;
use App\Train;

class BusController extends Controller
{
    public function bus(){
        $buses=Bus::all();
        $trains=Train::all();
        $cars=Car::all();
        return view('admin.findUs.add',compact('buses','trains','cars'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
    
          
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
           $extention = $file->getClientOriginalExtension();
           $filename = time() . '.' . $extention;
           $path = '/Bus/' .'/image/' . $filename;
           $file->move(public_path() . "/Bus/" ."/image/", $filename);
       }
       Bus::create([
           'name'=>$request['name'],
           'description' => $request['description'],
           'image'=>$path,
       ]);
       toastr()->success('Add Info Successfully!');
       return redirect()->back();

    }
    public function update(Request $request,Bus $bus){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
       
          
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
           $extention = $file->getClientOriginalExtension();
           $filename = time() . '.' . $extention;
           $path = '/Bus/' .'/image/' . $filename;
           $file->move(public_path() . "/Bus/" ."/image/", $filename);
       }
       else{
           $path=$bus->image;
       }
    $bus->update([
           'name'=>$request['name'],
           'description' => $request['description'],
           'image'=>$path,
       ]);
       toastr()->success('Update Info Successfully!');
       return redirect()->route('find.us');

     
    }
    public function delete(Bus $bus){
        $image_path = public_path() . $bus->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
    $bus->delete();
    toastr()->success('Delete Successfully!');
    return redirect()->back();
    }
    public function edit(Bus $bus){
        return view('admin.findUs.edit',compact('bus'));
    }
}
