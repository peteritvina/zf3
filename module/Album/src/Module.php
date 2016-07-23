<?php
namespace Album;


// Add these import statements:
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;
use Album\Model\Album;
use Interop\Container\ContainerInterface;
use Album\Service\Example;
use Album\Service\Example2;


class Module implements ConfigProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    // Add this method:
    public function getServiceConfig()
    {  
        //echo Model\AlbumTable::class;
        return [
            'factories' => [
                Model\AlbumTable::class => function ($container) {
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    return new Model\AlbumTable($tableGateway);
                },
                Model\AlbumTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);//AdapterInterface::class da duoc register roi
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
               
                Example::class =>InvokableFactory::class,
                Example2::class =>function(ContainerInterface $container,$requestedName){
                    $example = $container->get(Example::class);
                return new Example2($example);
                },        
                /*
                Album\Service\AlbumService::class 	=> function($sm){
                    //$facebookService		= $sm->get('Album\Service\Facebook\Facebook');
                    $mailService	= new \Mvc\Service\MailService();
                    $albumservice	= new AlbumService();
                    return $albumservice;
                },
                */
                //SomeApiService. Khoi tao 1 service
                'SomeApiService' => function($sm){
                    $httpClient = new \Zend\Http\Client;
                    $httpClient->setAdapter(new \Zend\Http\Client\Adapter\Curl());
                    $client = new \Album\Api\SomeApiService();

                },
            ],          
        ];
    }
    // Add this method:
    
    public function getControllerConfig()
    {
        
        return [
            'factories' => [
                Controller\AlbumController::class => function ($container) {
                    
                    //passing service to Controller.
                    return new Controller\AlbumController($container->get(Model\AlbumTable::class));
                },
                Controller\ServiceController::class	=> function($container){
                    $example = $container->get(Example::class);
                    return new Controller\ServiceController(new Example2($example));
                },
            ],
            
        ];
    }
    
    //added for autoloader config
    /*
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    */
}