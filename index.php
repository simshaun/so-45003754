<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

require __DIR__.'/vendor/autoload.php';


class App
{
    protected $container;

    public function __construct()
    {
        $builder = new ContainerBuilder(new ParameterBag());
        $builder->addCompilerPass(new RegisterListenersPass());
        $builder->register('event_dispatcher', EventDispatcher::class);

        $loader = new YamlFileLoader($builder, new FileLocator(__DIR__));
        $loader->load('services.yml');

        $builder->compile();
        $this->container = $builder;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->container->get('event_dispatcher');
    }
}


$app = new App();
$ed = $app->getEventDispatcher();
$ed->dispatch('my.event');
