<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;

trait ProductsTrait
{
    /**
     * @var Collection|ProductInterface[]
     *
     * @ORM\ManyToMany(
     *      targetEntity="Sylius\Component\Core\Model\ProductInterface",
     *      mappedBy="customerGroups")
     */
    protected $products;

    public function initializeProductProductsCollection()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductsByType(string $type): Collection
    {
        return $this->products->filter(function (ProductInterface $product) use ($type) {
            return $type === $product->getType();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasProducts(): bool
    {
        return !$this->products->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function hasProduct(ProductInterface $product): bool
    {
        return $this->products->contains($product);
    }

    /**
     * {@inheritdoc}
     */
    public function addProduct(ProductInterface $product): void
    {
        if (false === $this->hasProduct($product)) {
            $this->products->add($product);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(ProductInterface $product): void
    {
        if ($this->hasProduct($product)) {
            $this->products->removeElement($product);
        }
    }
}
