<?php
namespace Users;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Users\Model\Users;
use Users\Model\UsersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        
        $moduleRouteListener = new ModuleRouteListener();
        
        $moduleRouteListener->attach($eventManager);
        /*
        print"<pre>";
        var_dump($moduleRouteListener);
        print"</pre>";*/
    }

    public function getConfig()
    {                 
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        $arr = array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        ); 
        
        return $arr;
    }

    public function getServiceConfig()
    {
        return array(
            
            'factories' => array(
                
                'Users\Model\UsersTable' => function ($sm) {
                    
                    $tableGateway = $sm->get('UsersTableGateway');
                    
                    $table = new UsersTable($tableGateway);
                    
                    return $table;
                },
                'UsersTableGateway' => function ($sm) {
                    
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    
                    $resultSetPrototype = new ResultSet();
                    
                    $resultSetPrototype->setArrayObjectPrototype(new Users());
                    
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                }
            )
        );
    }
}