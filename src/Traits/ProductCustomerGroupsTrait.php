<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Customer\Model\CustomerGroupInterface;

trait ProductCustomerGroupsTrait
{
    /**
     * @var Collection|CustomerGroupInterface[]
     *
     * @ORM\ManyToMany(
     *      targetEntity="Sylius\Component\Customer\Model\CustomerGroupInterface",
     *      inversedBy="products")
     * @ORM\JoinTable(
     *      name="asdoria_products_customer_groups",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="customer_group_id", referencedColumnName="id")}
     *      )
     */
    protected $customerGroups;

    public function initializeProductCustomerGroupsCollection()
    {
        $this->customerGroups = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerGroups(): Collection
    {
        return $this->customerGroups;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerGroupsByType(string $type): Collection
    {
        return $this->customerGroups->filter(function (CustomerGroupInterface $customerGroup) use ($type) {
            return $type === $customerGroup->getType();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasCustomerGroups(): bool
    {
        return !$this->customerGroups->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function hasCustomerGroup(CustomerGroupInterface $customerGroup): bool
    {
        return $this->customerGroups->contains($customerGroup);
    }

    /**
     * {@inheritdoc}
     */
    public function addCustomerGroup(CustomerGroupInterface $customerGroup): void
    {
        if (false === $this->hasCustomerGroup($customerGroup)) {
            $this->customerGroups->add($customerGroup);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeCustomerGroup(CustomerGroupInterface $customerGroup): void
    {
        if ($this->hasCustomerGroup($customerGroup)) {
            $this->customerGroups->removeElement($customerGroup);
        }
    }
}
