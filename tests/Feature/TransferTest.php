<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Wallet;
use App\Transfer;

class TransferTest extends TestCase
{   
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTransfer()
    {   
        $wallet = factory(Wallet::class)->create();
        $transfer = factory(Transfer::class)->make();

        $response = $this->json('POST', '/api/transfer', [
            'description' => $transfer->description,
            'amount' => $transfer->amount,
            'wallet_id' => $wallet->id
        ]); 

        $response->assertJsonStructure(['id', 'amount', 'description', 'wallet_id'])
                 ->assertStatus(201);

        $this->assertDatabaseHas('transfers', [
            'description' => $transfer->description,
            'amount' => $transfer->amount,
            'wallet_id' => $wallet->id
        ]);

        $this->assertDatabaseHas('wallet', [
             'id' => $wallet->id,
             'money' => $wallet->money + $transfer->amount
        ]);
    }
}
