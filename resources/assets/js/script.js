$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$('.changePrice').on('click', function (e) {
    e.preventDefault();
    clearModal();
    const productId = $(this).parent().data('productid');
    $('#price').val($(this).parent().data('price'));
    $('#savePrice').data('productid', productId);

    $('#modalChangePrice').modal();
});

$('#savePrice').on('click', function (e) {
    e.preventDefault();
    const productId = $('#savePrice').data('productid');
    const action = $(`#product-price-${productId}`).data('action');
    $.ajax({
        type: 'PUT',
        url: action,
        data: {price: $('#price').val()},
        dataType: 'json',
        success: function (data){
            $('#modalChangePriceSuccess').addClass('alert-success').text(data.message).removeClass('d-none')
            $(`#product-price-${productId} a`).text(data.price);
            $('#price').val($(`#product-price-${productId}`).data('price', data.price));

            setTimeout(function () {
                $('#modalChangePrice').modal('hide');
            }, 1000);
        },
        error: function (errors) {
            console.log(errors);
            $('#price').addClass('is-invalid');

            if (errors.status === 422) {
                $('#feedback_price').text(errors.responseJSON.errors.price[0]).css('display', 'block');
            } else {
                $('#feedback_price').text('Something went wrong').css('display', 'block');
            }
        }
    });
});

const clearModal = function () {
    $('#feedback_price').text('').css('display', 'none');
    $('#modalChangePriceSuccess').addClass('d-none');
    $('#price').removeClass('is-invalid');
}