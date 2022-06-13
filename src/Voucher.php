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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

    /**
     * @return string
     */
    public function getDiscountValueModifier(): string
    {
        return $this->discountValueModifier;
    }


    /**
     * @return Product|null
     */
    public function getDiscountedProduct(): ?Product
    {
        return $this->discountedProduct;
    }

    /**
     * @return int
     */
    public function getDiscountedRuleAmount(): int
    {
        return $this->discountedRuleAmount;
    }
}