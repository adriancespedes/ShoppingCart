<?php

namespace App;

use App\Product as Product;
use App\Voucher as Voucher;

class Basket
{
    private array $products;
    private array $vouchers;

    public function addProduct(Product $product)
    {
        if ($this->productExistsinBasket($product)) {
            $this->products[$product->getName()]->addOneItem();
        } else {
            $this->products[$product->getName()] = $product;
        }
    }

    private function productExistsInBasket(Product $product): bool
    {
        if (isset($this->products[$product->getName()])) {
            return true;
        }
        return false;
    }

    public function addVoucher(Voucher $voucher)
    {
        if (!$this->voucherExpectsAProductInTheBasket($voucher)) {
            $this->vouchers[] = $voucher;
        } else {
            array_unshift($this->vouchers, $voucher);
        }
    }

    private function voucherExpectsAProductInTheBasket(\App\Voucher $voucher): bool
    {
        if (empty($voucher->getDiscountedProduct())) {
            return false;
        }
        return true;
    }

    public function __toString()
    {
        return '> Total cart value: ' . number_format($this->getTotalAmount(), 2, ",", ".") . '€';
    }

    private function getTotalAmount()
    {
        $basketAmount = 0;
        /** @var Product $product */
        foreach ($this->products as $product) {
            $basketAmount += $product->getPrice() * $product->getQuantity();
        }

        $voucherAmount = 0;
        /** @var Voucher $voucher */
        foreach ($this->vouchers as $voucher) {
            if ($this->voucherExpectsAProductInTheBasket($voucher)) {
                /** @var Product $voucherDiscountedProduct */
                $voucherDiscountedProduct = $voucher->getDiscountedProduct();
                if ($voucher->getDiscountValueModifier() === 'percent') {
                    /** @var Product $basketProduct */
                    $basketProduct = $this->products[$voucherDiscountedProduct->getName()];
                    $voucherAmount += ($voucherDiscountedProduct->getPrice() * $voucher->getDiscountValue()) * floor($basketProduct->getQuantity() / $voucher->getDiscountedRuleAmount());
                }
                if ($voucher->getDiscountValueModifier() === 'amount') {
                    /** @var Product $basketProduct */
                    $basketProduct = $this->products[$voucherDiscountedProduct->getName()];

                    $voucherAmount += ($basketProduct->getQuantity() * $voucher->getDiscountValue());
                }
            } else {
                if ($basketAmount > $voucher->getDiscountedRuleAmount()) {
                    if ($voucher->getDiscountValueModifier() === 'percent') {
                        $voucherAmount += ($voucher->getDiscountValue() / 100 * ($basketAmount - $voucherAmount));
                    }
                    if ($voucher->getDiscountValueModifier() === 'amount') {
                        $voucherAmount += $voucher->getDiscountValue();
                    }
                }
            }
        }

        return round($basketAmount - $voucherAmount, 2);
    }

}