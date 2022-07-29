<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\ProductRecivingTime;
class CollectController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [
      'date' => 'required',
      'time' => 'required',
    ]);

 ProductRecivingTime::create([
      'user_id' =>auth()->user()->id,
      'time' => $request['time'],
      'date' => $request['date'],
      'quick'=>$request['quick'],
    ]);
    toastr()->success('Lets Go To  Shoping');
    return redirect()->route('shop'); 
  }
}
