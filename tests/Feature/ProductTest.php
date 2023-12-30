<?php

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
