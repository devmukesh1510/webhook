<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class WebhookController extends Controller
{   

    /**
     *
     * @return \Illuminate\View\View
     */
    public function show_webhook( Request $request ) {

        $data = [];
        $data['webhook_success'] = $request->session()->get('webhook-success');
        $data['webhook_error']   = $request->session()->get('webhook-error');
        $request->session()->forget(['webhook_success', 'webhook_error']);
        
        return view('frontend.webhook.create',$data);
    }


    /**
     *
     * @return \Illuminate\View\View
     */
    public function create_webhook( Request $request ) {

        $id = $this->create_webhook_user($request->name);
        
        if($id !== null){ 
            $this->create_dummy_webhook_data($id);

            $request->session()->flash('webhook-success', "Webhook $request->name created!!");
            return redirect('/create-webhook'); 

        }else{

          $request->session()->flash('webhook-error', "Webhook $request->name already exist!!");
          return redirect('/create-webhook'); 
       }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create_webhook_user( $name ) {

        $email = $name.'@gmail.com';
        $password = 'asdfghjklkjhgfd';
        $user_found = User::where('email',$email)->first();
     
       if($user_found !== null){
          return null;
       }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        
        $user->createToken('tokens')->plainTextToken;

        return $user->id;
    }


     public function create_dummy_webhook_data( $user_id ){

        $type = array( "cr","dr","cr","dr","cr","dr","cr","dr" );

        for ( $i=0; $i < 20; $i++ ) { 

            shuffle( $type );
            $arr = [
                        'user_id' => $user_id,
                        'amount' => rand( 10, 100 ),
                        'type' => $type[0],
                     ];
            $transaction = Transaction::create($arr);
        }

        return true;

     }
}
