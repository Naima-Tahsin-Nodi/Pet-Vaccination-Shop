<?php

class InventoryTest extends \PHPUnit\Framework\TestCase
{

    /** @group db */
    public function testProductsCanBeSet()
    {
        // Setup
        $mockRepo = $this->createMock(\App\ProductRepository::class);

        $inventory = new \App\Inventory($mockRepo);


        $mockProductsArray = [
            ['id' => 1, 'name' => 'Parvo virous'],
            ['id' => 2, 'name' => 'Cevac'],
            ['id' => 3, 'name' => 'Distemper'],
            ['id' => 4, 'name' => 'frcpv'],
            ['id' => 5, 'name' => 'Rabies'],
            ['id' => 6, 'name' => 'Hepatites'],
        ];

        $mockRepo->expects($this->exactly(1))->method('fetchProducts')->willReturn($mockProductsArray);

        // Do something

        $inventory->setProducts();

        // Make assertions
        $this->assertEquals('Parvo virous', $inventory->getProducts()[0]['name']);
        $this->assertEquals('Cevac', $inventory->getProducts()[1]['name']);
        $this->assertEquals('Distemper', $inventory->getProducts()[2]['name']);
        $this->assertEquals('frcpv', $inventory->getProducts()[3]['name']);
        $this->assertEquals('Rabies', $inventory->getProducts()[4]['name']);
        $this->assertEquals('Hepatites', $inventory->getProducts()[5]['name']);
    }













}