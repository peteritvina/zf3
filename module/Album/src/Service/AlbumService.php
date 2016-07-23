<?php 
namespace Album\Service;



class AlbumService{
    //Khoi tao 1 services co Interfaces la Facebook Service
    protected $fb;//bien fb service
    /*
    public function __construct( Facebook $fb){
        $this->fb = $fb;
    }*/
    public function getAlbumFromFacebook(){
        echo "<hr>in ra this->fb xem the nao?";
        //var_dump($this->fb);
        echo "this is functions in Services";
        echo __FUNCTION__."<br>";
        echo __FILE__."<br>";
    }
}
?>