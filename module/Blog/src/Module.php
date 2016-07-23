<?php
namespace Blog;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface{
    public function onBootstrap($e){
        $app = $e->getApplication();
        $viewModel = $app->getMvcEvent()->getViewModel();
        echo get_class($viewModel);
    }

    public function getConfig(){
        return include __DIR__.'/../config/module.config.php';
    }
}