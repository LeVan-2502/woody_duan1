<?php
class Home
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSanPham(){
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            $this->debug($e);
        }
    }
    public function top8SanPhamBanChay(){
        try {
            $sql = 'SELECT 
                        sp.id as san_pham_id,
                        sp.ten_san_pham,
                        sp.gia_san_pham,
                        sp.gia_khuyen_mai,
                        sp.mo_ta,
                        sp.hinh_anh,
                        sp.trang_thai,
                        dm.ten_danh_muc,
                        SUM(ctdh.so_luong) AS tong_so_luong_ban
                    FROM 
                        chi_tiet_don_hangs ctdh
                    INNER JOIN 
                        san_phams sp ON ctdh.san_pham_id = sp.id
                    INNER JOIN 
                        danh_mucs dm ON sp.danh_muc_id= dm.id
                    GROUP BY 
                        sp.id, 
                        sp.ten_san_pham, 
                        sp.gia_san_pham, 
                        sp.gia_khuyen_mai, 
                        sp.mo_ta, 
                        sp.hinh_anh, 
                        sp.trang_thai, 
                        dm.ten_danh_muc
                    ORDER BY 
                        tong_so_luong_ban DESC
                    LIMIT 8;
            
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            $this->debug($e);
        }
    }
    public function top8SanPhamMoi(){
        try {
            $sql = 'SELECT 
                        sp.id as san_pham_id ,sp.*
                    FROM 
                        san_phams sp
                    ORDER BY 
                        ngay_nhap DESC
                    LIMIT 8;
            
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            $this->debug($e);
        }
    }
    public function top8SanPhamXemNhieu(){
        try {
            $sql = 'SELECT sp.id as san_pham_id, sp.*, dm.ten_danh_muc
                    FROM 
                        san_phams sp  

                    INNER JOIN danh_mucs dm ON sp.danh_muc_id=dm.id     
                    WHERE 
                        trang_thai = 1
                    ORDER BY 
                        luot_xem DESC
                    LIMIT 8;
            
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            $this->debug($e);
        }
    }
    private function debug($e)
    {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        die();
    }
    
}
