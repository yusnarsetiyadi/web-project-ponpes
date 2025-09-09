<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->redirectTo = '/'.config('pathadmin.admin_name').'/home';
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'              => 'required',
            'password'              => 'required|min:6'
        ];

        $messages = [
            'email.required'     => 'email wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.min'       => 'Password wajib diisi minimal 6 karakter'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return $this->sendError('Error.',$validator->errors()->all());
        }

        $data = [
            'email'  => $request->input('email'),
            'password'  => $request->input('password'),
        ];
        Auth::guard();
        if (Auth::attempt($data)) {
            if (Auth::user()) {
                $userx = Auth::user();
                Session::put('nama',$userx->name);
                Session::put('id',$userx->id);
                // Session::put('nomor',$userx->nomor);
                Session::put('role',$userx->getRoleNames()[0]);
                return redirect(url('/'.config('pathadmin.admin_name').'/home'));
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email Dan Password Salah.');
        }
    }
}
