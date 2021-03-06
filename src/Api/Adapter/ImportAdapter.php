<?php
namespace XMLImport\Api\Adapter;

use Doctrine\ORM\QueryBuilder;
use Omeka\Api\Adapter\AbstractEntityAdapter;
use Omeka\Api\Request;
use Omeka\Entity\EntityInterface;
use Omeka\Stdlib\ErrorStore;

class ImportAdapter extends AbstractEntityAdapter
{
    public function getEntityClass()
    {
        return 'XMLImport\Entity\XMLImportImport';
    }

    public function getResourceName()
    {
        return 'XMLImport_imports';
    }

    public function getRepresentationClass()
    {
        return 'XMLImport\Api\Representation\ImportRepresentation';
    }

    public function hydrate(Request $request, EntityInterface $entity,
        ErrorStore $errorStore
    ) {
        $data = $request->getContent();
        if (isset($data['o:job']['o:id'])) {
            $job = $this->getAdapter('jobs')->findEntity($data['o:job']['o:id']);
            $entity->setJob($job);
        }
        if (isset($data['o:undo_job']['o:id'])) {
            $job = $this->getAdapter('jobs')->findEntity($data['o:undo_job']['o:id']);
            $entity->setUndoJob($job);
        }

        if (isset($data['added_count'])) {
            $entity->setAddedCount($data['added_count']);
        }

        if (isset($data['comment'])) {
            $entity->setComment($data['comment']);
        }

        if (isset($data['resource_type'])) {
            $entity->setResourceType($data['resource_type']);
        }

        if (isset($data['has_err'])) {
            $entity->setHasErr($data['has_err']);
        }
    }

    public function buildQuery(QueryBuilder $qb, array $query)
    {
        if (isset($query['job_id'])) {
            $qb->andWhere($qb->expr()->eq(
                $this->getEntityClass() . '.job',
                $this->createNamedParameter($qb, $query['job_id']))
            );
        }

        if (isset($query['resource_type'])) {
            $qb->andWhere($qb->expr()->eq(
                $this->getEntityClass() . '.resource_type',
                $this->createNamedParameter($qb, $query['resource_type']))
            );
        }
    }
}
