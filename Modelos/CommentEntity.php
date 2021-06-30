<?php

require_once ('BaseEntity.php');

class CommentEntity extends BaseEntity
{
    private $comment_id;
    private $user;
    private $product_id;
    private $description;
    private $stars;
    private $is_visible;
    private $created_at;

    public function __construct()
    {
        parent::__construct(); 
    }
    /**
     * Defino los Getters
     * 
     */
     
    public function getCommentID()
    {
        return $this->comment_id;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getProductID()
    {
        return $this->product_id;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getStars()
    {
        return $this->stars;
    }
    public function getVisibility()
    {
        return $this->is_visible;
    }  
    public function getCreationDate()
    {
        return $this->created_at;
    }  
    /**
     * Defino los Setters
     * 
     */
    
    public function setCommentID($comment_id)
    {
        $this->comment_id = $comment_id;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setProductID($product_id)
    {
        $this->product_id = $product_id;
    }
    public function setDescription($description)
    {
        $this->description = ($description);
    }
    public function setStars($stars)
    {
        $this->stars = $stars;
    }
    public function setVisibility($is_visible)
    {
        $this->is_visible = $is_visible;
    }  
    public function setCreationDate($created_at)
    {
        $this->created_at = $created_at;
    }  
}
