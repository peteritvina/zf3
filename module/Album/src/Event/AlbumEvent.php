<?php
/* 
 * 
 */
namespace Album\Event;

use Zend\EventManager\EventInterface;

class AlbumEvent{
    //Tham so truyen vao la EventInterfaces, 
    //Trigger lay tham so: $eventManager->trigger('eventOne',array('Album\Event\AlbumEvent','eventHandler01'),$params);
    public static function eventHandler01(EventInterface $e){
        print "<pre>";
        var_dump($e);
        $e->getParams();
        print "</pre>";
        echo "this is in eventHandler01 function";
        echo __FILE__;
        echo "<br>";
        echo __FUNCTION__;
        echo "<br>";
        echo __CLASS__;
        
    }
}
?>