<?php
namespace Synext\Components\Auths;

use Synext\Components\Databases\Database;
use Synext\Helpers\Redirect;
use Synext\Helpers\Session;
use Synext\Models\Users;
use PDO;
class Login {

    private $db;
    public function __construct(Database $db=null)
    {
        if(is_null($db)){
            $this->db = new Database;
        }else{
            $this->db = $db;
        }
    }
    /**
     * Function using to check all user information before connect them [connect_user].
     *
     * @param string $email user email
     *
     * @return Users|bool : content data of user
     */
    public function checkUser(string $email)
    {
        $query = 'SELECT * FROM users WHERE email = ?';
        return  $this->db->select($query,false,[$email],PDO::FETCH_CLASS,Users::class);
      
        //false ou Users null
    }
    /**
     * Get pdo instance
     *
     * @return Database $db
     */
    public function db(){
        return $this->db;
    }

    /**
     * connect user
     *
     * @param integer $userId
     * @param string $url
     * @return void
     */
    public function connectUser(int $userId,string $url = '/'){
        Session::checkSession();
        $_SESSION['Auth'] = $userId;
        $_SESSION['flash']['succes'] = true;
        //FlashMessage::success('Welcom '.$this->data->getUsername());
        Redirect::To($url);
    }
}