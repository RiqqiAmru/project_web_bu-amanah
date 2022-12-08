<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\ProductModel;

class Product extends BaseController
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->ProductModel = new ProductModel();
        $this->CategoriesModel = new CategoriesModel();
    }

    public function index()
    {
        $data = [
            'product' => $this->ProductModel->table('products')
                ->join('categories', 'categories.category_id = products.category_id ')
                ->get()
                ->getResultArray()
        ];
        return view('products/index', $data);
    }
}