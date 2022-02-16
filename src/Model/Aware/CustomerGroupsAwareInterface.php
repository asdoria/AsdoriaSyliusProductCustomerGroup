<?php

declare(strict_types=1);


namespace Asdoria\SyliusProductCustomerGroupPlugin\Model\Aware;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Customer\Model\CustomerGroupInterface;

interface CustomerGroupsAwareInterface
{
    /**
     * @return bool
     */
    public function hasCustomerGroups(): bool;

    /**
     * @return Collection|CustomerGroupInterface[]
     */
    public function getCustomerGroups(): Collection;

    /**
     * @param CustomerGroupInterface $customerGroup
     *
     * @return bool
     */
    public function hasCustomerGroup(CustomerGroupInterface $customerGroup): bool;

    /**
     * @param CustomerGroupInterface $customerGroup
     */
    public function addCustomerGroup(CustomerGroupInterface $customerGroup): void;

    /**
     * @param CustomerGroupInterface $customerGroup
     */
    public function removeCustomerGroup(CustomerGroupInterface $customerGroup): void;
}
