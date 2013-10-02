<?php

namespace GtaCool\Bundle\InuitCssBundle\Generator;

use Sensio\Bundle\GeneratorBundle\Generator\BundleGenerator as BaseBundleGenerator;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Generates a bundle with inuit.css inside.
 *
 * @author Jonathan Plugaru <jplugaru@hotmail.fr>
 */
class BundleGenerator extends BaseBundleGenerator
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
     * @param string $skeletonDir
     * @param string $resourcesInstallationDir
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Filesystem $filesystem, $skeletonDir, $resourcesInstallationDir)
    {
        if (!is_string($skeletonDir)) {
            throw new \InvalidArgumentException("\"$skeletonDir\" must be a string");
        }

        if (!is_string($resourcesInstallationDir)) {
            throw new \InvalidArgumentException("\"$resourcesInstallationDir\" must be a string");
        }

        $this->filesystem = $filesystem;
        $this->skeletonDir = $skeletonDir;
        $this->resourcesInstallationDir = $resourcesInstallationDir;
    }

    public function generate($namespace, $bundle, $dir, $format, $structure)
    {
        parent::generate($namespace, $bundle, $dir, $format, $structure);

        $dir .= '/'.strtr($namespace, '\\', '/');
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