<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

final class AdminProductFormMenuListener
{
    /**
     * @param ProductMenuBuilderEvent $event
     */
    public function addItems(ProductMenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->addChild('customer_groups')
            ->setAttribute('template', '@AsdoriaSyliusProductCustomerGroupPlugin/Admin/Product/_customer_groups.html.twig')
            ->setLabel('asdoria.ui.customer_groups')
        ;
    }
}
