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

    function dataJson(code, wording, spinneret, coefficient) {
        return dataToJson({
            code: code,
            wording: wording,
            spinneret: spinneret,
            coefficient: coefficient
        })

    }
    var has_error = function(selector, message) {
        selector.addClass('is-invalid')
        $('<div class="invalid-feedback">' + message + '</div>').insertAfter(selector);
    }

    function matterTable() {
        $.get("/requests/matiere", function(data) {
            $('#matterTable').html(data)
        }, "html");
    }
    //submit matters
    $('#form-matters').submit(function(e) {
        e.preventDefault();
        code = $('#code')
        wording = $('#wording')
        spinneret = $('#spinneret')
        coefficient = $("#coefficient")
        if (code.val() == '') {
            has_error(code, 'Vous devez entrer le code matière')
        } else if (wording.val() == '') {
            has_error(wording, 'Vous devez entrer le nom de la matière')
        } else if (coefficient.val() == '') {
            has_error(coefficient, 'Vous devez entrer le coefficient de la matière')
        } else {
            // console.log($('#name').val())
            // return false
            ajaxRequest(dataJson(code.val(), wording.val(), spinneret.val(), coefficient.val()), 'POST', '/requests/matiere', getResponse)
            code.val('')
            wording.val('')
            coefficient.val('')
            matterTable()
        }


    });
    // Matters

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        code = $('#code_')
        wording = $('#wording_') //coefficient
        spinneret = $('#spinneret_')
        coefficient = $('#coefficient_')
        id = $(this).data('edit')
        $("#editmatter").modal(
            $.get("/requests/matiere/" + id,
                function(response) {
                    if (response.error) {
                        return false
                    }
                    data = response.data
                    $('#update-matter').attr('data-id', data.id)
                    code.val(data.code)
                    wording.val(data.wording)
                    spinneret.val(data.spinneret_id)
                    coefficient.val(data.coefficient)
                },
                "json"
            )
        );

    })

    //update catgeory submit
    $('#update-matter').submit(function(e) {
        e.preventDefault();
        code = $('#code_')
        wording = $('#wording_')
        spinneret = $('#spinneret_')
        coefficient = $('#coefficient_')
        ajaxRequest(dataJson(code.val(), wording.val(), spinneret.val(), coefficient.val()), 'PATCH', '/requests/matiere/' + id, getResponse)
        matterTable()
        $('#editmatter').modal('hide')
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
                    ajaxRequest(dataJson(), 'DELETE', '/requests/matiere/' + id, getResponse)
                    row.hide('slow')
                } else {
                    swal("SUPPRESSION ANNULÉE");
                }
            });

    });

})