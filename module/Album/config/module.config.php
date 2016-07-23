<?php 
namespace Album;

use Zend\Router\Http\Segment;

use Zend\ServiceManager\Factory\InvokableFactory;


return [
    
    'controllers' => [
        'invokables' => [
            //Controller\AlbumController::class => InvokableFactory::class,
            //Controller\EventController::class => InvokableFactory::class,
            'Album\Controller\Event'			=> 'Album\Controller\EventController',
            //'Album\Controller\Service'			=> 'Album\Controller\ServiceController',
        ],
    ],
    'service_manager'=>[
        /*
        'invokables'    => [
          //'Album\Service\Facebook\Facebook'        =>'Album\Service\Facebook\Facebook',

        ],*/
        'factories' => [
            //stdClass::class => InvokableFactory::class,
        ],
    ],
    

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'album' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'event' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/event[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\EventController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'service' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/album/service[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ServiceController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            /*
            'child_routes' => array (
                'event' => array (
                    'type' 		=> Segment::class,
                    'options' 	=> array (
                        'route' => '/album/[:controller[/:action]][/]',
                        'constraints' => array (
                            'controller' 	=> '[a-zA-Z][a-zA-Z0-9_-]*',
                            'action' 		=> '[a-zA-Z][a-zA-Z0-9_-]*'
                        ),                        
                    )
                )
            ),
            
            'event' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/event[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\EventController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            */
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];