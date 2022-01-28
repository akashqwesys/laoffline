<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Logs;
use App\Models\Employee;
use Carbon;

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
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('username' => $input['email'], 'password' => $input['password']))) {
            $user = Auth::User();
            $employee = Employee::where('id', $user->employee_id)->first();
            $user['excel_access'] = $employee->excel_access;

            Session::put('user', $user);
            
            $logsLastId = Logs::orderBy('id', 'DESC')->first('id');
            $logsId = !empty($logsLastId) ? $logsLastId->id + 1 : 1;
                            
            $logs = new Logs;
            $logs->id = $logsId;
            $logs->employee_id = $user->employee_id;
            $logs->log_path = 'Login';
            $logs->log_subject = 'Login Successfully.';
            $logs->log_url = 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $logs->save();

            $employee = Employee::where('id', $user->employee_id)->first();
            $employee->web_login = Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $employee->save();    

            return redirect()->route('home');
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
}
