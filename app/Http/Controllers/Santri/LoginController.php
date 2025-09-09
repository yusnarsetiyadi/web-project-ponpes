<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
class LoginController extends Controller
{
    public function register(Request $request){
        $rules = [
            'email'              => 'required',
            'password'           => 'required|min:6',
            'confirm_password'   => 'required|same:password'
        ];

        $messages = [
            'email.required'     => 'email wajib diisi',
            'password.required'  => 'Password wajib diisi',
            'confirm_password.required'  => 'Konfirmasi Password wajib diisi',
            'confirm_password.same'  => 'Konfirmasi Password tidak sama dengan password',
            'password.min'       => 'Password wajib diisi minimal 6 karakter'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $input = $request->all();
        $input['verifikasi'] = '2';
        $input['password'] = bcrypt($request->password);
        Santri::create($input);
        return redirect()->back()->with('success','Data berhasi diproses');
    }

    public function login(Request $request)
{
    $rules = [
        'username'    => 'required',
        'password' => 'required|min:6'
    ];

    $messages = [
        'username.required'    => 'username wajib diisi',
        'password.required' => 'Password wajib diisi',
        'password.min'     => 'Password wajib diisi minimal 6 karakter'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->sendError('Error.', $validator->errors()->all());
        }
        return redirect()->back()->withInput($request->all())->withErrors($validator);
    }

    // Try santri guard first
    $santriGuard = Auth::guard('santris');
    if ($santriGuard->attempt($request->only(['username', 'password']))) {
        $santri = $santriGuard->user();
        if ($santri->diterima == 1) {
            Session::put('id', $santri->id);
            Session::put('nama', $santri->username);
            return redirect('/santri/');
        } else {
            $error = ['Anda bukan bagian dari santri kami.'];
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->sendError('Error.', $error);
            }
            return redirect()->back()->withInput($request->all())->withErrors($error);
        }
    }

    // Try default guard if santri guard fails
    $data = [
        'username'    => $request->input('username'),
        'password' => $request->input('password'),
    ];

    if (Auth::attempt($data)) {
        $user = Auth::user();
        Session::put('nama', $user->name);
        Session::put('id', $user->id);
        Session::put('role', $user->getRoleNames()[0]);
        return redirect(url('/'.config('pathadmin.admin_name').'/home'));
    }

    // If both attempts fail
    $error = ['Username Dan Password Salah.'];
    if ($request->expectsJson() || $request->is('api/*')) {
        return $this->sendError('Error.', $error);
    }
    return redirect()->back()->withInput($request->all())->withErrors($error);
}

    public function logout(){
        if (Auth::guard('santris')->logout()) {
            return redirect('/santri/login');
        } else {
            return redirect()->back()->withErrors(['logout_error' => 'Failed to log out.']);
        }
    }
}
