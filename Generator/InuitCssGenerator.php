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
     * Constructor
     *
     * @param Filesystem $filesystem
     * @param string $skeletonDir
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Filesystem $filesystem, $skeletonDir)
    {
        if (!is_string($skeletonDir)) {
            throw new \InvalidArgumentException("\"$skeletonDir\" must be a string");
        }

        $this->filesystem = $filesystem;
        $this->skeletonDir = $skeletonDir;
    }

    public function generate(BundleInterface $bundle)
    {
        $dir = $bundle->getPath();
        $this->filesystem->copy($this->skeletonDir.'/bundle/_vars.scss', $dir.'/Resources/public/css/_vars.scss');
        $this->filesystem->copy($this->skeletonDir.'/bundle/style.scss', $dir.'/Resources/public/css/style.scss');
    }
}