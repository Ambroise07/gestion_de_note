$(function() {
    function dragUploadsmage(areardrop, previewmage, requestlink) {
        $(document).on('dragenter', areardrop, function(exxx) {
            exxx.preventDefault()
            $(this).css('background', '#001429 ');
        });
        $(document).on('dragover', areardrop, function(exx) {
            exx.preventDefault()
        });
        $(document).on('drop', areardrop, function(ex) {
            ex.preventDefault()
            $('.text').text('')
            var formImage = new FormData()
            var img = ex.originalEvent.dataTransfer.files;
            for (var i = 0; i < img.length; i++) {
                formImage.append('image[]', img[i])
            }
            img_name = $("#matricule").val()
            formImage.append('img_name', img_name)
            $(this).css('background', 'green')
            $.ajax({
                url: requestlink,
                type: "POST",
                data: formImage,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (!data.error) {
                        $(previewmage).html("<img src='" + data.data.path + "'" + " alt='' srcset='' class='img-fluid'>")
                    } else {
                        alertify.error(data.message);
                    }
                }
            });
            $(this).css('background', 'white')

        });
    }

    function dataToJson($data) {
        return JSON.stringify($data)
    }

    function getResponse(response) {
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

    function dataJson(matricule, last_name, first_name, address, date_of_birth) {
        return dataToJson({
            matricule: matricule,
            last_name: last_name,
            first_name: first_name,
            address: address,
            date_of_birth: date_of_birth,
        })

    }

    function etudiantTable() {
        $.get("/requests/etudiant", function(data) {
            $('#etudiantTable').html(data)
        }, "html");
    }
    var has_error = function(selector, message) {
        selector.addClass('is-invalid')
        $('<div class="invalid-feedback">' + message + '</div>').insertAfter(selector);
    }

    dragUploadsmage("#areaDrop", "#show-img", "/requests/etudiant/image")

    //submit students
    $(document).on('submit', '#form-students', function(e) {
        e.preventDefault();
        matricule = $('#matricule')
        last_name = $('#last_name')
        first_name = $('#first_name')
        address = $('#address')
        date_of_birth = $('#date_of_birth')
        if (matricule.val() == '') {
            has_error(matricule, 'Vous devez entrer un numero matricukle')
        } else if (last_name.val() == '') {
            has_error(matricule, 'Vous devez entrer un nom pour l\'étudiant')
        } else if (first_name.val() == '') {
            has_error(first_name, 'Vous devez entrer un prénom pour l\'étudiant')
        } else if (address.val() == '') {
            has_error(address, 'Vous devez entrer un address pour l\'étudiant')
        } else if (date_of_birth.val() == '') {
            has_error(date_of_birth, 'Vous devez entrer la date de naissance ')
        } else {
            matricule = parseInt(matricule.val())
            last_name = last_name.val()
            first_name = first_name.val()
            address = address.val()
            date_of_birth = date_of_birth.val()
                // photo = $('#photo').val()
            ajaxRequest(dataJson(matricule, last_name, first_name, address, date_of_birth), 'POST', '/requests/etudiant', function(response) {
                if (response.error) {
                    alertify.error(response.message);
                    return false
                } else {
                    alertify.success(response.message);
                }
            })
            etudiantTable()
            $("#form-students").trigger("reset");
            $('#show-img').html('')
        }

    });
    //edit category
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        matricule = $('#matricule_')
        last_name = $('#last_name_')
        first_name = $('#first_name_')
        address = $('#address_')
        date_of_birth = $('#date_of_birth_')
        id = $(this).data('edit')
        $("#editstudents").modal(
            $.get("/requests/etudiant/" + id,
                function(data) {
                    data = data.data
                    $('#update-students').attr('data-id', data.id)
                    matricule.val(data.matricule)
                    last_name.val(data.last_name)
                    first_name.val(data.first_name)
                    address.val(data.address)
                    date_of_birth.val(data.date_of_birth)
                },
                "json"
            )
        );
    });
    //update catgeory submit
    $('#update-students').submit(function(e) {
        e.preventDefault();
        matricule = parseInt(matricule.val())
        last_name = last_name.val()
        first_name = first_name.val()
        address = address.val()
        date_of_birth = date_of_birth.val()
        ajaxRequest(dataJson(matricule, last_name, first_name, address, date_of_birth), 'PATCH', '/requests/etudiant/' + id, getResponse)
        $('#editstudents').modal('hide')
        etudiantTable()
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
                    ajaxRequest(dataJson(), 'DELETE', '/requests/etudiant/' + id, getResponse)
                    row.hide('slow')
                } else {
                    swal("SUPPRESSION ANNULÉE");
                }
            });

    });

})