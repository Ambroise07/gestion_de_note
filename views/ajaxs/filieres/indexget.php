<?php
use Synext\Requests\Http;
use Synext\Models\Spinnerets;

if(Http::methods('GET')){
    $spins = (new Spinnerets)->pdo()->select("SELECT * FROM spinnerets ORDER BY id DESC");
    $html = '';
    $i = 0;
    foreach($spins as $spin){
        $i++;
       $html .= <<<HTML
        <tr>
            <td>{$spin->code}</td>
            <td>{$spin->wording}</td>
            <td>
                <div class="d-flex justify-content-around">
                    <span data-edit='{$spin->id}' class="edit btn btn-info d-inline-block">Update</span>
                    <span  data-delete='{$spin->id}' class="delete btn btn-danger d-inline-block">Delete</span>               
                </div>
            </td>
        </tr>
HTML;
    }
echo $html;
    exit;
}
?>