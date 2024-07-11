<?php

namespace App\Controllers\API\v1;

use App\Models\Product;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class ProductController extends ResourceController
{
    protected $productModel;
    protected $validate;

    public function  __construct()
    {
        $this->productModel = new Product();
        $this->validate = Services::validation();
    }

    public function getAllProduct()
    {
        try {
            $products = $this->productModel->findAll();
            if (count($products) > 0) return $this->respond([
                'status' => true,
                'message' => 'List product berhasil di load!',
                'data' => $products
            ], 200);

            return $this->respond(['status' => false, 'message' => 'List product tidak tersedia!'], 404);
        } catch (\Exception $e) {
            return $this->respond(['status' => false, 'message' => $e], 500);
        }
    }

    public function findProduct($id)
    {
        try {
            $product = $this->productModel->find($id);
            if (isset($product)) return $this->respond([
                'status' => true,
                'message' => 'Product berhasil di temukan!',
                'data' => $product
            ], 200);
            return $this->respond(['status' => false, 'message' => 'Product tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return $this->respond(['status' => false, 'message' => $e], 500);
        }
    }

    public function createProduct()
    {
        $this->validate->setRules([
            'productName' => 'required',
            'category' => 'required',
            'qty' => 'required|integer',
        ]);

        if (!$this->validate->withRequest($this->request)->run()) {
            return $this->respond([
                'status' => false,
                'message' => $this->validate->getErrors(),
            ], 404);
        }

        $body = $this->request->getBody();
        if ($body) {
            try {
                $data = json_decode($body);
                $this->productModel->insert($data);
                return $this->respond([
                    'status' => true,
                    'message' => 'Product berhasil ditambahkan!',
                    'data' => $data
                ], 200);
            } catch (\Exception $e) {
                return $this->respond(['status' => false, 'message' => $e], 500);
            }
        }

        return $this->respond(['status' => false, 'message' => 'Product gagal ditambahkan!'], 404);
    }

    public function updateProduct($id)
    {
        $this->validate->setRules([
            'productName' => 'required',
            'category' => 'required',
            'qty' => 'required|integer',
        ]);

        if (!$this->validate->withRequest($this->request)->run()) {
            return $this->respond([
                'status' => false,
                'message' => $this->validate->getErrors(),
            ], 404);
        }

        $body = $this->request->getBody();
        $selectedProduct = $this->productModel->find($id);
        if ($body && $selectedProduct) {
            try {
                $data = json_decode($body);
                $this->productModel->update($selectedProduct->id, $data);
                return $this->respond([
                    'status' => true,
                    'message' => 'Product berhasil di update!',
                    'data' => $data
                ], 200);
            } catch (\Exception $e) {
                return $this->respond(['status' => false, 'message' => $e], 500);
            }
        }

        return $this->respond(['status' => false, 'message' => 'Product gagal di update!'], 404);
    }

    public function deleteProduct($id)
    {
        $selectedProduct = $this->productModel->find($id);
        if ($selectedProduct) {
            try {
                $this->productModel->delete($selectedProduct->id);
                return $this->respond([
                    'status' => true,
                    'message' => 'Product berhasil di hapus!',
                ], 200);
            } catch (\Exception $e) {
                return $this->respond(['status' => false, 'message' => $e], 500);
            }
        }
        return $this->respond(['status' => false, 'message' => 'Product gagal di hapus!'], 404);
    }
}
