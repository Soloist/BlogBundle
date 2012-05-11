<?php

namespace Soloist\Bundle\BlogBundle\EventListener;

use Soloist\Bundle\BlogBundle\Form\Type\BlockSettings\ShowLastsType,
    Soloist\Bundle\BlockBundle\EventListener\Event\RequestTypes;

class BlockListener
{
    /**
     * Listen to the RequestTypes event from block bundle
     *
     * @param \Solist\Bundle\BlockBundle\EventListener\Event\RequestTypes $event
     */
    public function onRequestTypes(RequestTypes $event)
    {
        $event->getManager()
            // Add last_news block
            ->addBlockType('last_news', array(
                'name'     => 'Liste des actus',
                'action'   => 'SoloistBlogBundle:Default:showLasts',
                'form'     => new ShowLastsType(),
                'settings' => array(
                    'nb' => 3
                )
            ))
        ;
    }
}
