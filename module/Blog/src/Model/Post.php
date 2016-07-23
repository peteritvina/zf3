<?php 
namespace Blog\Model;
class Post{
    private $id;
    private $text;
    private $title;
    public function __construct($text,$title,$id=null){
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;        
    }
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param field_type $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    
}
?>