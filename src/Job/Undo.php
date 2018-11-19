<?php
namespace XMLImport\Job;

use Omeka\Job\AbstractJob;

class Undo extends AbstractJob
{
    public function perform()
    {
        $jobId = $this->getArg('jobId');
        $api = $this->getServiceLocator()->get('Omeka\ApiManager');
        $response = $api->search('XMLImport_entities', ['job_id' => $jobId]);
        $xmlEntities = $response->getContent();
        if ($xmlEntities) {
            foreach ($xmlEntities as $xmlEntity) {
                $xmlResponse = $api->delete('XMLImport_entities', $xmlEntity->id());
                $entityResponse = $api->delete($xmlEntity->resourceType(), $xmlEntity->entityId());
            }
        }
    }
}
