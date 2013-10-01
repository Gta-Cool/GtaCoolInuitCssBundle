<?php

namespace GtaCool\Bundle\InuitCssBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Loads and manages bundle configuration
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class GtaCoolInuitCssExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('inuit.css.xml');
    }
}