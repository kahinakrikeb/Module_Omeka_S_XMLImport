<?php
namespace XMLImport\Form;

use Zend\Form\Form;

class ImportForm extends Form
{
    protected $mappingClasses;

    public function init()
    {
        $this->setAttribute('action', 'XMLImport/map');
        $this->add([
                'name' => 'xml',
                'type' => 'file',
                'options' => [
                    'label' => 'XML file', // @translate
                    'info' => 'The xml file to upload', //@translate
                ],
                'attributes' => [
                    'id' => 'xml',
                    'required' => 'true',
                ],
        ]);

        $resourceTypes = array_keys($this->mappingClasses);
        $valueOptions = [];
        foreach ($resourceTypes as $resourceType) {
            $valueOptions[$resourceType] = ucfirst($resourceType);
        }
        $this->add([
                'name' => 'resource_type',
                'type' => 'select',
                'options' => [
                    'label' => 'Import type', // @translate
                    'info' => 'The type of data being imported', // @translate
                    'value_options' => $valueOptions,
                ],
        ]);

        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name' => 'xml',
            'required' => true,
        ]);
    }

    public function setMappingClasses(array $mappingClasses)
    {
        $this->mappingClasses = $mappingClasses;
    }
}
