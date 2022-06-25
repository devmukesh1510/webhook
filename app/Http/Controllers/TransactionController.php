<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
 	
 		$user_id = auth()->user()->id;
        $transaction = Transaction::where('user_id',$user_id)->get();

		return response()->json([
	            'success' => true,
	            'email' => auth()->user()->email,
	            'data' => $transaction
	    ]);
 
    }
}
