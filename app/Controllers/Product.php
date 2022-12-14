<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\ProductModel;

class Product extends BaseController
{
    protected $ProductModel;
    protected $CategoriesModel;
    public function __construct()
    {
        helper(['form']);
        $this->ProductModel = new ProductModel();
        $this->CategoriesModel = new CategoriesModel();
    }

    public function index()
    {
        // pagination
        $paginate = 5;
        $nomor = $this->request->getGet('page_product');
        if ($nomor = null) {
            $nomor = 1;
        }

        // search data
        $keyword = $this->request->getGet('keyword');
        $category = $this->request->getGet('category');

        $where = [];
        $like = [];
        $orLike = [];

        if ($category) {
            $where = ['categories.category_id' => $category];
        }
        if ($keyword) {
            $like = ['products.product_name' => $keyword];
            $orLike = [
                'products.product_sku' => $keyword,
                'products.product_description' => $keyword,
            ];
        }

        $categories =  $this->CategoriesModel->where('category_status', 'Active')->get()->getResultArray();

        $data = [
            'title' => 'Products',
            'categories' => ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id'),
            'product' => $this->ProductModel->join('categories', 'categories.category_id = products.category_id')->where($where)->like($like)->orLike($orLike)->paginate($paginate),
            'pager' => $this->ProductModel->pager,
            'nomor' => ($nomor - 1) * $paginate,
            'category' => $category,
            'keyword' => $keyword
        ];
        return view('products/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Products',
            'validation' => \Config\Services::validation(),
            'category' => $this->CategoriesModel->where('category_status', 'Active')->get()->getResultArray()

        ];
        return view('products/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->ProductModel->getValidationRules())) {
            return redirect()->to('product/create')->withInput();
        }

        // masih error disini
        $fileImage = $this->request->getFile('product_image');
        if ($fileImage->getError() == 4) {
            $namaImage = 'default-150x150.png';
        } else {
            $fileImage->move('img');
            $namaImage = $fileImage->getName();
        }
        $data = [
            'category_id' => $this->request->getVar('category_id'),
            'product_name' => $this->request->getVar('product_name'),
            'product_price' => $this->request->getVar('product_price'),
            'product_sku' => $this->request->getVar('product_sku'),
            'product_status' => $this->request->getVar('product_status'),
            'product_image' => $namaImage,
            'product_description' => $this->request->getVar('product_description'),
        ];
        $this->ProductModel->db->table('products')->insert($data);
        session()->setFlashdata('success', 'Created Product succesfully');

        return redirect('')->to('/product');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Products',
            'validation' => \Config\Services::validation(),
            'category' => $this->CategoriesModel->where('category_status', 'Active')->get()->getResultArray(),
            'product' => $this->ProductModel->table('products')
                ->join('categories', 'categories.category_id = products.category_id ')
                ->where('products.product_id', $id)
                ->find()
        ];
        return view('products/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->ProductModel->getValidationRules())) {
            return redirect()->to('product/edit/' . $id)->withInput();
        }

        // cek gambar apakah nggak berubah
        $fileImage = $this->request->getFile('product_image');
        if ($fileImage->getError() == 4) {
            $namaImage = $this->request->getVar('gambar_lama');
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img', $namaImage);
            // hapus file lama
            if ($this->request->getVar('gambar_lama' != 'default-150x150.png')) {
                unlink('img/' . $this->request->getVar('gambar_lama'));
            }
        }

        $data = [
            'product_id' => $id,
            'category_id' => $this->request->getVar('category_id'),
            'product_name' => $this->request->getVar('product_name'),
            'product_price' => $this->request->getVar('product_price'),
            'product_sku' => $this->request->getVar('product_sku'),
            'product_status' => $this->request->getVar('product_status'),
            'product_image' => $namaImage,
            'product_description' => $this->request->getVar('product_description'),
        ];
        $this->ProductModel->db->table('products')->update($data, ['product_id' => $id]);
        session()->setFlashdata('success', 'Updated Product succesfully');

        return redirect('')->to('/product');
    }

    public function delete($id)
    {
        $produk = $this->ProductModel->find($id);
        if ($produk['product_image'] != 'default-150x150.png') {
            unlink('img/' . $produk['product_image']);
        }

        $hapus = $this->ProductModel->db->table('products')->delete(['product_id' => $id]);
        if ($hapus) {
            session()->setFlashdata('warning', 'Deleted category Succesfully');
            return redirect()->to(base_url('product'));
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Show Product',
            'product' => $this->ProductModel->join('categories', 'categories.category_id = products.category_id')->find($id)
        ];
        return view('products/show', $data);
    }
}
