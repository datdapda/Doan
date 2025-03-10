$(document).ready(function($) {


    "use strict";

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll < 1) {
            $("header").removeClass("background-header");
        } else if (scroll > 100) {
            $("header").addClass("background-header");
        } else {
            $("header").removeClass("background-header");
        }

    });


});

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#scroll').fadeIn();
        } else {
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});

$(document).ready(function() {
    $('#TonKho').change(function() {
        if ($('#TonKho option:selected') != null) {
            $('#Kho').submit();
        }
    })
});

$(document).ready(function() {
    $('#asc_name').change(function() {
        if ($('#asc_name option:selected') != null) {
            $('#Loc').submit();
        }
    })
});
// thay đổi số lượng cart
$(document).on('input', '.num_product', function(e) {
    for (let index = 0; index < $('.num_product').length; index++) {
        if ($('.num_product').val() > 0) {
            $('#autoclick').click();
        } else {
            alert('Không được chỉnh về 0');
        }
    }
})

$(document).ready(function() {
    if ($('.owl-clients').length) {
        $('.owl-clients').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            items: 1,
            margin: 30,
            autoplay: false,
            smartSpeed: 700,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                460: {
                    items: 1,
                    margin: 0
                },
                576: {
                    items: 2,
                    margin: 20
                },
                992: {
                    items: 3,
                    margin: 30
                }
            }
        });
    }
});
// comment
$(document).ready(function() {

    $(document).on('click', '.reply', function() {
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_name').focus();
    });

});
// button thay đổi
$(document).ready(function() {
    $(document).on('click', '#Vnpay', function() {
        $('#redirect').removeClass('d-none');
        $('#thanhtoan').addClass('d-none');
        $('#redirect2').addClass('d-none');
    })
    $(document).on('click', '#MV', function() {
        $('#thanhtoan').removeClass('d-none');
        $('#redirect').addClass('d-none');
        $('#redirect2').addClass('d-none');

    })
    $(document).on('click', '#Momo', function() {
        $('#thanhtoan').addClass('d-none');
        $('#redirect').addClass('d-none');
        $('#redirect2').removeClass('d-none');

    })
});

$(document).ready(function() {
    setTimeout(function() {
        $("div.alert").remove();
    }, 5000); // 5 secs
});

function add_cart(num,id,token) {
    $.ajax({
        type: "POST",
        url: "/add-cart",
        
        data: { 
            _token: token,
            number: num,
            product_id:id
        },
        success: function ($res){
            alert('Bạn đã thêm vào giỏ hàng thành công');
        },
        dataType: 'JSON'
    });
}

$(function() {
    $('.form_addcart').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var num = form[0][1].value;
        var id = form[0][2].value;
        var token = form[0][3].value;
        var url = window.location.toString();
        add_cart(num,id,token);
        if (url.indexOf("san-pham") !== -1) {
            window.location = " /gio-hang";
        }else{
            location.reload();
        }
    });
})
