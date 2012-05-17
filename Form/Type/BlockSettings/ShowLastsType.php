<?php

namespace Soloist\Bundle\BlogBundle\Form\Type\BlockSettings;

use Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\AbstractType;

class ShowLastsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nb', 'integer')
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'soloist_blog_show_lasts_block_settings';
    }
}
