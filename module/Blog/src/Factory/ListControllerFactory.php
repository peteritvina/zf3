<?php 
namespace Blog\Factory;
use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Blog\Controller\ListController;
use Blog\Model\PostRepository;
use Blog\Model\PostRepositoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
class ListControllerFactory implements FactoryInterface{
 /*
  * $param: ContainerInterface $container;
  * $param: String $requestedName;
  * $param: null|array $options
  * $return: ListController
  */   
    public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL){

        return new ListController($container->get(\Blog\Model\PostRepositoryInterface::class));
    }
    public function createService(ServiceLocatorInterface $serviceLocator){
        
    }
}
?>