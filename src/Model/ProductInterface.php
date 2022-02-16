<?php

declare(strict_types=1);


namespace Asdoria\SyliusProductCustomerGroupPlugin\Model;

use Asdoria\SyliusProductCustomerGroupPlugin\Model\Aware\CustomerGroupsAwareInterface;
use Sylius\Component\Core\Model\ProductInterface as BaseProductInterface;

interface ProductInterface extends BaseProductInterface, CustomerGroupsAwareInterface
{
}
