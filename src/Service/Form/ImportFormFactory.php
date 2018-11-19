<?php
namespace XMLImport\Service\Form;

use XMLImport\Form\ImportForm;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ImportFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $form = new ImportForm(null, $options);
        $config = $services->get('Config');
        $form->setMappingClasses($config['xml_import_mappings']);
        return $form;
    }
}
