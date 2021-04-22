<?php
use Synext\Helpers\Redirect;
use Synext\Helpers\Session;

Session::checkSession();

if(isset($_SESSION['Auth'])){
    Session::destroy('Auth');
    Redirect::to('/connection');
}
