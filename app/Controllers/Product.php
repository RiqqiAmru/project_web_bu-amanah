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
        $data = [
            'product' => $this->ProductModel->table('products')
                ->join('categories', 'categories.category_id = products.category_id ')
                ->where('categories.category_status', 'Active')
                ->get()
                ->getResultArray(),
            'title' => 'Products'
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
        $fileImage = $this->request->getFile('product_image');

        // cek gambar apakah nggak berubah
        if ($fileImage->getError() == 4) {
            $namaImage = $this->request->getVar('gambar_lama');
        } {
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
}
