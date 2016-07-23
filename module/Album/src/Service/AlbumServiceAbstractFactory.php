<?php

namespace Album\Service;

use Zend\ServiceManager\AbstractFactoryInterface;

class AlbumServiceAbstractFactory implements AbstractFactoryInterface {
	
	public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName){
		if(class_exists('Album\Service\\'.$requestedName.'Service')){
			return true;
		}
		return false;
	}
	
	public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName){
		$className	= '\Album\Service\\'.$requestedName.'Service';
		if(class_exists($className)){
			return new $className();
		}
		
		
	}
}