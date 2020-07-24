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

    public function delete(Request $request){
        $input = $request->all();

        $transfer = Transfer::find($input['id']);

        $wallet = Wallet::find($transfer->wallet_id);
        $wallet->money = $wallet->money - abs($transfer->amount);
        $wallet->update();

        $transfer->delete();
        
        $transfers = $wallet->transfers()->get();
        return response()->json([
            'money' => $wallet->money, 
            'message' => 'Record deleted!', 
            'transfers' => $transfers
        ], 201);
    }

}
