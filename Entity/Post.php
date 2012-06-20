<?php

namespace Soloist\Bundle\BlogBundle\Entity;

use FrequenceWeb\Bundle\DashboardBundle\Crud\CrudableInterface;

/**
 * Post entity
 */
class Post implements CrudableInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $lead;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var boolean
     */
    protected $isLead;

    /**
     * @var \DateTime
     */
    protected $publishedAt;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var  array
     */
    protected $images;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $lead
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * @return string
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param \DateTime $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getRouteParams()
    {
        return array(
            'id' => $this->id
        );
    }

    /**
     * @param boolean $isLead
     */
    public function setIsLead($isLead)
    {
        $this->isLead = $isLead;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsLead()
    {
        return $this->isLead;
    }

    /**
     * Get the images collection
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add an image to the post
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Get the first image
     *
     * @return Image
     */
    public function getFirstImage()
    {
        if(count($this->images) > 0) {
            return $this->images[0];
        }

        return null;
    }

    /**
     * Translatable setter for doctrine extensions
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
