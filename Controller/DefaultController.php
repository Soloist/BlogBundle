<?php

namespace Soloist\Bundle\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
