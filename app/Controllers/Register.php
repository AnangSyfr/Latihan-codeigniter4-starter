<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

class Register extends BaseController
{
    public function __construct()
    {
        $this->users = new UserModel();
    }
    public function index()
    {
        $validation = Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
        ]);
        $isValid = $validation->withRequest($this->request)->run();
        if($isValid){
            $dataFoto = $this->request->getFile('foto');
            $fileName = $dataFoto->getRandomName();
            echo $dataFoto->move('uploads/foto' ,$fileName);
            // $data = [
            //     'username' => $this->request->getPost('username'),
            //     'password' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            //     'foto' => $fileName
            // ];
            // $this->users->insert($data);
            //return redirect('login');
        }
        return view('register');
    }
}
