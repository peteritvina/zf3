<?php
namespace Blog;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;
use Blog\Model\ZendDbSqlRepository;
use Blog\Factory\ZendDbSqlRepositoryFactory;
//echo InvokableFactory::class;

return [
    //Ban chat Controller cung duoc quan ly boi Zend-Service
    'controllers'=>[
        'factories'=>[//Khoi tao theo service manager,
                        //cach con lai la: 'invokables' => 
            //'Blog\Controller\List' => 'Blog\Controller\ListController',
            //InvokableFactory::class chi co the init cai class with no arguments contructors
            //Controller\ListController::class => InvokableFactory::class,
            Controller\ListController::class => Factory\ListControllerFactory::class,
            
        ],
    ],
    'router' => [
        'routes'=>[
            'blog'=>[
                'type'=> Literal::class,
                'options'=>[
                    'route'=>'/blog',
                    'defaults'=>[
                        'controller'=>Controller\ListController::class,
                        'action'    =>'index',
                    ],
                ],
            ],
        ],
    ],
    // Add this section:

    'service_manager' => [

        'aliases' => [
            //Model\PostRepositoryInterface::class => Model\PostRepository::class,
            //Change to ZendDbRepository. Alias thang Model\PostRepositoryInterface la thang Model\ZendDbSqlRepository::class
            Model\PostRepositoryInterface::class => Model\ZendDbSqlRepository::class,
            //Map thang Interface chinh la thang ZendDbSqlRepository::class
        ],

        'factories' => [
            //Model\PostRepositoryInterface::class => InvokableFactory::class,
            Model\PostRepository::class => InvokableFactory::class,
            //add this line,
            Model\ZendDbSqlRepository::class => \Blog\Factory\ZendDbSqlRepositoryFactory::class,
        ],
    ],

    
    'view_manager' => [                
        'template_path_stack' => [
            'blog' => __DIR__ . '/../view',
        ],
    ],
    
];