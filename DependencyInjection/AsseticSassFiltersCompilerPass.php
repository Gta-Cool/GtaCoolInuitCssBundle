<?php

namespace GtaCool\Bundle\InuitCssBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Assetic Sass filters Compiler Pass
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class AsseticSassFiltersCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('inuit_css.component.root_dir')) {
            return;
        }

        // Construct inuit.css component root dir
        $inuitCssComponentRootDir = $container->getParameter('kernel.root_dir').'/..';
        $inuitCssComponentRootDir .= $container->getParameter('inuit_css.component.root_dir');
        $inuitCssComponentRootDir = realpath($inuitCssComponentRootDir);

        // Add inuit.css component root dir to assetic sass and scss filters
        if ($inuitCssComponentRootDir) {
            if ($container->hasDefinition('assetic.filter.sass')) {
                $sassDefinition = $container->getDefinition('assetic.filter.sass');
                $sassDefinition->addMethodCall('addLoadPath', array($inuitCssComponentRootDir));
            }
            if ($container->hasDefinition('assetic.filter.scss')) {
                $scssDefinition = $container->getDefinition('assetic.filter.scss');
                $scssDefinition->addMethodCall('addLoadPath', array($inuitCssComponentRootDir));
            }
        }
    }
}
