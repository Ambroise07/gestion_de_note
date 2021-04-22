<?php

namespace Synext\Components\Htmls;

class HtmlTemplate
{
    private static $text;
    private static $message;
    private static $domaine_name = '';
        /**
     * return html template link element .
     *
     * @param string $linkname
     * @param string $linkdestination
     * @param string $linkdescription
     * @param string $linkads
     * @param string $linkauthor
     * @param string $linkcreateddate
     * @param string $linkmodifydate
     * @param string $linkstatus
     * @param string $linkview
     *
     *  * @return string
     */
    public static function htmlLink($router,$linkname, $link_struc, $linkdestination, $linkdescription, $linkads): string
    {
        return '<div class="col-lg-8 mb-3">
            <div class="card shadow">
                <div class="card-header">Link Name : '.$linkname.' <span  class="clip-copy fa fa-clipboard float-right" title="Cliquer pour Copier"  data-placement="top" data-clipboard-text='.self::$domaine_name.$link_struc.'></span> </div>
                <div class="card-body">
                    <h5 class="card-title">Lien de destination : <span class="ml-4">'.$linkdestination.'</span></h5>
                    <div class="card-text">
                        <p class="font-p">'.$linkdescription.'</p>
                    </div>
                    <a href="'.$linkads.'" target="_blank" class="btn btn-url">Ouvrire le lien</a>
                    <a href="'.($router->url('linkdetail',['structure'=>$link_struc])).'" class="float-right btn btn-url">Details du lien</a>
                </div>
            </div>
            <hr class="separator" style="width: 50%;">
    </div>';
    }

    /**
     * return html template link element .
     *
     * @param string $linkname
     * @param string $linkdestination
     * @param string $linkdescription
     * @param string $linkads
     * @param string $linkauthor
     * @param string $linkcreateddate
     * @param string $linkmodifydate
     * @param string $linkstatus
     * @param string $linkview
     *
     *  * @return string
     */
    public static function htmlLinkD($router,$linkname, $link_struc, $linkdestination, $linkdescription, $linkads, $linkauthor, $linkcreateddate, $linkmodifydate, $linkstatus, $linkview): string
    {
        return '<div class="col-lg-8 mb-3">
            <div class="card shadow">
                <div class="card-header">Link Name : '.$linkname.' <span class="clip-copy fa fa-clipboard float-right" title="Cliquer pour Copier"  data-placement="top" data-clipboard-text='.self::$domaine_name.$link_struc.'></span> </div>
                <div class="card-body">
                    <h5 class="card-title">Lien de destination : <span class="ml-4">'.$linkdestination.'</span></h5>
                    <div class="card-text">
                        <p class="font-p">'.$linkdescription.'</p>
                    </div>
                    <a href="'.$linkads.'" target="_blank" class="btn btn-url">Ouvrire le lien</a>
                    <a href="'.($router->url('link')).'" class="float-right btn btn-url">Acceuil</a>
                </div>
            </div>
    </div>
    <div class="col-lg-4 mb-3">
        <ul class="list-group shadow">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Auteur : <span class="span-f">'.$linkauthor.'</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Publier le : <span class="span-f">'.$linkcreateddate.'</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Dernière modification : <span class="span-f">'.$linkmodifydate.'</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Status : <span class="span-f">'.$linkstatus.'</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nombre de click : <span class="badge badge-primary badge-pill span-f">'.$linkview.'</span>
            </li>
        </ul>
    </div>';
    }

    /**
     * return  html Mail template !
     *
     * @param string $name
     * @param string $link
     *
     * @return string
     */
    public static function htmlMailReset(string $name, string $link): string
    {   $date = date('Y');
        return <<<HTML
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTDxhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                </head>
                <body>
                    <table width="660" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF" style="border-radius:6px">
                        <tbody>
                            <tr>
                                <td style="padding:30px 30px 30px 30px;border-radius:5px">
                                    <table width="600" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="font-size:14px;font-family:Helvetica,Arial,sans-serif;line-height:25px;color:#445566" >

                                                    <img src="" width=50 alt="informatutos.com" border="0" style="margin:0;padding:0;max-width:600px;border:none;font-size:14px;font-weight:bold;min-height:auto;line-height:100%;outline:none;text-decoration:none;text-transform:capitalize">

                                                    <div>
                                                        <p style="margin-top:0px;margin-bottom:20px"></p>
                                                        <p>Bonjour $name </p>

                                                        <p>Nous avons reçu une demande de réinitialisation de votre mot de passe Informaurl</p>

                                                        <p>Vous pouvez modifier directement votre mot de passe en cliquant sur le bouton</p>

                                                        <p> 
                                                            <a href="{$link}" style="color: #dddddd;text-decoration: none; display: block; border: 1px solid gray; width: 50%;background-color: gray; text-align: center;">Changer mot de passe</a>
                                                        </p>
                                                        <p>InformaTutos the geek world !</p>
                                                        <p></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="600" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
                                        <tbody>
                                            <tr>
                                                <td height="30" style="border-top:1px solid #dddddd"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellpadding="30" border="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="center" bgcolor="#eeeeee">
                                    <table width="660" cellpadding="0" border="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:10px;line-height:18px">
                                                    <div>
                                                        <p style="margin-top:30px;margin-bottom:10px">
                                                            Vous avez reçu ce courriel parce que vous êtes inscrit à <a href="" target="_blank"></a>
                                                            <br> <a href="" target="_blank">informatutos.com</a> Tous droits réservés. {$date}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
            </html>
HTML;
    }

    public static function htmlMailConfirm(string $name,string $link){
        $date = date('Y');
        return <<<HTML
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTDxhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                </head>
                <body>
                    <table width="660" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF" style="border-radius:6px">
                        <tbody>
                            <tr>
                                <td style="padding:30px 30px 30px 30px;border-radius:5px">
                                    <table width="600" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
                                        <tbody>
                                            <tr>
                                                <td align="left" style="font-size:14px;font-family:Helvetica,Arial,sans-serif;line-height:25px;color:#445566" >

                                                    <img src="https://img.informatutos.com/image/informatutos.jpg" width=50 alt="informatutos.com" border="0" style="margin:0;padding:0;max-width:600px;border:none;font-size:14px;font-weight:bold;min-height:auto;line-height:100%;outline:none;text-decoration:none;text-transform:capitalize">

                                                    <div>
                                                        <p style="margin-top:0px;margin-bottom:20px"></p>
                                                        <p>Bonjour $name </p>

                                                        <p>On dirait que vous venez de rejoindre informaurl !</p>

                                                        <p>Cliquez sur le button pour pour confirmer votre compte</p>

                                                        <p> 
                                                            <a href="{$link}" style="color: #dddddd;text-decoration: none; display: block; border: 1px solid gray; width: 50%;background-color: gray; text-align: center;">Confirmer</a>
                                                        </p>
                                                        <p>InformaTutos the geek world !</p>
                                                        <p></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table width="600" cellpadding="0" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
                                        <tbody>
                                            <tr>
                                                <td height="30" style="border-top:1px solid #dddddd"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellpadding="30" border="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="center" bgcolor="#eeeeee">
                                    <table width="660" cellpadding="0" border="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:10px;line-height:18px">
                                                    <div>
                                                        <p style="margin-top:30px;margin-bottom:10px">
                                                            Vous avez reçu ce courriel parce que vous êtes inscrit à <a href="https://url.informatutos.com" target="_blank">InformaUrl</a>
                                                            <br> <a href="https://informatutos.com" target="_blank">informatutos.com</a> Tous droits réservés. {$date}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
            </html>
HTML;
    }
}
