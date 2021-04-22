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

    function dataJson(spinneret, student) {
        return dataToJson({
            spinneret: spinneret,
            student: student
        })

    }
    var has_error = function(selector, message) {
        selector.addClass('is-invalid')
        $('<div class="invalid-feedback">' + message + '</div>').insertAfter(selector);
    }

    function inscriptionTable() {
        $.get("/requests/inscription", function(data) {
            $('#inscriptionTable').html(data)
        }, "html");
    }
    //submit Inscription
    $('#inscription-forms').submit(function(e) {
        e.preventDefault();
        spinneret = $('#spinneret')
        student = $('#student')
        if (spinneret.val() == '') {
            has_error(spinneret, 'Vous devez choisir une filière')
        } else if (student.val() == '') {
            has_error(student, 'Vous devez choisir un étudiant')
        } else {
            // console.log($('#name').val())
            // return false
            ajaxRequest(dataJson(spinneret.val(), student.val()), 'POST', '/requests/inscription', getResponse)
            inscriptionTable()
        }


    });
    // Inscription

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        spinneret = $('#spinneret_')
        student = $('#student_')
        id = $(this).data('edit')
        $("#editinscription").modal(
            $.get("/requests/inscription/" + id,
                function(response) {
                    if (response.error) {
                        console.log("error")
                        return false
                    }
                    data = response.data
                    $('#update-inscriptions').attr('data-id', data.id)
                    spinneret.val(data.spinneret)
                    student.val(data.student)
                },
                "json"
            )
        );

    })

    //update catgeory submit
    $('#update-inscriptions').submit(function(e) {
        e.preventDefault();
        spinneret = $('#spinneret_')
        student = $('#student_')
        ajaxRequest(dataJson(spinneret.val(), student.val()), 'PATCH', '/requests/inscription/' + id, getResponse)
        inscriptionTable()
        $('#editinscription').modal('hide')
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
                    ajaxRequest(dataJson(), 'DELETE', '/requests/inscription/' + id, getResponse)
                    row.hide('slow')
                } else {
                    swal("SUPPRESSION ANNULÉE");
                }
            });

    });

})