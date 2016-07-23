<?php
namespace Album\Controller;

// Add the following import:
use Album\Model\AlbumTable;
use Album\Model\Album;//ngoai folder --> phai use thẳng đến class đó luon
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Form\AlbumForm;
use Zend\Paginator\Paginator;

class AlbumController extends AbstractActionController
{
    // Add this property:
    private $table;
    // Add this constructor:
    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }

    /* ... */
    public function indexAction(){
        //grap paginator from Albumtable
        $paginator = $this->table->fetchAll(true);
        //set the current page to what has been passed to query string
        //or to 1 if page is non isset, or undefine
        $page = (int)$this->params()->fromQuery('page',1);
        $page = ($page<1)?1:$page;
        $paginator->setCurrentPageNumber($page);
        //set number item of page
        $paginator->setItemCountPerPage(10);
        return new ViewModel([
            'paginator' => $paginator
        ]);
    }
    /* Update the following method to read as follows: */
    public function addAction()
    {
        
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            /*
            print"<pre>";
            var_dump($form);
            print"</pre>";
            */
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->table->saveAlbum($album);
        
        //$view = new \Zend\View\Helper\ViewModel();
        //$view->setTemplate("users/users/add.phtml");
        return $this->redirect()->toRoute('album');
        
    }
    //Edit album
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
    
        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }
    
        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            //Lay data ra
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }
    
        $form = new AlbumForm();
        //giong populate
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');
    
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
    
        if (! $request->isPost()) {
            return $viewData;
        }
    
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());
    
        if (! $form->isValid()) {
            return $viewData;
        }
    
        $this->table->saveAlbum($album);
    
        // Redirect to album list
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }
    //Delete album
    // Add content to the following method:
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }
        //getRequest data
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
    
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteAlbum($id);
            }
    
            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }
    
        return [
            'id'    => $id,
            'album' => $this->table->getAlbum($id),
        ];
    }
    
}