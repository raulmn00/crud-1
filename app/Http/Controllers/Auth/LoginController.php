<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    // Verificação de debug para encontrar o problema
    $user = User::where('email', $request->email)->first();

    if ($user) {
      // Teste explícito da senha para diagnóstico
      if (Hash::check($request->password, $user->password)) {
        // Login manual
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('products.my'));
      }
    }

    return back()->withErrors([
      'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->withInput($request->except('password'));
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
}
