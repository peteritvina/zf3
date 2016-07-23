<?php 
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsersController extends AbstractActionController
{
    protected $usersTable;
    // module/Users/src/Users/Controller/UsersController.php:
    
    public function getUsersTable() {
    
        if (!$this->usersTable) {
    
            $sm = $this->getServiceLocator();
    
            $this->usersTable = $sm->get('Users\Model\UsersTable');
        }
    
        return $this->usersTable;
    }
    
    public function indexAction(){
        echo __FILE__;
        echo "<br>".__METHOD__;
        //\Zend\Debug\Debug::dump($this->getUsersTable());
    }

   
}