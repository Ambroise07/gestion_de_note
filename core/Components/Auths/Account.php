<?php 
namespace Synext\Components\Auths;

use Synext\Components\Databases\Database;
use Synext\Components\Emails\SendMail;
use Synext\Components\Htmls\HtmlTemplate;

class Account{
    private $db;
    private $domaine = '';
    public function __construct()
    {
        $this->db = new Database();
    }
    /**
     * checkUserToken  using to verify if user token and id is in database.
     *
     * @param int    $id id
     * @param string $token token
     *
     * @return bool if token and id is really in database and valid
     */
    public function checkUserToken(int $id, string $token):bool
    {
        $query = 'SELECT id FROM users WHERE id = :id AND token = :token';
        $confirm = $this->db->select($query,false,[':id'=>$id,':token'=>$token]);
        if($confirm === false){
            return false;
        }
        return true;
    }
    /**
     * validateUserAccount use to confirm user account and save in database.
     *
     * @param int $id user id
     * @param string $token token
     * @return bool if user is confirm
     */
    public function validateUserAccount(int $id,string $token): bool
    {
        if($this->checkUserToken($id,$token)){
            $query = 'UPDATE users SET token = NULL , created_at = NOW() WHERE id = :id';
            $userValidate = $this->db->update($query,[':id'=>$id]);
            if ($userValidate) {
                return true;
            }
        }
        return false;
    }


    /**
     * Update user [PASSWORD] 
     *
     * @param int    $id
     * @param string $passwd
     *
     * @return bool if password is successfull update
     */
    public function upadteUserPassword(int $id, string $passwd): bool
    {
        $query = 'UPDATE users SET tokenP_reset = NULL , createdP_reset = NULL,  password = :password WHERE id = :id';
        $passwdUpdate = $this->db->update($query,[':password'=>$passwd,':id'=>$id]);
        if($passwdUpdate) {
            return true;
        }
        return false;
    }

    /**
     * Set reset Password Token.
     * @param string $token
     * @param string $email
     * @return bool
     */
    public function setResetPasswordToken(string $token,string $email): bool
    {
        $query = 'UPDATE users SET tokenP_reset = :token , createdP_reset = NOW() WHERE email = :email';
        $resetPasswordToken = $this->db->update($query,[':token'=>$token,':email'=>$email]);
        if($resetPasswordToken){
            return true;
        }
        return false;
    }

    public function sendUserMessageResetPassword(int $id,string $email):bool{
        $token = Auth::Token(50);
        $name = explode('@',$email);
        $link = $this->domaine.'/member/password?id='.$id.'&token='.$token;
        $sendToken = $this->setResetPasswordToken($token,$email);
        if($sendToken){
            return SendMail::mailTo(['noreply@informatutos.com'],$email,'Réinitialisation de votre mot de passe ',HtmlTemplate::htmlMailReset($name[0],$link));
        }
        return false;

    }

    /**
     * Check reset token 
     *
     * @param int    $id    
     * @param string $token
     *
     * 
     */
    public function checkUserResetPasswordToken(int $id, string $token):bool
    {
        $query = 'SELECT * FROM users WHERE id = :id AND tokenP_reset = :token AND createdP_reset > DATE_SUB(NOW(), INTERVAL 30 MINUTE)';
        $check = $this->db->select($query,false,[':id'=>$id,':token'=>$token]);
        if($check === false){
            return false;
        }
        return true;

    }
}