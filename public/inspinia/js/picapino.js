$(document).ready(function () {
    //ini Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            size: 'small',
            color: '#2ebeef'
        });
    });

    $('.js-switch').change(function () {        
        var idAct = $(this).val();
        var flag = 0;
        if ($(this).is(':checked')) {
            flag = 1;
        }
        var token = $('input[name=_token]').val();
        var url = $(this).data('url').replace('id/status', idAct + '/' + flag);
        if ($(this).is(':checked')) {
            flag = 1;
        }
        jQuery.ajax({
            url: url,
            type: "PUT",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                '_token': token
            },
            success: function (data) {
                toastr.success('El cambio de estado fue realizado con éxito', data.result);
            },
            error: function (error) {
                toastr.success('Se ha producido un error, contactar con los desarrolladores', '¡ERROR!');
            }
        });
    });
    //fin Switchery

    //ini dataTables
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy' },
            { extend: 'csv' },
            { extend: 'excel', title: $('#page-title').html() },
            { extend: 'pdf', title: $('#page-title').html() },

            {
                extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ]
    });
    //fin dataTables
});