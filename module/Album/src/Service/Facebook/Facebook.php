<?php 
/*
 * Day la class dung de xu ly 1 vd gi do 
 */
 namespace Album\Service\Facebook;
 class Facebook {
     protected $user;
     protected $url;
    /*
     public function __construct($user=NULL,$url=NULL){         
         $this->user = $user;
         $this->url = $url;
     }*/
     public function getFacebookInfo(){
         echo "this is getFacebookInfo<br>";
         echo "<br>".$this->url;
         echo "<br>".$this->user;
     }
 }
?>