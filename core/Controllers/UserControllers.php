<?php
namespace Synext\Controllers;
use Synext\Components\Auths\Login;
use Synext\Components\Htmls\Form;
use Synext\Components\Validators\Validator;
use Synext\Helpers\Redirect;
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
use Synext\Components\Auths\Register;
use Synext\Models\Users;

class UserControllers{
    private function is_alredy_login($router){
        Session::checkSession();
        if(Session::checkSessionVariable('Auth')){
            return Redirect::to($router->url('appnote#home'));
        }
        
    }
    public function login($router,array $post){
        $data = [];
        $errors = [];
        $errors_login = false;
        $message = '';
        $this->is_alredy_login($router);
        if(!empty($post)){
            $validate = new Validator($post);
            $validate->rule('required','email')
                    ->rule('required','password')
                    ->rule('email','email');
            if($validate->is_valide()){
            $email = htmlspecialchars($post['email']);
            $password = htmlspecialchars($post['password']);
            $DB = (new Login);
            $user = $DB->checkUser($email);
            if($user === false){
                $errors_login = true;
                $message .= 'Vos informations de connexion ne sont pas correct !';
            }else{
                if(!is_null($user->getToken())){
                    $errors_login = true;
                    $message .= 'Votre compte n\'est pas encors confirmer par un admin !';
                }elseif(is_null($user->getPassword())){
                    $password = password_hash($password,PASSWORD_BCRYPT);
                    $DB->db()->update("UPDATE users SET password=:password WHERE id=:id",['password'=>$password,'id'=>$user->getId()]);
                    $DB->connectUser($user->getId(),$router->url('appnote#home'));
                }else{
                        if(!password_verify($password,$user->getPassword())){
                            $errors_login = true;
                            $message .= 'Vos informations de connexion ne sont pas correct !';
                        }else{
                            $DB->connectUser($user->getId(),$router->url('appnote#home'));
                        }
                }
            }
            
            }else{
                $errors = $validate->errors();
            }
            $data = $post;
        }
        $form = new Form($data,$errors);
        return [$errors_login,$form,$message];
    }
    public function register($router){

        
        $data = [];
        $errors = [];
        $errors_register = false;
        $create_account = false;
        $message = '';
        $this->is_alredy_login($router);
        if(!empty($_POST)){
            $validate = new Validator($_POST);
            $validate->rule('required','username')
                    ->rule('required','email')
                    ->rule('required','password')
                    ->rule('email','email')
                    ->rule('required','username')
                    ->rules([
                        "lengthMin" 
                        => [
                                [
                                    ['username'], 5
                                ]
                            ]
                    ]);
            if($validate->is_valide()){
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $user = (new Login)->checkUser($email);
                if($user === false){
                     $user = (new Users);
                     $user->setUsername($username)
                     ->setEmail($email)
                     ->setPassword(password_hash($password,PASSWORD_BCRYPT));
                    $newUser = (new Register)->newuser($user);
                    //sendConfirmeMessage
                    $create_account = true;
                }else{
                    $errors_register = true;
                    $message .= 'Un utilisateur existe déja !';
                }
               
            }else{
                $errors = $validate->errors();
            }
            
            $data = $_POST;
        }
        $form = new Form($data,$errors);
        return [$errors_register,$create_account,$form,$message];
    }
}