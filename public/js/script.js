$(document).ready(function () {
    $('#form').on('submit', function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $( this ).serialize(),
            dataType: 'json',
            success: function (data) {
                //$('.result').html(data['result']);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
