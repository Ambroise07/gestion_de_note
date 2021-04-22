$(function() {
    function dataToJson($data) {
        return JSON.stringify($data)
    }

    function getResponse(response) {
        //console.log(response)
        // return false
        if (response.error) {
            swal("ATTENTION !", response.message, "error");
        } else {
            // console.log(response) //matricule
            BulletinTable(response.data.matricule)

        }
    }

    function ajaxRequest(data, method, url, callback) {
        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: "JSON",
            contentType: "application/json; charset=utf-8",
            success: callback
        });
    }

    function dataJson(matricule) {
        return dataToJson({
            matricule: matricule,
        })

    }
    // swal("SUPPRESSION ANNULÉE");
    var has_error = function(selector, message) {
        selector.addClass('is-invalid')
        $('<div class="invalid-feedback">' + message + '</div>').insertAfter(selector);
    }

    function BulletinTable(matricule) {
        $.get("/requests/bulletin/" + matricule, function(data) {
            $('#Bulletin').html(data)
        }, "html");
        //$('#Bulletin').html(response)
    }
    //submit category
    $('#form-bulletin').submit(function(e) {
        e.preventDefault();
        matricule = $('#matricule')
        if (matricule.val() == '') {
            has_error(code, 'Vous devez entrer le numero matricule')
        } else {
            ajaxRequest(dataJson(matricule.val()), 'POST', '/requests/bulletin', getResponse)
                //BulletinTable(matricule.val())
            matricule.val('')
        }
    });
})