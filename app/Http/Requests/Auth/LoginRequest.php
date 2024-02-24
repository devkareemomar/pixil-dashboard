<?php

namespace App\Http\Requests\Auth;

use App\Models\LogLogin;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $username = $this->input('username');
        $fieldType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user=User::where(function ($q) use ($username){
            $q->where('email', $username)->orWhere('username', $username);
        })->first();
        if (!Auth::attempt([
            $fieldType => $username,
            'password' => $this->input('password'),
        ], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            if ($user){
                LogLogin::create([
                    'user_id'=>$user->id,
                    'user_ip'=>request()->ip(),
                    'browser_name'=>request()->header('user-agent'),
                    'is_success'=>false,
                ]);
            }
            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }
        LogLogin::create([
            'user_id'=>$user->id,
            'user_ip'=>request()->ip(),
            'browser_name'=>request()->header('user-agent'),
            'is_success'=>true,
        ]);
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {

        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('username')) . '|' . $this->ip());
    }
}
