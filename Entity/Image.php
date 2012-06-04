<?php

namespace Soloist\Bundle\BlogBundle\Entity;

/**
 * Image entity
 */
class Image
{
    /**
     * Uploads location
     */
    const UPLOAD_DIR = '/web_post_uploads/';

    /**
     * id
     * @var integer
     */
    protected $id;

    /**
     * filename
     * @var string
     */
    protected $filename;

    /**
     * post
     * @var Post
     */
    protected $post;

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get filename
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get post
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set Post
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }
}
