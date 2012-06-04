<?php

namespace Soloist\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SoloistBlogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('soloist_blog_max_per_page', $config['max_per_page']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $imagineFilters = array();
        try {
            $imagineFilters = $container->getParameter('imagine.filters');
        } catch (\Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException $e) {}

        $imagineFilters['soloist_blog_admin_thumb'] = array(
            'type'    => 'thumbnail',
            'options' => array(
                'mode' => 'outbound',
                'size' => array(200, 200)
            )
        );

        $container->setParameter('imagine.filters', $imagineFilters);
    }
}
