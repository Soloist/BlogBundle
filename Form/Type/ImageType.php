<?php

namespace Soloist\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

/**
 * Image type
 */
class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename', 'file')
        ;
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Soloist\\Bundle\\BlogBundle\\Entity\\Image',
        );
    }

    public function getName()
    {
        return 'soloist_blog_image';
    }
}
