<?php

namespace GtaCool\Bundle\InuitCssBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateBundleCommand as BaseGenerateBundleCommand;
use GtaCool\Bundle\InuitCssBundle\Generator\BundleGenerator;

/**
 * Generates bundles with inuit.css files inside.
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class GenerateBundleCommand extends BaseGenerateBundleCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('gta-cool:inuit.css:generate-bundle');
        $this->setDescription('Generates a bundle with inuit.css installed inside');
        $help = $this->getHelp();
        $help = str_replace('generate:bundle', 'gta-cool:inuit.css:generate-bundle', $help);
        $help = str_replace('bundles', 'bundles with inuit.css installed inside', $help);
        $this->setHelp($help);
    }

    protected function createGenerator()
    {
        return new BundleGenerator(
            $this->getContainer()->get('filesystem'),
            $this->getContainer()->getParameter('inuit_css.bundle.resources_installation_dir')
        );
    }
}
