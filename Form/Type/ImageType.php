<?php

namespace Soloist\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Image type
 */
class ImageType extends AbstractType
{
    /**
     * @{inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('filename', 'file')
        ;
    }

    /**
     * @{inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Soloist\Bundle\BlogBundle\Entity\Image',
            )
        );
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'soloist_blog_image';
    }
}
