<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
      $request->session()->regenerate();

      return redirect()->intended('/');
    }

    return back()->withErrors([
      'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->withInput($request->except('password'));
  }
}
