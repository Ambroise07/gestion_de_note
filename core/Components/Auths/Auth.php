<?php

namespace Synext\Components\Auths;

use Synext\Controllers\User;
use Synext\Helpers\Redirect;
use Synext\Helpers\Session;

class Auth
{
    /**
     * Function using to generate random Token for account activation .
     *
     *
     * @param int $length
     *
     * @return string token
     */
    public static function token(int $length): string
    {
        $keys = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';

        return substr(str_shuffle(str_repeat($keys.bin2hex(random_bytes($length)), $length)), 0, $length);
    }

    public static function isConnect($router){
        Session::checkSession();
        if(!isset($_SESSION['Auth'])){
            Redirect::To($router->url('loginManagment'));
            exit;
        }
    }

    public static function allow($router, string $role)
    {
        //sql slug role getinfo() roles
        self::isConnect($router);
        if ((new User)->getRoleById((new User)->getUserById(self::who())->getRole_id())->name === $role) {
            return true;
        }else{
            return false;
        }
    }
    public static function who():int{
        self::isConnect();
        return $_SESSION['Auth'];
    }

}
