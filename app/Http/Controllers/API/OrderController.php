<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\Product_order;  
use App\Models\Product;
use Illuminate\Support\Facades\Auth; 
use Validator;

class OrderController extends Controller
{
    //
    public function add(Request $request){

        $available_stock = Product::where('id', $request['product_id'])->get('available_stock');
        $available_stock = $available_stock[0]->available_stock;
        if($request['quantity'] <= $available_stock && $available_stock !== 0){
            $ordered = Product_order::create([
                'user_id'       => Auth::id(),
                'product_id'    => $request['product_id'],
                'quantity'      => $request['quantity'],
            ]);
            if($ordered){
                $remaining_stock = ($available_stock - $request['quantity']);
                Product::where('id', $request['product_id'])->update(['available_stock' => $remaining_stock]);
                return response()->json(['message' => "You have successfully ordered this product."], 201); 
            }
        }
        else{
            return response()->json(['message' => "Failed to order this product due to unavailability of the stock"], 400); 
        }
    }
}
