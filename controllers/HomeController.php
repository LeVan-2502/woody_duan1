<?php 

class HomeController
{
    public $modelHome;
    public function __construct()
    {
        $this->modelHome= new Home();
    }
   
    public function homeXem(){
        $top8Moi=$this->modelHome->top8SanPhamMoi();
        $top8Xem=$this->modelHome->top8SanPhamXemNhieu();
        $top8BanChay=$this->modelHome->top8SanPhamBanChay();
       
        require_once './views/nguoixem/home.php';
    }
   
    
    public function homeDung(){
        $top8Moi=$this->modelHome->top8SanPhamMoi();
        $top8Xem=$this->modelHome->top8SanPhamXemNhieu();
        $top8BanChay=$this->modelHome->top8SanPhamBanChay();
        require_once './views/nguoidung/home.php';
    }
   
   
    public function xacthuc(){
        $top8Moi=$this->modelHome->top8SanPhamMoi();
        $top8Xem=$this->modelHome->top8SanPhamXemNhieu();
        $top8BanChay=$this->modelHome->top8SanPhamBanChay();
        
        require_once './views/nguoidung/home.php';
    }
   
 
}