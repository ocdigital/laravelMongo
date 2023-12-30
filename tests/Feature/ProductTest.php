
<?php

use App\Models\Product;

    //criacao de um novo produto

    it('can create a product', function () {
        $response = $this->post('/api/products', [
            'name' => 'Product 1',
            'price' => 10.00,
            'description' => 'Product 1 description'
        ]);

        expect($response->getStatusCode())->toBe(201);
        expect($response->assertJsonFragment([
            'name' => 'Product 1',
            'price' => 10.00,
            'description' => 'Product 1 description'
        ]));
    });

    it('can list products', function () {
        $response = $this->get('/api/products');

        expect($response->getStatusCode())->toBe(200);
        expect($response->assertJsonFragment([
            'name' => 'Product 1',
            'price' => 10.00,
            'description' => 'Product 1 description'
        ]));
    });

    it('can update a product', function () {
        $product = Product::first();
        $response = $this->put('/api/products/'.$product->id, [
            'name' => 'Product 1 updated',
            'price' => 20.00,
            'description' => 'Product 1 description updated'
        ]);

        expect($response->getStatusCode())->toBe(200);
        expect($response->assertJsonFragment([
            'name' => 'Product 1 updated',
            'price' => 20.00,
            'description' => 'Product 1 description updated'
        ]));
    });

    it('can delete a product', function () {

        //get first product
        $product = Product::first();
        if(!$product) {
            $product = Product::create([
                'name' => 'Product 1',
                'price' => 10.00,
                'description' => 'Product 1 description'
            ]);
        }

        $response = $this->delete('/api/products/' . $product->id);

        expect($response->getStatusCode())->toBe(204);
        expect($response->assertNoContent());
    });
