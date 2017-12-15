$(document).ready(function(){

    updateBill();

    $('[data-toggle="tooltip"]').tooltip();
    $(".navbar a, footer a[href='#home']").on('click', function(event) {
        $('ul.nav a').each(function () {
            $(this).parent().removeClass('active');
        });
        $(this).parent().addClass('active');
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function(){
                window.location.hash = hash;
            });
        }
    });


    // Dropdown toggle
    $('.dropdown-toggle').click(function(){
        $(this).next('.dropdown-menu').toggle();
    });

    $(document).click(function(e) {
        var target = e.target;
        if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
            $('.dropdown-menu').hide();
        }
    });

    /*$('.cart-container').on('mousemove', function(evt) {
        var windowWidth = $(window).width();
        var cartWidth = $('.product').length * 200;
        if(windowWidth < cartWidth)
            $('.cart').stop(false, true).animate({
                left: - (evt.clientX / windowWidth) * (cartWidth - windowWidth)
            });
        else
            $('.cart').stop(false, true).css({
                left: 0
            });
    });*/

    $(document).on("click", ".testz", function() {
        var product = $(this).closest('.product');
        plusProduct(product);
    });

    $('.list').find('.plus').click( function() {
        var product = $(this).closest('.product');
        var productId = product.data('id');
        var element = $('.shopping-cart').find("[data-id='" + productId + "']");
        if (!element.length){
            $('.mini-cart').append(product.clone()).find(".plus").addClass("testz");
        }


        plusProduct(product);
       /* var element = $('.shopping-cart').find("[data-id='" + productId + "']");
        var q = product.data('quantity') + 1;
        if (element.length == 0){
            $('.mini-cart').append(product.clone());
            $('.plus').click( function() {
                var product = $(this).closest('.product');
                var productId = product.data('id');
                var element = $('.shopping-cart').find("[data-id='" + productId + "']");
                var q = product.data('quantity') + 1;
                element.data('quantity', q);
                updateProduct(element);
            });

        }else{
            element.data('quantity', q);
            updateProduct(element);
        }
        product.data('quantity', q);
        updateProduct(product);*/
    });

    $('.minus').click( function() {
        var product = $(this).closest('.product');
        var q = Math.max(0, product.data('quantity') - 1);
        product.data('quantity', q);
        updateProduct(product);
    });

    $('.del').click( function() {
        var product = $(this).closest('.product');
        product.hide('blind', {direction:'left'}, 500, function() {
            product.remove();
            updateProduct(product);
            if($('.product').length == 0)  {
                $('.cart-container .cart').hide();
                $('.cart-container .empty').show();
            }
        });
    });

});

function plusProduct(product) {



    var productId = product.data('id');
    var products = $("[data-id='" + productId + "']");
    var q = products.data('quantity') + 1;
    products.data('quantity', q);
    updateProduct(products);

}

function updateProduct(products) {
    var quantity = products.data('quantity');
    console.log(quantity);
    $('.product-quantity', products).text('x' + quantity);
    updateBill();
}

function updateBill() {
    var subtotal = 0;
    var shipping = 1;
    var cartObj = {};
    var quantity = 0;
    $('.shopping-cart').find('.product').each(function () {
        quantity = $(this).data('quantity');
        subtotal += quantity * $(this).data('price');
        var productId = $(this).data('id');
        if (quantity > 0){
            cartObj[productId] = $(this).data('quantity');
        }
    });
    total = subtotal + shipping;
    $('.subtotal .value').text(subtotal.toFixed(2) + ' €');

    $('.total .value').text(total.toFixed(2) + ' €');
    Cookies.remove('cart');
    Cookies.set('cart', JSON.stringify(cartObj));
}
