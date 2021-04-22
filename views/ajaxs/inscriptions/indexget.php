<?php
use Synext\Requests\Http;
use Synext\Models\Matters;

if(Http::methods('GET')){
    $inscrits = (new Matters)->pdo()->select("SELECT students.last_name,students.first_name,spinnerets.wording,registereds.id,registereds.year FROM students JOIN registereds ON registereds.id_student = students.id JOIN spinnerets ON spinnerets.id = registereds.id_spinneret ORDER BY id DESC");
    $html = '';
    $i = 0;
    foreach($inscrits as $inscrit){
        $i++;
       $html .= <<<HTML
        <tr>
            <th> $inscrit->last_name $inscrit->first_name </th>
            <th>{$inscrit->wording}</th>
            <th>{$inscrit->year}</th>
            <td>
                <div class="d-flex justify-content-around">
                    <span data-edit='{$inscrit->id}' class="edit btn btn-info d-inline-block">Update</span>
                    <span  data-delete='{$inscrit->id}' class="delete btn btn-danger d-inline-block">Delete</span>               
                </div>
            </td>
        </tr>
HTML;
    }
echo $html;
    exit;
}
?>