<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'name.required' => '名前を入力してください',  
            'email.required' => 'メールアドレスを入力してください',  
            'password.required' => 'パスワードを入力してください',  
            'content.required' => '自己紹介文を入力してください', 
            'birthday_date.date' => 'お誕生日の年月日が有効ではありません'
        ];
        
        
        return Validator::make(array_merge($data, ['birthday_date' => $data['birthday_year'].'-'.$data['birthday_month'].'-'.$data['birthday_day']]), [
            'birthday_date' => ['required','date'],
        ],$message);


        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', 'string' , 'max:1'],
            'content' => ['required', 'string', 'max:255'],
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
            $birthday = $data['birthday_year'].'-'.$data['birthday_month'].'-'.$data['birthday_day'];
            
            

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
            'birthday' => $birthday,
            'content' => $data['content'],
        ]);
    }
}
