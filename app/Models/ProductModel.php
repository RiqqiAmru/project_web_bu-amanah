<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['.'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'category_id'    => 'required',
        'product_name'    => 'required',
        'product_price'    => 'required',
        'product_sku'    => 'required',
        'product_status'    => 'required',
        'product_description'    => 'required',
        'product_image'    => 'is_image[product_image]|mime_in[product_image,image/jpeg,image/jpg,image/gif,image/png]|max_size[product_image,1024]',
    ];
    protected $validationMessages   = [
        'category_id'   =>  ['required' => 'nama Category harus diisi'],
        'product_name'   =>  ['required' => 'nama product harus diisi'],
        'product_price'   =>  ['required' => 'harga product harus diisi'],
        'product_sku'   =>  ['required' => 'kode product harus diisi'],
        'product_status'   =>  ['required' => 'status product harus diisi'],
        'product_description'   =>  ['required' => 'deskripsi  product harus diisi'],
        'product_image'   =>  [
            'mime_in' => 'gambar product hanya boleh diisi oleh file jpeg/jpg/gif/png',
            'max_size' => 'gambar product maksimal 1 mb',
            'uploaded' => 'gambar product wajib diisi',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getProduct($id = false)
    {
        if ($id == false) {
            return $this->table('products')
                ->join('categories', 'categories.category_id = products.category_id')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('products')
                ->join('categories', 'products.category_id = categories.category_id')
                ->where('products.product_id', $id)
                ->get()
                ->getResultArray();
        }
    }
}