<?php

namespace Soloist\Bundle\BlogBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\BlogBundle\Form\Type\PostType,
    Soloist\Bundle\BlogBundle\Entity\Post,
    Soloist\Bundle\BlogBundle\Form\Handler\PostHandler as Handler;

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


    /**
     * Get the form handler
     *
     * @return \Soloist\Bundle\BlogBundle\Form\Handler\PostHandler
     */
    protected function getFormHandler()
    {
        return new Handler(
            $this->getDoctrine()->getEntityManager(),
            $this->get('form.factory'),
            $this->getAbsoluteUploadDir()
        );
    }

    private function getAbsoluteUploadDir()
    {
        return $this->container->getParameter('kernel.root_dir') . '/../web'
            . Post::UPLOAD_DIR;
    }
}
