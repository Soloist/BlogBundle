<?php

namespace Soloist\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

use Soloist\Bundle\BlogBundle\EventListener\Event\RequestCategories,
    Soloist\Bundle\BlogBundle\EventListener\BlogEvents;

use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Post type
 */
class PostType extends AbstractType
{

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected $eventDispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->eventDispatcher  = $dispatcher;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = $this->retrieveCategories();
        $builder
            ->add('title')
            ->add('publishedAt', 'fw_jquery_date')
            ->add('isLead', null, array('required' => false))
            ->add('lead', 'html_purified_textarea')
            ->add('body', 'html_purified_textarea')
            ->add('category', 'choice', array(
                'choice_list' => $categories,
            ));
        ;
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Soloist\\Bundle\\BlogBundle\\Entity\\Post',
        );
    }

    public function getName()
    {
        return 'soloist_post';
    }

    protected function retrieveCategories()
    {
        $requestEvent = new RequestCategories();
        $this->eventDispatcher->dispatch(BlogEvents::onRequestCategories, $requestEvent);

        return $requestEvent->getChoiceList();
    }
}
