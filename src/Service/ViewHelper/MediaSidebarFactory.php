<?php
namespace XMLImport\Service\ViewHelper;

use XMLImport\View\Helper\MediaSidebar;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class MediaSidebarFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $config = $services->get('Config');
        $translator = $services->get('MvcTranslator');
        $ingesterManager = $services->get('Omeka\Media\Ingester\Manager');
        $mediaAdapters = $config['xml_import_media_ingester_adapter'];
        return new MediaSidebar($ingesterManager, $mediaAdapters, $translator);
    }
}
