<?php

namespace Soloist\Bundle\BlogBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\BlogBundle\Form\Type\PostType,
    Soloist\Bundle\BlogBundle\Entity\Post;

class AdminController extends ORMCrudController
{
    /**
     * @return array
     */
    protected function getParams()
    {
        return array(
            'display'      => array(
                'id'          => array('label' => 'N°'),
                'publishedAt' => array('label' => 'Date de publication', 'type' => 'date'),
                'isLead'      => array('label' => 'A la Une ?', 'type' => 'boolean'),
                'title'       => array('label' => 'Titre')
            ),
            'prefix'       => 'soloist_admin_blog',
            'singular'     => 'article',
            'plural'       => 'articles',
            'formTemplate' => 'SoloistBlogBundle:Admin:form.html.twig',
            'order'        => array('publishedAt' => 'DESC'),
            'form_type'      => new PostType,
            'class'          => new Post,
            'repository'     => 'SoloistBlogBundle:Post',
        );
    }
}
