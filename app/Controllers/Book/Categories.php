<?php

namespace App\Controllers\Book;
use App\Controllers\BaseController;


class Categories extends BaseController
{
    public function index()
    {
        return view('book/categories');
       
    }
    public function add()
    {
        return view('book/add');
    }
    public function edit(string $id)
    {
        echo ($id);
    }
    public function delete(string $id)
    {
        echo ($id);

    }
}
