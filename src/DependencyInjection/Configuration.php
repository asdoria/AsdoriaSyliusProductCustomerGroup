<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\DependencyInjection;

use Asdoria\SyliusProductCustomerGroupPlugin\Doctrine\ORM\CustomerGroupImageRepository;
use Asdoria\SyliusProductCustomerGroupPlugin\Doctrine\ORM\CustomerGroupRepository;
use Asdoria\SyliusProductCustomerGroupPlugin\Doctrine\ORM\CustomerGroupTranslationRepository;
use Asdoria\SyliusProductCustomerGroupPlugin\Entity\CustomerGroup;
use Asdoria\SyliusProductCustomerGroupPlugin\Entity\CustomerGroupImage;
use Asdoria\SyliusProductCustomerGroupPlugin\Entity\CustomerGroupTranslation;
use Asdoria\SyliusProductCustomerGroupPlugin\Form\Type\CustomerGroupImageType;
use Asdoria\SyliusProductCustomerGroupPlugin\Form\Type\CustomerGroupTranslationType;
use Asdoria\SyliusProductCustomerGroupPlugin\Form\Type\CustomerGroupType;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;


/**
 * Class Configuration
 * @package Asdoria\SyliusProductCustomerGroupPlugin\DependencyInjection
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('asdoria_product_customer_group');
        $rootNode    = $treeBuilder->getRootNode();
        

        return $treeBuilder;
    }

}
