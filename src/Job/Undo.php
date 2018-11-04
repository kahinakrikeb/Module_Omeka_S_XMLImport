<?php
namespace XMLImport1\Job;

use Omeka\Job\AbstractJob;

class Undo extends AbstractJob
{
    public function perform()
    {
        $jobId = $this->getArg('jobId');
        $api = $this->getServiceLocator()->get('Omeka\ApiManager');
        $response = $api->search('xmlimport1_entities', ['job_id' => $jobId]);
        $csvEntities = $response->getContent();
        if ($csvEntities) {
            foreach ($csvEntities as $csvEntity) {
                $csvResponse = $api->delete('xmlimport1_entities', $csvEntity->id());
                $entityResponse = $api->delete($csvEntity->resourceType(), $csvEntity->entityId());
            }
        }
    }
}
