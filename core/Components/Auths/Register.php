<?php
namespace Synext\Components\Auths;

use Synext\Components\Databases\Database;
use Synext\Components\Emails\SendMail;
use Synext\Components\Htmls\HtmlTemplate;
use Synext\Models\Users;

class Register{
    private $db;
    private $domaine = '';
    public function __construct(Database $db = null)
    {
        if(is_null($db)){
            $this->db = new Database;
        }else{
            $this->db = $db;
        }
    }

    /** 
     * Function using to insert new user to the database [newuser].
     * @param Users  user
     * @return int the last insert id
    **/
    public function newuser(Users $user): int
    {
        $query = "INSERT INTO `users` (`username`, `email`, `password`, `token`) VALUES (:username, :email, :password, :token);";
        $user_info = [
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPassword(),
            ':token' => $user->getToken()
        ];
        return $this->db->insert($query,$user_info,true);
    }
    /**
     * Add new Buyer and return her id
     *
     * @param Users $user
     * @return integer
     */
    public function newBuyer(Users $user): int
    {
        $query = "INSERT INTO `users` (`username`, `email`) VALUES (:username, :email);";
        $user_info = [
            ':username' => $user->getUsername(),
            ':email' => $user->getEmail(),
        ];
        return $this->db->insert($query,$user_info,true);
    }
    
    public function sendConfirmeMessage(string $to,int $id,string $token){
        $name = explode('@',$to)[0];
        $link = $this->domaine.'/user/confirm?id='.$id.'&token='.$token;
        return SendMail::mailTo(['noreply@informatutos.com'],$to,'Confirmer votre compte', HtmlTemplate::htmlMailConfirm($name,$link));
    }

}