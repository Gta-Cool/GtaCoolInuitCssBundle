<?php

namespace GtaCool\Bundle\InuitCssBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use GtaCool\Bundle\InuitCssBundle\DependencyInjection\AsseticSassFiltersCompilerPass;

/**
 * Bundle class
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class GtaCoolInuitCssBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AsseticSassFiltersCompilerPass());
    }
}
