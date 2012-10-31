<?php

namespace Soloist\Bundle\BlogBundle\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Soloist\Bundle\BlogBundle\Entity\Post;
use Soloist\Bundle\BlogBundle\Entity\Image;

/**
 *
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class CacheSubscriber implements EventSubscriber
{
    protected $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();
        $entities = array_merge(
            $uow->getScheduledEntityDeletions(),
            $uow->getScheduledEntityInsertions(),
            $uow->getScheduledEntityUpdates()
        );

        foreach ($entities as $entity) {
            if ($entity instanceof Post || $entity instanceof Image) {
                $this->eventDispatcher->dispatch('soloist.core.request_cache_clear');

                return;
            }
        }
    }

    /**
     * @{inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array('onFlush');
    }
}
