<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instagram;

class InstagramController extends Controller
{
    public function index()
    {
        $instagrams = Instagram::all();
        return view('admin.instagram.add', compact('instagrams'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/Instagram/' . '/image/' . $filename;
            $file->move(public_path() . "/Instagram/" . "/image/", $filename);
        }
        Instagram::create([
            'link' => $request['link'],
            'image' => $path,
        ]);
        toastr()->success('Add Post Successfully!');
        return redirect()->back();
    }
    public function delete(Instagram $instagram)
    {
        $image_path = public_path() . $instagram->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $instagram->delete();
        toastr()->success('Delete Successfully!');
        return redirect()->back();
    }
    public function edit(Instagram $instagram)
    {
        return view('admin.instagram.edit', compact('instagram'));
    }
    public function update(Request $request, Instagram $instagram)
    {
        $this->validate($request, [
            'link' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/Instagram/' . '/image/' . $filename;
            $file->move(public_path() . "/Instagram/" . "/image/", $filename);
        } else {
            $path = $instagram->image;
        }
        $instagram->update([
            'link' => $request['link'],
            'image' => $path,
        ]);
        toastr()->success('Update Successfully!');
        return redirect()->route('add.instagram');
    }
}
