<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Config\Services;

class NewsAdmin extends BaseController
{
    function __construct()
    {
        $this->news = new NewsModel();
    }

    public function index()
    {
        $data['newses'] = $this->news->findAll();
		return view('admin_list_news', $data);
    }

    public function create()
    {
        $req = $this->request;
        //untuk validasi
        $validation = Services::validation();
        $validation->setRules(['title' => 'required']);
        $isValid = $validation->withRequest($this->request)->run();
        if($isValid){
            $this->news->insert([
                'title' => $req->getPost('title'),
                'content' => $req->getPost('content'),
                'status' => $req->getPost('status'),
                'slug' => url_title($req->getPost('title')),
            ]);
            return redirect('admin/news');
        } 
        return view('admin_create_news');
    }

    public function edit($id)
    {
        $req = $this->request;
        $data['news'] = $this->news->where('id',$id)->first();

        $validation = Services::validation();
        $validation->setRules([
            'id' => 'required',
            'title' => 'required'
        ]);
        $isValid = $validation->withRequest($this->request)->run();
        if($isValid){
            $this->news->update($id,[
                'title' => $req->getPost('title'),
                'content' => $req->getPost('content'),
                'status' => $req->getPost('status'),
                'slug' => url_title($req->getPost('title')),
            ]);
            return redirect('admin/news');
        }
        return view('admin_edit_news',$data);
    }

    public function delete($id)
    {
        $this->news->delete($id);
        return redirect('admin/news');
    }
}
