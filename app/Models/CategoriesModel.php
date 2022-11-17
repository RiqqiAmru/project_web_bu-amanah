<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $protectFields    = true;
    protected $allowedFields    = ['category_name', 'category_status'];

    // Validation
    protected $validationRules      = [
        'category_name'     => 'required',
        'category_status'     => 'required'
    ];
    protected $validationMessages   = [
        'category_name' => [
            'required'    => 'Nama category wajib diisi.',
        ],
        'category_status'    => [
            'required' => 'Status category wajib diisi.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
