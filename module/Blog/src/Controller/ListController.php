<?php 
namespace Blog\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Blog\Model\PostRepositoryInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class ListController extends AbstractActionController{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository){
        $this->postRepository = $postRepository;
    }

    public function indexAction(){

        return new ViewModel([
            'posts' => $this->postRepository->findAllPosts(),
        ]);
    }
    public function index01Action(){
        return new ViewModel();
    }
}
?>