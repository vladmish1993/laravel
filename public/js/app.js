$(document).on("click", '.apply-button', function(event) {
    var button = $(this);
    var job_id = button.data("job-id");
    var apply = button.data("apply");

    if(!apply)
    {
        var text = button.text();

        $.ajax({
            url: '/apply/' + job_id,
            type: 'post',
            data: {
                job_id: job_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                button.text(text == "Apply" ? "Already applied" : "Apply");
                button.addClass('disabled');
            }
        });
    }
});

