<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CarController extends Controller
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
            $path = '/Bus/' . '/image/' . $filename;
            $file->move(public_path() . "/Bus/" . "/image/", $filename);
        }
        Car::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $path,
        ]);
        toastr()->success('Add Info Successfully!');
        return redirect()->back();
    }
    public function update(Request $request, Car $car)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
   

        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/Bus/' . '/image/' . $filename;
            $file->move(public_path() . "/Bus/" . "/image/", $filename);
        } else {
            $path = $car->image;
        }
        $car->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $path,
        ]);
        toastr()->success('Update Info Successfully!');
        return redirect()->route('find.us');
    }
    public function delete(Car $car)
    {
        $image_path = public_path() . $car->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $car->delete();
        toastr()->success('Delete Successfully!');
        return redirect()->back();
    }
    public function edit(Car $car)
    {
        return view('admin.findUs.edit3', compact('car'));
    }
}
