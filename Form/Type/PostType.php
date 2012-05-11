<?php

namespace Soloist\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('publishedAt', 'fw_jquery_date')
            ->add('lead', 'textarea')
            ->add('body', 'textarea')
        ;
    }

    public function getDefaultOptions(array $options)
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
