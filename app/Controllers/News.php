<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    function __construct()
    {
        $this->news = new NewsModel();
    }

    public function index()
    {
        $data = [
            'newses' => $this->news->where('status','published')->findAll()
        ];

        return view('news',$data);
    }
}
