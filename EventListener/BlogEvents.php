<?php

namespace Soloist\Bundle\BlogBundle\EventListener;

final class BlogEvents
{
    /**
     * Event who register categories for post type
     *
     * @var string
     */
    const onRequestCategories = 'soloist_blog.request_categories';
}
