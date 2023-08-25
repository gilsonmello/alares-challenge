$(function() {
    $('.select2').select2();

    console.log($('[data-mask]'))

    $('[data-mask]').maskMoney({
        prefix: 'R$ ',
        thousands: '.',
        allowNegative: false,
        decimal: ','
    });

    $('[data-method]').append(function ()
    {
        let method;
        if($(this).attr('data-method') != undefined || $(this).attr('data-method') != ""){
            method = $(this).attr('data-method');
        }else{
            method = "POST";
        }
        const orderid = $(this).attr('data-id');
        const message = $(this).attr('data-message');
        return "\n" +
            "<form action='" + $(this).attr('href') + "' method='"+method+"' data-id='" + orderid + "' data-message='" + message + "' name='delete_item' style='display:none'>\n" +
            "   <input type='hidden' name='_method' value='delete'>\n" +
            "   <input type='hidden' name='_token' value='" + $('meta[name="_token"]').attr('content') + "'>\n" +
            "</form>\n"
    })
    .removeAttr('href')
    .attr('style', 'cursor:pointer;')
    .attr('onclick', '$(this).find("form").submit();');

    $('form[name=delete_item]').submit(function () {
        return confirm("Tem certeza que deseja excluir esse item?");
    });
})
