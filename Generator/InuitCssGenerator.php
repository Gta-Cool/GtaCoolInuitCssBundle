<?php

namespace GtaCool\Bundle\InuitCssBundle\Generator;

use Sensio\Bundle\GeneratorBundle\Generator\Generator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

/**
 * Generates inuit.css files inside a bundle.
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class InuitCssGenerator extends Generator
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $skeletonDir;

    /**
     * @var string
     */
    private $resourcesInstallationDir;

    /**
     * Constructor
     *
     * @param Filesystem $filesystem
     * @param string $resourcesInstallationDir
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Filesystem $filesystem, $resourcesInstallationDir)
    {

        if (!is_string($resourcesInstallationDir)) {
            throw new \InvalidArgumentException("\"$resourcesInstallationDir\" must be a string");
        }

        $this->filesystem = $filesystem;
        $this->skeletonDir = __DIR__.'/../Resources/skeleton';
        $this->resourcesInstallationDir = $resourcesInstallationDir;
    }

    public function generate(BundleInterface $bundle)
    {
        $dir = $bundle->getPath();
        $this->filesystem->copy(
            $this->skeletonDir.'/bundle/_vars.scss',
            $dir.'/Resources'.$this->resourcesInstallationDir.'/_vars.scss'
        );
        $this->filesystem->copy(
            $this->skeletonDir.'/bundle/style.scss',
            $dir.'/Resources'.$this->resourcesInstallationDir.'/style.scss'
        );
    }
}