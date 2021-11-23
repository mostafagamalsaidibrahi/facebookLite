<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\signUpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function signUp (signUpRequest $request){
        // check if found or not
        $isExists = DB::table('accounts')->where(['password' => $request->password])->get();
        if( count($isExists) > 0 ){
            // this account is found
            return response()->json(['msg' => 0]);
        }else{
            // this account is new and not found
            // insertion operation
            $accountCreation = DB::table('accounts')->insert(
                [   'fullname' => $request->fullname,
                    'email' => $request->email ,
                    'password' => $request->password,
                    'day' => $request->day ,
                    'month' => $request->month,
                    'year' => $request->year ,
                    'gender' => $request->gender ,
                    'profileImage' => 'NULL']
            );
            return response()->json(['msg' => 1]);
        }
    }

    public function login (loginRequest $request){
        $isFound = DB::table('accounts')->where([ 'email' => $request->emailForLogin , 'password' => $request->passwordForLogin])->get();

        if( count($isFound) > 0 ){
            // username and password is wright
            // passing id to session
            foreach ($isFound as $obj){
                $uIdValue = $request->session()->put('uId' , $obj->uId);
                $uIdValue = $request->session()->put('profileImage' , $obj->profileImage);

                $uId = $request->session()->get('uId');

                $affected = DB::table('accounts')
                    ->where('uId', $uId)
                    ->update(['active' => 1]);

            }
            return response()->json(['msg' => 0]);
        }else{
            return response()->json(['msg' => 1]);
        }
    }

    public function signOut (Request $request){

        // getting user name
        $uId = $request->session()->get('uId');

        $request->session()->forget('profileImage');
        $request->session()->forget('uId');
        $request->session()->forget('friendProfile');
        $request->session()->forget('friendProfile');

        $affected = DB::table('accounts')
            ->where('uId', $uId)
            ->update(['active' => 0]);

        return redirect('/');
    }
}
