<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Illuminate\Http\Request;
use Workable\AuditLog\Services\HistoryLoginService;

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
    protected $redirectTo = '/admin';
    protected $loginService;
    /**
     * Create a new controller instance.
     *
     * @return void   TestJobDataController
     */
    public function __construct(HistoryLoginService $login)
    {
        $this->loginService = $login;
    }

    public function getLogin ()
    {
        return view('auth_admin.login');
    }

    public function postLogin(Request $request)
    {
        //
        $this->validate($request, $this->getAdminLoginRequestRules(),
            $this->getAdminLoginRequestMessages());

        $credentials = [
            'email'         =>  $request->email,
            'password'      =>  $request->password,
            'active'        => 1
        ];

        if (Auth::guard('admins')->attempt($credentials, $request->has('remember')))
        {
            //insert ip
           $this->loginService->insertLogin($request->ip());
            return redirect('/company');
        }

        return $this->sendFailedLoginResponse($request);
//            ->withErrors([
//            'email' => 'Email khong chính xác',
//        ])->onlyInput('email');
    }

    //rule login
    public function getAdminLoginRequestRules()
    {
        return [
            'email'     =>  'required|email|max:255',
            'password'  =>  'required|regex:/^[a-z0-9A-Z_-]{4,100}$/'
        ];
    }

    //msg login
    public function getAdminLoginRequestMessages(){
        return [
            'email.required'        =>  'Vui lòng nhập email',
            'email.email'           =>  'Email chưa xác nhận',
            'email.max'             =>  'Địa chỉ email quá dài',
            'password.required'     =>  'Vui lòng nhập mật khẩu',
        ];
    }

    public function getLogout()
    {
        Auth::guard('admins')->logout();
        \Session::flush();

        return redirect()->route('get.admin.login');
    }
}
