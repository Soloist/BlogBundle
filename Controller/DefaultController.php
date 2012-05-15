<?php

namespace Soloist\Bundle\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Soloist\Bundle\BlogBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        try {
            return array(
                'posts' => $this->getDoctrine()->getEntityManager()->getRepository('SoloistBlogBundle:Post')->findAll()
            );
        } catch(\Doctrine\ORM\NoResultException $e) {
            return array(
                'posts'  => array()
            );
        }
    }

    /**
     * @Template()
     */
    public function showAction(Post $post)
    {
        return array('post' => $post);
    }

    /**
     * @Template()
     */
    public function showLeadAction()
    {
        try {
            return array(
                'post' => $this->getDoctrine()->getEntityManager()->getRepository('SoloistBlogBundle:Post')->findLead()
            );
        } catch(\Doctrine\ORM\NoResultException $e) {
            return array();
        }
    }
}
