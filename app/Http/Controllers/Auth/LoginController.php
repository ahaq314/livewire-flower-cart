<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

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

    public function login(Request $request){

        $this  -> validate($request, [

            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request -> email, 'password' => $request -> password])){

            if (Session::has('oldUrl')){

                $oldUrl  = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect() -> to($oldUrl);
            }

            return redirect() -> route('user.product.list');

        }

        return redirect() -> back();
    }

        public function register(Request $request) {
          

        $this  -> validate($request, [

            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User(['email' => $request -> email,'password' => bcrypt('password')]);

        $user -> save();

        Auth::login($user);

        if (Session::has('oldUrl')){

            $oldUrl  = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect() -> to($oldUrl);
        }

        return redirect() -> route('user.product.list');

    }

    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {


        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('admin.home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    function logout(Request $request){

    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
       
        return redirect() -> route('admin.login');
    }  else {
        Auth::logout();
       
          return redirect() -> route('login');
    }
}
}
