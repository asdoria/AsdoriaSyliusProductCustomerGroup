<?php

declare(strict_types=1);


namespace Asdoria\SyliusProductCustomerGroupPlugin\Model\Aware;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;


interface ProductsAwareInterface
{
    /**
     * @return bool
     */
    public function hasProducts(): bool;

    /**
     * @return Collection
     */
    public function getProducts(): Collection;

    /**
     * @param ProductInterface $product
     *
     * @return bool
     */
    public function hasProduct(ProductInterface $product): bool;

    /**
     * @param ProductInterface $product
     */
    public function addProduct(ProductInterface $product): void;

    /**
     * @param ProductInterface $product
     */
    public function removeProduct(ProductInterface $product): void;
}
