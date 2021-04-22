<?php

use Synext\Helpers\Helpers;
use Synext\Helpers\Json;
use Synext\Helpers\Session;
use Synext\Requests\Http;
if(Http::methods('POST')){
  Session::checkSession();
  function img_to_db($upload,$name,$file_name){
    if($upload){
      $_SESSION['image'] =  $file_name;
      echo Json::message(false,null,['path'=>'/storages/imgs/'.$file_name]);
      exit;
    }else{
        echo Json::message(true,'file already exist');
        exit;
    }
  }
  if(isset($_POST['img_name'])){
    $img_name = $_POST['img_name'];
    if(!empty($img_name)){
      $img_name = substr_replace(str_replace(" ","-",$img_name),"",-1);
      if(is_array($_FILES['image']['name'])){
        foreach($_FILES['image']['name'] as $key => $value){
        [$upload,$name,$file_name] = Helpers::uploadsFile($_FILES['image']['name'][$key],$_FILES['image']['size'][$key],$_FILES['image']['tmp_name'][$key],dirname(__DIR__,3).'/public_html/storages/imgs/',$img_name);
        img_to_db($upload,$name,$file_name);
        }
      }else{
        [$upload,$name,$file_name] = Helpers::uploadsFile($_FILES['image']['name'],$_FILES['image']['size'],$_FILES['image']['tmp_name'],dirname(__DIR__,3).'/public_html/storages/imgs/',$img_name);
        img_to_db($upload,$name,$file_name);
      }
    }else{
      echo Json::message(true,'file custome name is required');
      exit;
    }
  }else{
    if(is_array($_FILES['image']['name'])){
      foreach($_FILES['image']['name'] as $key => $value){
      [$upload,$name,$file_name] = Helpers::uploadsFile($_FILES['image']['name'][$key],$_FILES['image']['size'][$key],$_FILES['image']['tmp_name'][$key],dirname(__DIR__,3).'/public_html/storages/imgs/');
      img_to_db($upload,$name,$file_name);
      }
    }else{
      [$upload,$name,$file_name] = Helpers::uploadsFile($_FILES['image']['name'],$_FILES['image']['size'],$_FILES['image']['tmp_name'],dirname(__DIR__,3).'/public_html/storages/imgs/');
      img_to_db($upload,$name,$file_name);
    }
  }
}