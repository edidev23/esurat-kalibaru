<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => [
                'required', 'string',
                Rule::exists('users')->where(function ($query) {
                    $query->where('status', true);
                })
            ],
            'password' => 'required',
        ], [
            $this->username() . '.exists' => 'Masukkan email dan password dengan benar.'
        ]);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validateLogin($request);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            // dd(auth()->user()->jabatan);
            if (auth()->user()->jabatan == 'admin') {
                return redirect('admin');
            } elseif (auth()->user()->jabatan == 'kepala_desa' || auth()->user()->jabatan == 'sekdes') {
                return redirect('kades');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {

            dd($response);
            return $response;
        }

        return redirect()->route('login')
            ->with('error', 'Email-Address And Password Are Wrong.');
    }
}
