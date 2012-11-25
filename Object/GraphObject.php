<?php

/**
 * Class used to represent Objects that can potentially go into Facebook's Open
 * Graph.
 */
abstract class GraphObject {
    
    /**
     * @return array Associative Array representation of this object
     */
    public function toArray() {
        return get_object_vars($this);
    }
    
    //There may need to be a constructor to set Image URL to default.
    
    /**
     * The ID of the object according to the DB
     * @var int
     */   
    private $id;
    
    /**
     * The Short title used to identify the graph object
     * @var String
     */
    private $title;
    
    /**
     * The URL pointing to an image for this object.
     * @var String
     */
    private $image;
    
    /**
     *
     * @var type 
     */
    private $description;

    public function __toString() {
        return "({$this->id}): {$this->title}";
    }

    public function getId() {
            return $this->id;
    }

    public function getTitle() {
            return $this->title;
    }

    public function getImage() {
            return $this->image;
    }

    public function getDescription() {
            return $this->description;
    }

    public function setId($id) {
            $this->id=$id;
    }

    public function setTitle($title) {
            $this->title=$title;
    }

    //TODO: Maybe good to make an abstract function for DefaultImage and grab
    //that default if $imageURL is null.
    public function setImage($image) {
            $this->image=$image;
    }

    public function setDescription($description) {
            $this->description=$description;
    }
}
?>