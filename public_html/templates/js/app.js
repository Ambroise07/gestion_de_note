$(function() {


    /**Tooltips init */
    $('[data-toggle="tooltip"]').tooltip()
    $('#logout').click(function(e) {
        e.preventDefault();
        $.get("/logout",
            function(response) {
                if (!response.error) {
                    location.replace('/')
                }
            },
            "JSON"
        );
    })
});