<?php
// app/AppKernel.php

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new FrameworkBundle(),
            new Widop\HttpAdapterBundle\WidopHttpAdapterBundle(),
        );
    }

    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.DIRECTORY_SEPARATOR.'config.yml');
    }
}
