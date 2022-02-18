<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AsdoriaProduct@AsdoriaSyliusProductCustomerGroupPlugin
 * @package Asdoria\SyliusProductCustomerGroupPlugin
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
final class AsdoriaSyliusProductCustomerGroupPlugin extends Bundle
{
    use SyliusPluginTrait;
}
