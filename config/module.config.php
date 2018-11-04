<?php

return [
    'controllers' => [
        'factories' => [
            'XMLImport1\Controller\Index' => 'XMLImport1\Service\Controller\IndexControllerFactory',
        ],
    ],
    'api_adapters' => [
        'invokables' => [
            'XMLImport1_entities' => 'XMLImport1\Api\Adapter\EntityAdapter',
            'XMLImport1_imports' => 'XMLImport1\Api\Adapter\ImportAdapter',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => OMEKA_PATH . '/modules/XMLImport1/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH . '/modules/XMLImport1/view',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'xmlPropertySelector' => 'XMLImport1\View\Helper\PropertySelector',
        ],
        'factories' => [
            'mediaSidebar' => 'XMLImport1\Service\ViewHelper\MediaSidebarFactory',
            'itemSidebar' => 'XMLImport1\Service\ViewHelper\ItemSidebarFactory',
        ],
    ],
    'entity_manager' => [
        'mapping_classes_paths' => [
            OMEKA_PATH . '/modules/XMLImport1/src/Entity',
        ],
    ],
    'form_elements' => [
        'factories' => [
            'XMLImport1\Form\ImportForm' => 'XMLImport1\Service\Form\ImportFormFactory',
            'XMLImport1\Form\MappingForm' => 'XMLImport1\Service\Form\MappingFormFactory',
        ],
    ],
    'xml_import1_mappings' => [
        'items' => [
            '\XMLImport1\Mapping\PropertyMapping',
            '\XMLImport1\Mapping\MediaMapping',
            '\XMLImport1\Mapping\ItemMapping',
        ],
        'users' => [
            '\XMLImport1\Mapping\UserMapping',
        ],
    ],
    'xml_import1_media_ingester_adapter' => [
        'url' => 'XMLImport1\MediaIngesterAdapter\UrlMediaIngesterAdapter',
        'html' => 'XMLImport1\MediaIngesterAdapter\HtmlMediaIngesterAdapter',
        'iiif' => null,
        'oembed' => null,
        'youtube' => null,
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'XMLImport1' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/XMLImport1',
                            'defaults' => [
                                '__NAMESPACE__' => 'XMLImport1\Controller',
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
                                        '__NAMESPACE__' => 'XMLImport1\Controller',
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
                                        '__NAMESPACE__' => 'XMLImport1\Controller',
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
                'label' => 'XML Import1',
                'route' => 'admin/XMLImport1',
                'resource' => 'XMLImport1\Controller\Index',
                'pages' => [
                    [
                        'label'      => 'Import', // @translate
                        'route'      => 'admin/XMLImport1',
                        'resource'   => 'XMLImport1\Controller\Index',
                    ],
                    [
                        'label'      => 'Import', // @translate
                        'route'      => 'admin/XMLImport1/map',
                        'resource'   => 'XMLImport1\Controller\Index',
                        'visible'    => false,
                    ],
                    [
                        'label'      => 'Past Imports', // @translate
                        'route'      => 'admin/XMLImport1/past-imports',
                        'controller' => 'Index',
                        'action' => 'past-imports',
                        'resource' => 'XMLImport1\Controller\Index',
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
