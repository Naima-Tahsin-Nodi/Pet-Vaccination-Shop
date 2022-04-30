<?php

use PHPUnit\Framework\TestCase;

class MockProductsTest extends TestCase
{
    /** @group db */
    public function testMockProductsAreReturned()
    {
        $mockRepo = $this->createMock(\App\ProductRepository::class);

        $mockProductsArray = [
            ['id' => 1, 'name' => 'fellin'],
            ['id' => 2, 'name' => 'cevac'],
        ];

        $mockRepo->method('fetchProducts')->willReturn($mockProductsArray);

        $products = $mockRepo->fetchProducts();

        $this->assertEquals('fellin', $products[0]['name']);
    }
}