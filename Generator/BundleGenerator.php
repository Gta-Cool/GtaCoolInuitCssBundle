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

    public function generate($namespace, $bundle, $dir, $format, $structure)
    {
        parent::generate($namespace, $bundle, $dir, $format, $structure);

        $dir .= '/'.strtr($namespace, '\\', '/');
        $this->filesystem->copy($this->skeletonDir.'/bundle/_vars.scss', $dir.'/Resources/public/css/_vars.scss');
        $this->filesystem->copy($this->skeletonDir.'/bundle/style.scss', $dir.'/Resources/public/css/style.scss');
    }
}