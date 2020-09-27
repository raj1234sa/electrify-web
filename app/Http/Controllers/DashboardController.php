<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $postdata['redirecturl'] = $request->input('redirecturl');
        return view('login', $postdata);
    }

    public function dashboard()
    {
        $breadcrumbs = array(
            array(
                'title' => 'Dashboard',
                'active' => true,
            ),
        );
        $data = array(
            'page_name' => substr(url()->current(), strrpos(url()->current(), '/') + 1),
            'breadcrumbs' => $breadcrumbs,
        );
        return view('dashboard', $data);
    }

    public function loginAuth(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $backUrl = $request->input('backUrl');
        if($username == 'admin' && $password == 'admin') {
            $admin = array(
                'displayName'=>'Mahadev',
                'username'=>'admin',
            );
            $request->session()->put('admin_login', $admin);
            if(!empty($backUrl)) {
                return redirect($backUrl);
            }
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('fail', 'Username or Password is wrong!!');
        }
        exit;
    }

    public function login(Request $request)
    {
        $backUrl = $request->input('backUrl');
    }

    public function getLoginAdmin(Request $request) {
        return $request->session()->get('admin_login');
    }

    public static function getLoginAdminStatic() {
        return Session::get('admin_login');
    }

    public function logout(Request $request) {
        $request->session()->forget(['admin_login']);
        return redirect('/');
    }
}
