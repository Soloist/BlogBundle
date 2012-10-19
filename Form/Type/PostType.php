<?php

namespace Soloist\Bundle\BlogBundle\Form\Type;

use Soloist\Bundle\BlogBundle\EventListener\BlogEvents;
use Soloist\Bundle\BlogBundle\EventListener\Event\RequestCategories;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Post type
 */
class PostType extends AbstractType
{

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EventDispatcher $dispatcher)
    {
        $this->eventDispatcher  = $dispatcher;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', 'choice', array('required' => false, 'choice_list' => $this->retrieveCategories()))
            ->add('publishedAt', 'fw_jquery_date')
            ->add('isLead', null, array('required' => false))
            ->add('lead', 'html_purified_textarea', array('required' => false))
            ->add('body', 'html_purified_textarea', array('required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Soloist\Bundle\BlogBundle\Entity\Post'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'soloist_post';
    }

    /**
     * @return \Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList
     */
    protected function retrieveCategories()
    {
        $requestEvent = new RequestCategories();
        $this->eventDispatcher->dispatch(BlogEvents::onRequestCategories, $requestEvent);

        return $requestEvent->getChoiceList();
    }
}
