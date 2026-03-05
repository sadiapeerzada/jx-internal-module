<?php

defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\PluginServiceProvider;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(
            new PluginServiceProvider(
                'content',
                'autotitleajax',
                \Joomla\Plugin\Content\AutoTitleAjax\Extension\AutoTitleAjax::class
            )
        );
    }
};
