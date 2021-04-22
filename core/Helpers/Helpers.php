<?php 
namespace Synext\Helpers;

use Exception;

class Helpers{

    public static function checkFile($file_name,$file_size){
        $file_size_max = 3097152;
        $file_type = ['jpg', 'png', 'jpeg'];
        $file_ext = strtolower(substr(strchr($file_name, '.'), 1));
        if($file_size <= $file_size_max) {
            if (in_array($file_ext, $file_type)) {
                return $file_name;
            }
        }
        return false;
    }
    public static function uploadFile($file_name,$tempfile,$path){
        if($file_name){
            if(!file_exists($path)){
                try{
                    move_uploaded_file($tempfile, $path);
                    return true;
                }catch(Exception $e){
                    //
                    throw new Exception('ERROR UPLOADS');
                }
            }
        }

    }
    public static function resizeImage($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            $newheight = $h;
            $newwidth = $w;
        }
        if(explode('.',$file)[1] === 'png'){
            $src = imagecreatefrompng($file);
        }else{
            $src = imagecreatefromjpeg($file);
        }
        
        //imagecreatefrompng()
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }

    public static function uploadsFile($file_name,$file_size,$file_tmp,$destination,$img_name=null){

        $file_name = self::checkFile($file_name,$file_size);
        $path = $destination.$file_name;
        $upload = self::uploadFile($file_name,$file_tmp,$path);
        $name = explode('.',$file_name)[0];
        //ATTENSION VARIABLE SUPER GLOBAL
        if($img_name != null){
            $single_img_name = $img_name;
            $tmp_extension = explode('.',$file_name)[1];
            $new_path = $destination.$single_img_name.'.'.$tmp_extension;
            rename($path,$new_path);
            $file_name = $single_img_name.'.'.$tmp_extension;
            $name = $single_img_name;
            if($tmp_extension === 'png'){
                imagepng(self::resizeImage($new_path,500,300),$new_path);
                //imagedestroy($new_path);
            }else{
                imagejpeg(self::resizeImage($new_path,500,300),$new_path);
                //imagedestroy($new_path);
            }
        }else{
            $tmp_extension = explode('.',$file_name)[1];
            if($tmp_extension === 'png'){
                imagepng(self::resizeImage($path,626,313),$path);
                //imagedestroy($new_path);
            }else{
                imagejpeg(self::resizeImage($path,626,313),$path);
                //imagedestroy($new_path);
            }
        }
        return [$upload,$name,$file_name];
    }

    public static function getExtrait(string $content, int $limit = 12)
    {
        if (strlen($content) <= $limit) {
            return $content;
        }

        return substr($content, 0, $limit).'..';
    }
    public static function formatPrice( $price, string $currency): string
    {
        return $currency.number_format($price, 2, ',', ',');
    }
    public static function getInt(string $name, int $default = null): ?int
    {
        if (!isset($_GET[$name])) {
            return $default;
        }
        if ($_GET[$name] === '0') {
            return 0;
        }
        if (!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
           
           //DD( $_SERVER);
           #throw new \Exception('Error bad params');
           $uri = explode('=',$_SERVER['REQUEST_URI'])[0]."=1";
           $url = $_SERVER['HTTP_HOST'].$uri[0]."=1";
           //dd($url);
            Redirect::to($uri);
        }

        return (int) $_GET[$name];
    }
    public static function getPositiveInt(string $name, int $pages, int $default = null): ?int
    {
        $param = self::getInt($name, $default);
        if (($param !== null && $param > $pages) || $param < 1) {
            throw new \Exception("erreur ça n'existe pas cette page");
        }

        return $param;
    }
    public static function matricule($length=15){
        $keys = '0123456789';

        return substr(str_shuffle(str_repeat($keys, $length)), 0, $length);
    }

}

