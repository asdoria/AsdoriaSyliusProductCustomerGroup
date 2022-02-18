<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\DependencyInjection;

use Sylius\Bundle\CoreBundle\DependencyInjection\PrependDoctrineMigrationsTrait;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


/**
 * Class AsdoriaProductCustomerGroupExtension
 * @package Asdoria\SyliusProductCustomerGroupPlugin\DependencyInjection
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class AsdoriaSyliusProductCustomerGroupExtension implements PrependExtensionInterface
{
    use PrependDoctrineMigrationsTrait;
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
    }


    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container): void
    {
        $this->prependDoctrineMigrations($container);
    }

    /**
     * {@inheritdoc}
     */
    protected function getMigrationsNamespace(): string
    {
        return 'Asdoria\SyliusProductCustomerGroupPlugin\Migrations';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMigrationsDirectory(): string
    {
        return '@AsdoriaSyliusProductCustomerGroupPlugin/Migrations';
    }

    /**
     * {@inheritdoc}
     */
    protected function getNamespacesOfMigrationsExecutedBefore(): array
    {
        return ['Sylius\Bundle\CoreBundle\Migrations'];
    }
}
