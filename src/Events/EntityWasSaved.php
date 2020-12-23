<?php

namespace Dnsoft\Eav\Events;

use Exception;
use Illuminate\Database\Eloquent\Model as Entity;
use Rinvex\Attributes\Support\ValueCollection;

class EntityWasSaved extends \Rinvex\Attributes\Events\EntityWasSaved
{
    public function handle(Entity $entity): void
    {
        $this->trash = $entity->getEntityAttributeValueTrash();

        // Wrap the whole process inside database transaction
        $connection = $entity->getConnection();
        $connection->beginTransaction();

        try {
            foreach ($entity->getEntityAttributes() as $attribute) {
                if ($entity->relationLoaded($relation = $attribute->getAttribute('slug'))) {
                    $relationValue = $entity->getRelationValue($relation);

                    if ($relationValue instanceof ValueCollection) {
                        foreach ($relationValue as $value) {
                            // Set attribute value's entity_id since it's always null,
                            // because when RelationBuilder::build is called very early
                            $value->setAttribute('entity_id', $entity->getKey());
                            $this->saveOrTrashValue($value);
                        }
                    } elseif (! is_null($relationValue)) {
                        // Set attribute value's entity_id since it's always null,
                        // because when RelationBuilder::build is called very early
                        $relationValue->setAttribute('entity_id', $entity->getKey());
                        $this->saveOrTrashValue($relationValue);
                    }
                }
            }

            if ($this->trash->count()) {
                foreach ($this->trash as $trash) {
                    $trash->delete();
                }

                // Now, empty the trash
                $this->trash = collect([]);
            }
        } catch (Exception $e) {
            // Rollback transaction on failure
            $connection->rollBack();

            throw $e;
        }

        // Commit transaction on success
        $connection->commit();
    }
}
