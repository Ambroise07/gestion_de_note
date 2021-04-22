<?php
namespace Synext\Helpers;
class Message{
    public static function error($message){
        return <<<HTML
        <div class="alert text-center alert-danger">$message</div>
HTML;
    }
    public static function success($message){
        return <<<HTML
        <div class="alert text-center alert-success">$message</div>
HTML;
    }

}