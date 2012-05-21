<?php

namespace Soloist\Bundle\BlogBundle\EventListener;

use FrequenceWeb\Bundle\DashboardBundle\Menu\Event\Configure;


class DashboardListener
{
    public function onConfigureNewMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild('Article de blog', array(
            'route'           => 'soloist_admin_blog_new'
        ));
    }

    public function onConfigureTopMenu(Configure $event)
    {
        $root = $event->getRoot();
        $root->addChild('Blog', array('route' => 'soloist_admin_blog_index'));
    }
}
