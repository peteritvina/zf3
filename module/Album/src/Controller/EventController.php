<?php
namespace Album\Controller;

// Add the following import:
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Form\AlbumForm;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerAwareInterface;
class EventController extends AbstractActionController
{
    //index Action
    public function indexAction(){  
        //Khai bao Event
        $eventManager = new EventManager();
        
        $eventManager->attach('eventOne', function($e){
           echo "Di moi thiep";
        });
        //$eventManager->trigger('eventOne');
        $listener = function(EventInterface $e){
            echo get_class($e);
            print_r($e->getParams());
           echo "<hr>di dat nha hang cho dam cuoi - EventOne"; 
        };
        $l = $eventManager->attach('eventOne', $listener);
        $eventManager->detach($l);
        $params = array('123','456');
        $eventManager->trigger('eventOne',$this,$params);
        /*
        
        //khai bao listeners (c/v cho 1 event)
        $listener = function(EventInterface $e){
            //var_dump($e);
            print $e->getName();
            print_r($e->getParams());
            //print_r($e->getTarget());
            
            
            
            
        };
        //assign listenr cho event
        $eventManager->attach('eventOne', $listener);
        
        $eventManager->attach('eventOne', function(){
           echo "<br>Event One - doing here"; 
        });
        $eventManager->setIdentifiers(array('123','345'));
        print_r($eventManager->getIdentifiers());
        //trigger event
        $params = array("el van","nhieu");
        $eventManager->trigger('eventOne', $this ,$params);
        */
        return $this->getResponse();
    }
    public function index02Action(){
        $eventManager = new EventManager();
        //$eventManager->attach('eventOne', array('Album\Event\AlbumEvent','eventHandler01'));
        
        $listeners01 = $eventManager->attach('eventOne', 'Album\Event\AlbumEvent::eventhandler01');
        $listeners02 = $eventManager->attach('eventOne', function(){
            echo 'EventOne - task 01';
        });
        //var_dump($listeners01);
        echo"<hr>";
        //var_dump($listeners02);
        //$eventManager->detach($listeners01);
        echo "<hr>EventList";
        $eventList = $eventManager->getEvents();
        print_r($eventList);
        $params = array("Nhieu");
        //$eventManager->trigger('eventOne');
        $eventManager->trigger('eventOne',array('Album\Event\AlbumEvent','eventHandler01'),$params);
        return  $this->response;
    }
}