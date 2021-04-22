<?php
use Synext\Requests\Http;
use Synext\Models\Matters;
//SELECT matters.id,matters.code,matters.wording,spinnerets.wording as spinneret FROM matters JOIN  matter_spinnerets ON matter_spinnerets.id_matter = matters.id JOIN spinnerets ON spinnerets.id = matter_spinnerets.id_spinneret ORDER BY id DESC
if(Http::methods('GET')){
    $matters = (new Matters)->pdo()->select("SELECT matter_spinnerets.coefficient,matters.id,matters.code,matters.wording,spinnerets.wording as spinneret FROM matters JOIN  matter_spinnerets ON matter_spinnerets.id_matter = matters.id JOIN spinnerets ON spinnerets.id = matter_spinnerets.id_spinneret ORDER BY id DESC");
    $html = '';
    $i = 0;
    foreach($matters as $matter){
        $i++;
       $html .= <<<HTML
        <tr>
            <td>{$matter->code}</td>
            <td>{$matter->wording}</td>
            <th>{$matter->spinneret}</th>
            <th>{$matter->coefficient}</th>
            <td>
                <div class="d-flex justify-content-around">
                    <span data-edit='{$matter->id}' class="edit btn btn-info d-inline-block">Update</span>
                    <span  data-delete='{$matter->id}' class="delete btn btn-danger d-inline-block">Delete</span>               
                </div>
            </td>
        </tr>
HTML;
    }
echo $html;
    exit;
}
?>