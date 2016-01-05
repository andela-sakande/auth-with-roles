<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Input;
use Validator;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Logic\User\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $auth;

    protected $userRepository;

    public function __construct(Guard $auth, UserRepository $userRepository)
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
    }


    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin()
    {
        $email      = Input::get('email');
        $password   = Input::get('password');
        $remember   = Input::get('remember');

        if ($this->auth->attempt([
            'email'     => $email,
            'password'  => $password
        ], $remember == 1 ? true : false)) {
            if ($this->auth->user()->hasRole('user')) {
                return redirect()->route('user.home');
            }

            if ($this->auth->user()->hasRole('administrator')) {
                return redirect()->route('admin.home');
            }

        } else {
            return redirect()->back()
                ->with('message', 'Incorrect email or password')
                ->with('status', 'danger')
                ->withInput();
        }

    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('auth.login')
            ->with('status', 'success')
            ->with('message', 'Logged out');

    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister()
    {
        $input = Input::all();
        $validator = Validator::make($input, User::$rules, User::$messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $input['email'],
            'password'      => $input['password']
        ];

        $this->userRepository->register($data);

        return redirect()->route('auth.login')
            ->with('status', 'success')
            ->with('message', 'You are registered successfully. Please login.');


    }
}
