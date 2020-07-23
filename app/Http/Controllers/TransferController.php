<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transfer;
use App\Wallet;

class TransferController extends Controller
{   
    public function store(Request $request){
        $input = $request->all();
        $wallet = Wallet::find($input['wallet_id']);
        $wallet->money = $wallet->money + $input['amount'];
        $wallet->update();

        $transfer = new Transfer();
        $transfer->description = $input['description'];        
        $transfer->amount = $input['amount'];        
        $transfer->wallet_id = $input['wallet_id'];        
        $transfer->save();

        return response()->json([
            'id' => $transfer->id, 
            'description' => $request->description, 
            'amount' => $transfer->amount, 
            'wallet_id'=>$transfer->wallet_id 
        ], 201);
    }
}
