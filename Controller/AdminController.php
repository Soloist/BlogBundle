<?php

namespace Soloist\Bundle\BlogBundle\Controller;

use FrequenceWeb\Bundle\DashboardBundle\Controller\ORMCrudController;

use Soloist\Bundle\BlogBundle\Form\Type\PostType,
    Soloist\Bundle\BlogBundle\Entity\Post,
    Soloist\Bundle\BlogBundle\Form\Handler\ImageHandler,
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
                'post' => $post,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Add an image to a specified post
     *
     * @param Tfhc\Bundle\SiteBundle\Entity\Post $post
     *
     * @return Response
     */
    public function createImageAction(Post $post)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $uploadDir = $this->getAbsoluteUploadDir();
        $handler = new ImageHandler($em, $this->get('form.factory'), $uploadDir);
        $form = $handler->getForm();

        if ($handler->create($form, $this->get('request'), $post)) {

            return $this->redirect($this->generateUrl('soloist_blog_admin_image_index',
                array('id' => $post->getId())
            ));
        }

        $this->addImageBreadcrumb($post);

        return $this->render('SoloistBlogBundle:Admin:index_image.html.twig',
            array(
                'post' => $post,
                'form' => $form->createView()
            )
        );

    }


    /**
     * Delete an image from a post
     *
     * @param Post $post
     *
     * @return Response
     */
    public function deleteImageAction(Image $image)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $filename = $image->getFilename();
        $post = $image->getPost();
        $em->remove($image);

        if (!empty($filename)) {
            $path = $this->getAbsoluteUploadDir() . $filename;

            if (is_file($path)) {
                unlink($path);
            }
        }

        $em->flush();

        return $this->redirect($this->generateUrl('soloist_blog_admin_image_index',
            array('id' => $post->getId())
        ));
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
