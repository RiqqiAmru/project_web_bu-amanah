<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;

class Category extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new CategoriesModel();
    }
    public function index()
    {
        $data = [
            'categories' => $this->model->findAll()
        ];
        return view('category/index', $data);
    }
    public function create()
    {
        # code...
        return view('category/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status')
        );

        if ($validation->run($data, 'category') == FALSE) {
            session()->setFlashdata('input', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('category/create'));
        } else {
            $simpan = $this->model->db->table('categories')->insert($data);
            if ($simpan) {
                session()->setFlashdata('success', 'Created Category successfully');
                return redirect()->to(base_url('category'));
            }
        }
    }
    public function edit($id)
    {
        $data['category'] = $this->model->find($id);
        echo view('category/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('category_id');
        $validation = \Config\Services::validation();

        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status')
        );

        if ($this->model->validate($data) == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors',  $this->model->getValidationMessages());
            return redirect()->to(base_url('category/edit/' . $id));
        } else {
            $ubah = $this->model->db->table('categories')->update($data, ['category_id' => $id]);
            if ($ubah) {
                session()->setFlashdata('info', 'Updated Category');
                return redirect()->to(base_url('category'));
            }
        }
    }

    public function delete($id)
    {
        $hapus = $this->model->db->table('categories')->delete(['category_id' => $id]);
        if ($hapus) {
            session()->setFlashdata('warning', 'Deleted Category Succesfully');
            return redirect()->to(base_url('category'));
        }
    }
}
