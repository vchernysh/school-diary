// JavaScript Document

$(document).ready(function() {

    $('.send_button_request_liqpay').click(function() {
        var button = $(this);

        button.attr('disabled', true).css({
            'cursor': 'wait',
            'opacity': .75
        });

        $.ajax({
            url: '/payments/add-new-order',
            type: 'POST',
            data: ({
                action: 'addNewOrder'                
            }),
            dataType: "json",
            success: function(data) {
                $('#liqpay-form').attr('action', data['action_form']);
                $('#data').val(data['data']);
                $('#signature').val(data['signature']);
                $('#liqpay-form').submit();
            },
            error: function() {
                button.attr('disabled', false).css({
                    'cursor': 'pointer',
                    'opacity': 1
                });
            }
        });
        return false;
    });
});