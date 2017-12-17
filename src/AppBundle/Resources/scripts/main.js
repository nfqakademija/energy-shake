$(document).ready(function(){

    showCart();
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

    $('.show-cart').click(function(){
        $(document).find('.show-hide').slideToggle('800');
        $(this).toggleClass('glyphicon-minus glyphicon-shopping-cart')
    });

    $(document).on("click", ".cart-product", function() {
        var product = $(this).closest('.product');
        plusProduct(product);
    });

    $(document).on("click", ".minus", function() {
        var product = $(this).closest('.product');
        minusProduct(product);
    });

    $(document).on("click", ".del", function() {
        var product = $(this).closest('.product');
        removeProduct(product);
    });

    $('.list').find('.plus').click( function() {
        var product = $(this).closest('.product');
        var productId = product.data('id');
        var element = $('.shopping-cart').find("[data-id='" + productId + "']");
        if (!element.length){
            $('.mini-cart').append(product.clone()).find(".plus").addClass("cart-product");
        }
        plusProduct(product);
    });

    /*$('.del').click( function() {
        var product = $(this).closest('.product');
        product.hide('blind', {direction:'left'}, 500, function() {
            product.remove();
            updateProduct(product);
            if($('.product').length == 0)  {
                $('.cart-container .cart').hide();
                $('.cart-container .empty').show();
            }
        });
    });*/

});

function plusProduct(product) {
    var productId = product.data('id');
    var products = $("[data-id='" + productId + "']");
    var q = products.data('quantity') + 1;
    products.data('quantity', q);
    updateProduct(products);
    toggleCart();
}

function minusProduct(product) {
    var productId = product.data('id');
    var products = $("[data-id='" + productId + "']");
    var q = products.data('quantity') - 1;
    if (q < 0) q = 0;
    products.data('quantity', q);
    updateProduct(products);
    toggleCart();
}

function removeProduct(product) {
    var productId = product.data('id');
    var products = $("[data-id='" + productId + "']");
    products.data('quantity', 0);
    updateProduct(products);
    product.remove();
    showCart();
}

function updateProduct(products) {
    var quantity = products.data('quantity');
    $('.product-quantity', products).text('x' + quantity);
    updateBill();
}

function toggleCart() {
    var hide = $('.shopping-cart').find(".glyphicon-shopping-cart");
    if (hide.length){
        $(document).find('.show-hide').slideToggle('800');
        hide.toggleClass('glyphicon-shopping-cart glyphicon-minus')
    }
}

function showCart() {
    var cartElement = $('.shopping-cart').find(".product");
    if (!cartElement.length) {
        $(document).find('.show-hide').slideToggle('800');
        $(".glyphicon-minus").toggleClass('glyphicon-shopping-cart glyphicon-minus')
    }
}

function updateBill() {
    var total = 0;
    var cartObj = {};
    var quantity = 0;
    $('.shopping-cart').find('.product').each(function () {
        quantity = $(this).data('quantity');
        total += quantity * $(this).data('price');
        var productId = $(this).data('id');
        if (quantity > 0){
            cartObj[productId] = $(this).data('quantity');
        }
    });

    $('.total .value').text(total.toFixed(2) + ' €');
    Cookies.remove('cart');
    Cookies.set('cart', JSON.stringify(cartObj));
}
