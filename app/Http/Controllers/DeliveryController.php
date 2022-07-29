<?php

namespace App\Http\Controllers;

use App\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function deliveryStatus(Delivery $delivery)
    {
        $delivery->status = !$delivery->status;
        $delivery->save();
        if ($delivery->status == 0) {
            toastr()->success('Delivered  Successfully');
        } else {
            toastr()->success('Update Successfully');
        }

        return redirect()->back();
    }
    public function delete(Delivery $delivery)
    {
        $delivery->delete();
        toastr()->success('Delete  Successfully');
        return redirect()->back();
    }
}
