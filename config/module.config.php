<?php

return [
    'controllers' => [
        'factories' => [
            'XMLImport\Controller\Index' => 'XMLImport\Service\Controller\IndexControllerFactory',
        ],
    ],
    'api_adapters' => [
        'invokables' => [
            'XMLImport_entities' => 'XMLImport\Api\Adapter\EntityAdapter',
            'XMLImport_imports' => 'XMLImport\Api\Adapter\ImportAdapter',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => OMEKA_PATH . '/modules/XMLImport/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH . '/modules/XMLImport/view',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'xmlPropertySelector' => 'XMLImport\View\Helper\PropertySelector',
        ],
        'factories' => [
            'mediaSidebar' => 'XMLImport\Service\ViewHelper\MediaSidebarFactory',
            'itemSidebar' => 'XMLImport\Service\ViewHelper\ItemSidebarFactory',
        ],
    ],
    'entity_manager' => [
        'mapping_classes_paths' => [
            OMEKA_PATH . '/modules/XMLImport/src/Entity',
        ],
    ],
    'form_elements' => [
        'factories' => [
            'XMLImport\Form\ImportForm' => 'XMLImport\Service\Form\ImportFormFactory',
            'XMLImport\Form\MappingForm' => 'XMLImport\Service\Form\MappingFormFactory',
        ],
    ],
    'xml_import_mappings' => [
        'items' => [
            '\XMLImport\Mapping\PropertyMapping',
            '\XMLImport\Mapping\MediaMapping',
            '\XMLImport\Mapping\ItemMapping',
        ],
        'users' => [
            '\XMLImport\Mapping\UserMapping',
        ],
    ],
    'xml_import_media_ingester_adapter' => [
        'url' => 'XMLImport\MediaIngesterAdapter\UrlMediaIngesterAdapter',
        'html' => 'XMLImport\MediaIngesterAdapter\HtmlMediaIngesterAdapter',
        'iiif' => null,
        'oembed' => null,
        'youtube' => null,
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'XMLImport' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/XMLImport',
                            'defaults' => [
                                '__NAMESPACE__' => 'XMLImport\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'past-imports' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/past-imports',
                                    'defaults' => [
                                        '__NAMESPACE__' => 'XMLImport\Controller',
                                        'controller' => 'Index',
                                        'action' => 'past-imports',
                                    ],
                                ],
                            ],
                            'map' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/map',
                                    'defaults' => [
                                        '__NAMESPACE__' => 'XMLImport\Controller',
                                        'controller' => 'Index',
                                        'action' => 'map',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'AdminModule' => [
            
            [
                'label' => 'XML Import',
                'route' => 'admin/XMLImport',
                'resource' => 'XMLImport\Controller\Index',
                'pages' => [
                    [
                        'label'      => 'Import', // @translate
                        'route'      => 'admin/XMLImport',
                        'resource'   => 'XMLImport\Controller\Index',
                    ],
                    [
                        'label'      => 'Import', // @translate
                        'route'      => 'admin/XMLImport/map',
                        'resource'   => 'XMLImport\Controller\Index',
                        'visible'    => false,
                    ],
                    [
                        'label'      => 'Past Imports', // @translate
                        'route'      => 'admin/XMLImport/past-imports',
                        'controller' => 'Index',
                        'action' => 'past-imports',
                        'resource' => 'XMLImport\Controller\Index',
                    ],
                ],
            ],
        ],
    ],
    'js_translate_strings' => [
        'Remove mapping', // @translate
        'Undo remove mapping', // @translate
        'Select an item type at the left before choosing a resource class.', // @translate
        'Select an element at the left before choosing a property.', // @translate
        'Please enter a valid language tag.', // @translate
    ],
];
