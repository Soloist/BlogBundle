<?php

namespace Soloist\Bundle\BlogBundle\Form\Handler;

use Soloist\Bundle\BlogBundle\Entity\Image,
    Soloist\Bundle\BlogBundle\Form\Type\ImageType,
    Soloist\Bundle\BlogBundle\Entity\Post;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Form\FormFactory,
    Symfony\Component\Form\Form,
    Symfony\Component\HttpFoundation\Request;

/**
 * Handle an image submisison
 */
class ImageHandler
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $formFactory;

    /**
     * Path to the upload dir
     * @var string
     */
    protected $absolutePath;

    /**
     * Construct the handler
     * @param EntityManager $em
     * @param FormFactory   $formFactory
     * @param string        $absolutePath
     */
    public function __construct(EntityManager $em, FormFactory $formFactory, $absolutePath)
    {
        $this->em           = $em;
        $this->formFactory  = $formFactory;
        $this->absolutePath = $absolutePath;
    }

    /**
     * Get the image form
     * @return Form
     */
    public function getForm()
    {
        return $this->formFactory->create(new ImageType, new Image);
    }

    /**
     * Create an image
     * @param Form    $form
     * @param Request $request
     * @return boolean
     */
    public function create(Form $form, Request $request, Post $post)
    {
        $form->bindRequest($request);
        $image = $form->getData();

        if ($form->isValid()) {
            // Getting the file
            $file = $image->getFilename();

            // Generating a name
            $name = uniqid()
                . $this->sanitize($file->getClientOriginalName())
                . '.' .$file->guessExtension();

            // Moving the image to the correct directory
            $file->move($this->absolutePath, $name);

            $image->setFilename($name);
            $image->setPost($post);

            $this->em->persist($image);
            $this->em->flush();

            return true;
        }

        return false;
    }

    /**
     * Return a sanitized filename
     *
     * @param string $name
     *
     * @return string
     */
    private function sanitize($name)
    {
        return strtolower(preg_replace('([^_a-zA-Z0-9])', '_', $name));
    }

}

