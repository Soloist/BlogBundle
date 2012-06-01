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

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public function getFilename(){
        return $this->filename;
    }

    public function setFilename($filename){
        $this->filename = $filename;

        return $this;
    }
}
