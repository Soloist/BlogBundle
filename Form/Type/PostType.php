<?php

namespace Soloist\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('publishedAt', 'fw_jquery_date')
            ->add('isLead', null, array('required' => false))
            ->add('lead', 'html_purified_textarea')
            ->add('body', 'html_purified_textarea')
            ->add('image', 'file', array('required' => false))
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
}
