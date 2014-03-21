<?php

namespace Pim\Bundle\CatalogBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Pim\Bundle\FlexibleEntityBundle\Entity\Mapping\AbstractEntityFlexibleValue;
use Pim\Bundle\FlexibleEntityBundle\Entity\Mapping\AbstractEntityFlexible;

/**
 * Mark the indexed values for the object as outdated once a value has been loaded from the DB
 *
 * @author    Benoit Jacquemont <benoit@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class OutdateIndexedValuesListener implements EventSubscriber
{
    /**
     * Specifies the list of events to listen
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'postLoad'
        );
    }

    /**
     * After load
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof AbstractEntityFlexibleValue) {
            $flexibleObject = $object->getEntity();
            if ($flexibleObject instanceof AbstractEntityFlexible) {
                $flexibleObject->markIndexedValuesOutdated();
            }
        } elseif ($object instanceof AbstractEntityFlexible) {
            $object->markIndexedValuesOutdated();
        }
    }
}