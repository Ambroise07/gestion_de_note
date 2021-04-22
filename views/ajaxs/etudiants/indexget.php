<?php
use Synext\Requests\Http;
use Synext\Models\Students;

if(Http::methods('GET')){
    $students = (new Students)->pdo()->select("SELECT * FROM students ORDER BY id DESC");
    $html = '';
    $i = 0;
    foreach($students as $student){
        $i++;
       $html .= <<<HTML
        <tr>
            <td>{$student->matricule}</td>
            <td>{$student->last_name}</td>
            <td>{$student->first_name}</td>
            <td>{$student->address}</td>
            <td>{$student->date_of_birth}</td>
            <th><img style="width: 50px;" src="/storages/imgs/{$student->photo}" class="img-thumnail" alt=""></th>
            <td>
                <div class="d-flex justify-content-around">
                    <span data-edit='{$student->id}' class="edit btn btn-info d-inline-block">Update</span>
                    <span data-delete='{$student->id}' class="delete btn btn-danger d-inline-block">Delete</span>
                </div>

            </td>
        </tr>
HTML;
}
echo $html;
exit;
}
?>