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

    function dataJson(student, matter, cc1, cc2, exam) {
        return dataToJson({
            student: student,
            matter: matter,
            //note: note,note,
            cc1: cc1,
            cc2: cc2,
            exam: exam

        })

    }
    var has_error = function(selector, message) {
        selector.addClass('is-invalid')
        $('<div class="invalid-feedback">' + message + '</div>').insertAfter(selector);
    }

    function noteTable() {
        $.get("/requests/note", function(data) {
            $('#noteTable').html(data)
        }, "html");
    }
    //submit notes
    $('#form-note').submit(function(e) {
        e.preventDefault();
        student = $("#student")
        matter = $("#matter")
            //note = $("#note")note.val(),note.val(),
        cc1 = $("#cc1")
        cc2 = $("#cc2")
        exam = $("#exam")
            // console.log(dataJson(student.val(), matter.val(), cc1.val(), cc2.val(), exam.val()))
            //return false
            // if (note.val() == '') {
            //     has_error(note, 'Vous devez entrer une note')
            // } else 
        if (cc1.val() == '') {
            has_error(cc1, 'Veuillez fournir la note')
        } else if (cc2.val() == '') {
            has_error(cc2, 'Veuillez fournir la note')
        } else if (exam.val() == '') {
            has_error(exam, 'Veuillez fournir la note')
        } else {
            // console.log($('#name').val())
            // return false
            ajaxRequest(dataJson(student.val(), matter.val(), cc1.val(), cc2.val(), exam.val()), 'POST', '/requests/note', getResponse)
            cc1.val('')
            cc2.val('')
            exam.val('')
            noteTable()
        }


    });
    // Notes

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        student = $("#student_")
        matter = $("#matter_")
            // note = $("#note_")note.val(data.note)
        cc1 = $("#cc1_")
        cc2 = $("#cc2_")
        exam = $("#exam_")
        id = $(this).data('edit')
        $("#editnote").modal(
            $.get("/requests/note/" + id,
                function(response) {
                    if (response.error) {
                        console.log("error")
                        return false
                    }
                    data = response.data
                    $('#update-note').attr('data-id', data.id)

                    student.val(data.student)
                    matter.val(data.matter)

                    cc1.val(data.cc1)
                    cc2.val(data.cc2)
                    exam.val(data.exam)
                },
                "json"
            )
        );

    })

    //update catgeory submit
    $('#update-note').submit(function(e) {
        e.preventDefault();
        student = $("#student_")
        matter = $("#matter_")
            //note = $("#note_")note.val(),
        cc1 = $("#cc1_")
        cc2 = $("#cc2_")
        exam = $("#exam_")
        ajaxRequest(dataJson(student.val(), matter.val(), cc1.val(), cc2.val(), exam.val()), 'PATCH', '/requests/note/' + id, getResponse)
        noteTable()
        $('#editnote').modal('hide')
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
                    ajaxRequest(dataJson(), 'DELETE', '/requests/note/' + id, getResponse)
                    row.hide('slow')
                } else {
                    swal("SUPPRESSION ANNULÉE");
                }
            });

    });

})