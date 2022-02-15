<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

class Login extends BaseController
{
    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index()
    {
        return view('login');
    }

    public function auth(){
        $session = session();
        $req = $this->request;
        $data = $this->users->where('username', $req->getPost('username'))->first();
        if($data){
            $check_password = password_verify($req->getPost('password'),$data['password']);
            if($check_password){
                $data_user = [
                    'username' => $data['username'],
                    'logged_in' => TRUE
                ];
                $session->set($data_user);
                return redirect('admin/news');
            } else {
                $session->setFlashdata('msg','Wrong Password 1');
                return redirect('login');
            }
        } else {
            $session->setFlashdata('msg','Wrong Password 2');
            return redirect('login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect('login');
    }
}
