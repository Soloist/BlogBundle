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
        return array(
            'posts' => $this->getDoctrine()->getEntityManager()->getRepository('SoloistBlogBundle:Post')->findAll()
        );
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
        return array(
            'post' => $this->getDoctrine()->getEntityManager()->getRepository('SoloistBlogBundle:Post')->findLead()
        );
    }
}
