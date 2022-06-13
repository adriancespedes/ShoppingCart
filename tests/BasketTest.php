<?php

namespace Tests;

use App\Product as Product;
use App\Voucher as Voucher;
use App\Basket as Basket;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private Product $productA;
    private Product $productB;
    private Product $productC;
    private Voucher $voucherV;
    private Voucher $voucherR;
    private Voucher $voucherS;

    /** @test */
    public function theTruth(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function testOutputIs39eurosBasketValue(): void
    {
        // Example 1
        //Product A added + Product C added + Voucher S added + Product A added + Voucher V added
        // + Product B added.
        //> Total cart value: 39€
        $basket = new Basket();
        $basket->addProduct($this->productA);
        $basket->addProduct($this->productC);
        $basket->addVoucher($this->voucherS);
        $basket->addProduct($this->productA);
        $basket->addVoucher($this->voucherV);
        $basket->addProduct($this->productB);

        $this->assertSame('> Total cart value: 39,00€', $basket->__toString());
    }

    /** @test */
    public function testOutputIs5510centsEurosBasketValue(): void
    {
        // Example 1
        //Product A added + Product C added + Voucher S added + Product A added + Voucher V added
        // + Product B added.
        //> Total cart value: 39€
        $basket = new Basket();
        $basket->addProduct($this->productA);
        $basket->addVoucher($this->voucherS);
        $basket->addProduct($this->productA);
        $basket->addVoucher($this->voucherV);
        $basket->addProduct($this->productB);
        $basket->addVoucher($this->voucherR);
        $basket->addProduct($this->productC);
        $basket->addProduct($this->productC);
        $basket->addProduct($this->productC);

        $this->assertSame('> Total cart value: 55,10€', $basket->__toString());
    }

    protected function setUp(): void
    {
        $this->productA = new Product("Product A", 10);
        $this->productB = new Product("Product B", 8);
        $this->productC = new Product("Product C", 12);

        //10% off discount voucher for the second unit applying only to Product A
        $this->voucherV = new Voucher("Voucher V", 0.1, "percent", $this->productA, 2);

        //5€ off discount on product type B
        $this->voucherR = new Voucher("Voucher R", 5, "amount", $this->productB, 1);

        //5% discount on a cart value over 40€
        $this->voucherS = new Voucher("Voucher S", 5, "percent", null, 40);

    }

}
