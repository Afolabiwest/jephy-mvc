<?php
class ProductController extends Controller
{
    public function index()
    {
        // Sample products data - in real app, you'd fetch from database
        $products = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 29.99,
                'description' => 'This is the first product description.'
            ],
            [
                'id' => 2,
                'name' => 'Product 2', 
                'price' => 39.99,
                'description' => 'This is the second product description.'
            ],
            [
                'id' => 3,
                'name' => 'Product 3',
                'price' => 49.99,
                'description' => 'This is the third product description.'
            ]
        ];

        $data = [
            'title' => 'All Products',
            'products' => $products
        ];

        echo $this->render('products/index.tpl', $data);
    }

    public function show($id)
    {
        // Sample product data - in real app, you'd fetch from database
        $product = [
            'id' => $id,
            'name' => 'Product ' . $id,
            'price' => 29.99,
            'description' => 'This is a detailed description for product ' . $id . '.',
            'features' => [
                'Feature 1 for product ' . $id,
                'Feature 2 for product ' . $id,
                'Feature 3 for product ' . $id
            ]
        ];

        $data = [
            'title' => $product['name'],
            'product' => $product
        ];

        echo $this->render('products/show.tpl', $data);
    }
}