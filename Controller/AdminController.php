<?php

namespace Soloist\Bundle\BlogBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\BlogBundle\Form\Type\PostType,
    Soloist\Bundle\BlogBundle\Entity\Post,
    Soloist\Bundle\BlogBundle\Form\Handler\PostHandler as Handler,
    Soloist\Bundle\BlogBundle\Form\Type\ImageType,
    Soloist\Bundle\BlogBundle\Entity\Image;

class AdminController extends ORMCrudController
{
    /**
     * @return array
     */
    protected function getParams()
    {
        $translator = $this->get('translator');
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
            'object_actions' => array(
                'manage_image' => array(
                    'label' => $translator->trans('soloist.blog.admin.image_management'),
                    'route' => 'soloist_blog_admin_image_index',
                )
            ),
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

    /**
     * Get the absolute path to upload dir
     * @return string
     */
    private function getAbsoluteUploadDir()
    {
        return $this->container->getParameter('kernel.root_dir') . '/../web'
            . Image::UPLOAD_DIR;
    }


    /**
     * Show the images of the current post
     *
     * @param \Soloist\Bundle\BlogBundle\Entity\Post
     *
     * @return Response
     */
    public function indexImageAction(Post $post)
    {
        $form = $this->createForm(new ImageType());

        $this->addImageBreadcrumb($post);

        return $this->render('SoloistBlogBundle:Admin:index_image.html.twig',
            array(
                'product' => $product,
                'form' => $form->createView()
            )
        );
    }


    /**
     * Return the complete breadcrumb
     *
     * @param Post $post
     */
    private function addImageBreadcrumb(Post $post)
    {
        $translator = $this->get('translator');
        $this->addBaseBreadcrumb()
            ->add(
                $translator->trans('soloist.blog.post') . ' "'. $post->getTitle() .'"',
                array(
                    'route' => 'soloist_admin_blog_edit',
                    'route_params' => array('id' => $post->getId())
                )
            )
            ->add($translator->trans('soloist.blog.admin.image_management'));
    }
}
