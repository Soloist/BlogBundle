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
            ->add('lead', 'textarea')
            ->add('body', 'textarea')
            ->add('image', 'file')
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
