<?php

namespace Tests\Asdoria\SyliusProductCustomerGroupPlugin\PHPUnit\Traits;

use Asdoria\SyliusProductCustomerGroupPlugin\Traits\ProductCustomerGroupsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Customer\Model\CustomerGroup;

class ProductCustomerGroupsTraitTest extends TestCase
{
    private $customerGroup;
    private $customerGroup2;

    public function setUp(): void
    {
        $this->customerGroup = new CustomerGroup();
        $this->customerGroup->setName('Customer Group');
        $this->customerGroup->setCode('customer_group');

        $this->customerGroup2 = new CustomerGroup();
        $this->customerGroup2->setName('Customer Group 2');
        $this->customerGroup2->setCode('customer_group_2');

    }

    public function testInitializeGroupsCollection(): object
    {
        $productCustomerGroupsTrait = new class {
            use ProductCustomerGroupsTrait;
        };
        $productCustomerGroupsTrait->initializeProductCustomerGroupsCollection();

        $this->assertInstanceOf(ArrayCollection::class,$productCustomerGroupsTrait->getCustomerGroups());

        return $productCustomerGroupsTrait;
    }

    /** @depends testInitializeGroupsCollection */
    public function testAddAndRemoveCustomerGroup($productCustomerGroupsTrait): void
    {
        $productCustomerGroupsTrait->addCustomerGroup($this->customerGroup);
        $productCustomerGroupsTrait->addCustomerGroup($this->customerGroup2);

        $this->assertTrue($productCustomerGroupsTrait->hasCustomerGroups());
        $this->assertTrue($productCustomerGroupsTrait->hasCustomerGroup($this->customerGroup));
        $this->assertCount(2,$productCustomerGroupsTrait->getCustomerGroups());

        $productCustomerGroupsTrait->removeCustomerGroup($this->customerGroup);

        $this->assertFalse($productCustomerGroupsTrait->hasCustomerGroup($this->customerGroup));
        $this->assertCount(1,$productCustomerGroupsTrait->getCustomerGroups());

    }
}