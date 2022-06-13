<?php

namespace App;

use App\Product as Product;

class Voucher
{
    private string $name;
    private float $discountValue;
    private string $discountValueModifier;
    private ?Product $discountedProduct;
    private int $discountedRuleAmount;

    public function __construct(string $name, float $discountValue, string $discountValueModifier, ?Product $discountedProduct, int $discountedRuleAmount)
    {
        $this->name = $name;
        $this->discountValue = $discountValue;
        $this->discountValueModifier = $discountValueModifier;
        $this->discountedProduct = $discountedProduct;
        $this->discountedRuleAmount = $discountedRuleAmount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

    public function getDiscountValueModifier(): string
    {
        return $this->discountValueModifier;
    }

    public function getDiscountedProduct(): ?Product
    {
        return $this->discountedProduct;
    }

    public function getDiscountedRuleAmount(): int
    {
        return $this->discountedRuleAmount;
    }
}