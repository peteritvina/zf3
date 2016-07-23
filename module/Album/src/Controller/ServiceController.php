<?php 
namespace Album\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Album\Model\Album;
use Album\Service\Facebook\Facebook;//use la phai use luon file class moi dung
use Album\Service\AlbumService;
use Zend\ServiceManager\ServiceManager;
use Album\Service\GreetingService;
use Album\Service\Example;
use Album\Service\Example2;
use Zend\Debug\Debug;
//use Album;
class ServiceController extends AbstractActionController{
    protected $example;
    public function __construct(Example2 $example){
        //$this->sm = $this->getEvent()->getApplication()->getServiceManager();
        $this->example = $example;
    }
    
    //Chi goi service su dung binh thuong
    public function indexAction(){
        $serviceFacebook = new Facebook('nhieulevan','fb.com/nhieulevan');
        $serviceFacebook->getFacebookInfo();
        print"<pre>";
        var_dump($serviceFacebook);
        print"</pre>";
        return $this->getResponse();    
    }
    //Chi goi service su dung binh thuong, khac nhau cai o day la: Albumservice phai new Facebook service len
    public function index01Action(){
        //get ServiceManager;
        $sm = $this->getEvent()->getApplication()->getServiceManager();
        $example2 = $sm->get(\Example::class);
        $example2->hello();
        return $this->getResponse();
    }
    public function index02Action(){
        //echo get_class($this->sm);
        
        //echo get_class($this->sm);
        $example = $this->sm->get(Example::class);
        $example->hello();
        return $this->getResponse();
    }
    public function index03Action(){
        //$sm = $this->getEvent()->getApplication()->getServiceManager();
        //$albumTable = $sm->get(\Zend\Db\Adapter\AdapterInterface::class);
        //var_dump($albumTable);
        //$example->hello();
        $this->example->sayHello();
        return $this->response;
    }
}
?>