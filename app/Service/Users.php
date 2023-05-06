<?php

namespace App\Service;

use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Str;
class Users
{
    /**
     * @param Request $request
     * @return void
     */
    protected $secret;
    public function registratsiya(Request $request)
    {
        $secret = Str::uuid();
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'phone'=>$request->phone,
            'kod_autarizatsiya'=>$secret
        ]);
        return $user;
    }
    public function mail(Request $request)
    {
        $user = User::all();
        foreach ($user as $users) {
            if ($users['email'] == $request->email) {

                Mail::to($request->email)->send(new WelcomeMail(data: [
                    'name' => $users['name'],
                    'secret' => $users['kod']
                ]));
                return $users['kod'];
            }
        }
    }

    public function authenticate(Request$request)
    {
        $user=User::where('kod', $request->kod)->first();
        if($user){
            $user->update([
                'autarizatsiya'=> 'true',
            ]);
        }else{
            return "false";
        }
    }
}
