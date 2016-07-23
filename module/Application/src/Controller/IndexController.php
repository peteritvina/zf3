<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManager;
use \Zend\Debug;
use Zend\EventManager\EventInterface;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        echo __FILE__;
        echo "<br>".__METHOD__;
        return new ViewModel();
    }
    //thu source events
    public function index01Action(){
        $eventManager = new EventManager();
        
        $listener = function(EventInterface $e){
            echo '<h3 style="color:red;font-weight:bold">eventOne</h3>';
			echo '<br />Event Name:' . $name	= $e->getName();
			echo '<br />Params:';
			print_r($e->getParams());
			echo '<br />Params course:'. $course	= $e->getParam('course_abc', 'def');
			print "<br>target<br>";
			print_r($e->getTarget());
			
			
			$e->setParam('course', 'zend framework 2');
			echo '<pre style="color:red;font-weight:bold">';
			print_r($e->getParams());
			echo '</pre>';
        };
        $eventManager->attach('eventOne', $listener);
        //$eventManager->trigger('eventOne');
        $params	= array('course' => 'zf2', 'time' => '90h');
		//$eventManager->trigger('eventOne',this, $params);
        return $this->getResponse();
    }
}
