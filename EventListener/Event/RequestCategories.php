<?php

namespace Soloist\Bundle\BlogBundle\EventListener\Event;

use Soloist\Bundle\BlogBundle\Form\Type\PostType;

use Symfony\Component\EventDispatcher\Event,
    Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

final class RequestCategories extends Event
{
    /**
     * @var ChoiceList
     */
    private $choices = array();

    /**
     * @return ChoiceList
     */
    public function addCategory($id, $name)
    {
        $this->choices[$id] = $name;
    }

    /**
     * Generate a ChoiceList object
     * @return ChoiceList
     */
    public function getChoiceList()
    {
        return new ChoiceList(
            array_keys($this->choices),
            array_values($this->choices),
            array()
        );
    }
}
