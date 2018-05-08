<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Services\User\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.change-passwords.show');
    }
    public function update(ChangePasswordRequest $request, Password $passwordService)
    {
        Log::debug('User password update started');
        try {
            $passwordService->change(Auth::user(), $request->old_password, $request->password);
        }
        catch (\InvalidArgumentException $exception){
            Log::warning("User password update failed", ['error' => $exception->getMessage()]);
            $request->session()->flash('error', $exception->getMessage());
            return redirect()->route('change-password.show');
        }

        Log::info("User password update completed");
        $request->session()->flash('success', 'Password changed');
        return redirect()->route('home');
    }
}
