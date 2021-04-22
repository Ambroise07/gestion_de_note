$(function() {

    function dataToJson($data) {
        return JSON.stringify($data)
    }

    function getResponse(response) {
        //console.log(response)
        // return false
        if (response.error) {
            alertify.error(response.message);
        } else {
            alertify.success(response.message);
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

    function dataJson(code, wording) {
        return dataToJson({
            code: code,
            wording: wording
        })

    }
    var has_error = function(selector, message) {
        selector.addClass('is-invalid')
        $('<div class="invalid-feedback">' + message + '</div>').insertAfter(selector);
    }

    function spinneretTable() {
        $.get("/requests/filiere", function(data) {
            $('#spinneretTable').html(data)
        }, "html");
    }
    //submit category
    $('#form-spinnerets').submit(function(e) {
        e.preventDefault();
        code = $('#code')
        wording = $('#wording')
        if (code.val() == '') {
            has_error(code, 'Vous devez entrer le code filière')
        } else if (wording.val() == '') {
            has_error(wording, 'Vous devez entrer le nom de la filière')
        } else {
            // console.log($('#name').val())
            // return false
            ajaxRequest(dataJson(code.val(), wording.val()), 'POST', '/requests/filiere', getResponse)
            code.val('')
            wording.val('')
            spinneretTable()
        }


    });
    // spinneretTable

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        code = $('#code_')
        wording = $('#wording_')
        id = $(this).data('edit')
        $("#editspinneret").modal(
            $.get("/requests/filiere/" + id,
                function(response) {
                    if (response.error) {
                        console.log("error")
                        return false
                    }
                    data = response.data
                    $('#update-spinneret').attr('data-id', data.id)
                    code.val(data.code)
                    wording.val(data.wording)
                },
                "json"
            )
        );

    })

    //update catgeory submit
    $('#update-spinneret').submit(function(e) {
        e.preventDefault();
        code = $('#code_')
        wording = $('#wording_')
        ajaxRequest(dataJson(code.val(), wording.val()), 'PATCH', '/requests/filiere/' + id, getResponse)
        spinneretTable()
        $('#editspinneret').modal('hide')
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault()
        swal({
                title: "ATTENTION SUPPRESSION ?",
                text: "VOULEZ-VOUS VRAIMENT SUPPRIMER ? ",
                icon: "warning",
                buttons: {
                    cancel: 'NON',
                    catch: {
                        text: 'OUI',
                        value: 'confirmer'
                    }
                },
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    row = $(this).parent().parent().parent()

                    id = $(this).data('delete')
                    ajaxRequest(dataJson(), 'DELETE', '/requests/filiere/' + id, getResponse)
                    row.hide('slow')
                } else {
                    swal("SUPPRESSION ANNULÉE");
                }
            });

    });

})