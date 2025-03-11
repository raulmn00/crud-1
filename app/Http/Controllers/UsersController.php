<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed'
    ]);

    // Usar Hash::make para garantir compatibilidade com Auth::attempt
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'secure_id' => (string) Str::uuid()
    ]);

    // Opcional: Faça login automaticamente após o registro
    // Auth::login($user);

    return redirect()
      ->route('login')
      ->with('success', 'Conta criada com sucesso! Faça login para continuar.');
  }

  public function passwordRequest(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users,email'
    ]);

    // Generate a password reset token
    $token = Str::random(60);

    // Store the token in the password_resets table
    DB::table('password_resets')->insert([
      'email' => $request->email,
      'token' => $token,
      'created_at' => now()
    ]);

    // Send the password reset email
    Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($request) {
      $message->to($request->email);
      $message->subject('Reset Password Notification');
    });

    return back()->with('success', 'Enviamos um link para redefinição de senha para o seu email!');
  }

  public function showRegister()
  {
    return view('auth.register');
  }

  public function showLogin()
  {
    return view('auth.login');
  }

  public function showPasswordRequest()
  {
    return view('auth.passwords.email');
  }
}
