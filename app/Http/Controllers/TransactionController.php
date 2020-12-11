<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //only member that can access this
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display all transaction
    public function index()
    {
        $transactions = Transaction::all();
        return view('history', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $transaction = new Transaction([
            'user_id' => $id,
            'date' => date('Y-m-d H:i:s'),
        ]);
        $transaction->save();
        
        return $this->attach($id);
    }

    public function attach($id)
    {
        $user = User::find($id);
        $cartItems = $user->products;

        foreach($cartItems as $cartItem){
            $cartItem->transactions()->attach($id,[
                'quantity' => $cartItem->pivot->quantity,
            ]);
            //$cartItem->users()->detach($id);
        }

        return view('cart')->with([
            'cartItems' => $cartItems,
            'message' => "Purchase success!",
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
