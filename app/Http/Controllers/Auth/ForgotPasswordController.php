<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Models\PasswordResetToken;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{


    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword()
    {
        return view('livewire.pages.auth.forgot-password');
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.exists' => 'O endereço de e-mail fornecido não foi encontrado.',
        ]);

        $token = Str::random(length: 64);

        PasswordResetToken::insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $siteName = Settings::get('site_name') ?? 'WePrêmios';

        try {
            Mail::send('emails.forget-password', ['token' => $token, 'siteName' => $siteName], function ($message) use ($request, $siteName) {
                $message->to($request->email);
                $message->subject('Alteração de Senha - ' . $siteName);
            });

            return redirect()->to(route('forget.password'))
                ->with('sucess', 'Foi enviado um email para alteração da senha');
        } catch (\Exception $e) {
            Log::error('Erro ao enviar e-mail de redefinição de senha: ' . $e->getMessage());
            return redirect()->to(route('forget.password'))
                ->with('error-mail', 'Ocorreu um erro ao enviar o e-mail. Por favor, tente novamente mais tarde.');
        }
    }

    public function resetPassword($token)
    {
        return view('livewire.pages.auth.new-password', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:20'],
            'password_confirmation' => ['required'],
        ], [
            'email.exists' => 'O email informado é inválido.',
            'current_password.required' => 'O campo senha atual é obrigatório.',
            'password.required' => 'O campo nova senha é obrigatório.',
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
        ]);

        $updatePassword = PasswordResetToken::where([
            "email" => $request->email,
            'token' => $request->token
        ])->first();

        if (!$updatePassword) {
            return redirect()->route('reset.password', ['token' => $request->token])->with('error', 'Token inválido ou expirado.');
        }

        // Verifica se o e-mail no token corresponde ao e-mail fornecido no formulário
        if ($updatePassword->email !== $request->email) {
            return redirect()->route('reset.password')->with('error', 'O e-mail fornecido não corresponde ao e-mail associado à solicitação de redefinição de senha.');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        PasswordResetToken::where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success_new_password', 'Senha atualizada com sucesso.');
    }
}