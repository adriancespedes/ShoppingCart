<?php

namespace App;

class Product
{
    private string $name;
    private ?float $price;
    private int $quantity;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = 1;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function __toString()
    {
        return $this->name . sprintf('(%s)', $this->price) ;
    }

    public function addOneItem(): void
    {
        $this->quantity += 1;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

}
