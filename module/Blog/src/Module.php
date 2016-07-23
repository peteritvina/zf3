<?php
namespace Blog;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface{
    public function onBootstrap($e){

    }

    public function getConfig(){
        return include __DIR__.'/../config/module.config.php';
    }
}