$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();
    $(".navbar a, footer a[href='#home']").on('click', function(event) {
        $('ul.nav a').each(function () {
            $(this).parent().removeClass('active');
        })
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

    $(document).on('click', '.addtocart-btn', function (e) {
        e.preventDefault();
        //define var
        var cartObj;

        //get all cart
        if (Cookies.get('cart')) {
            cartObj = JSON.parse(Cookies.get('cart'));
        } else {
            cartObj = {};
        }

        //get new vars
        var productRow = $(this).closest('.id-row');

        var productIdRaw = productRow.data('id');
        var productId = toPositiveInt(productIdRaw);

        var productQuantityRaw = productRow.find('.addtocart-input').val();
        var productQuantity = toPositiveInt(productQuantityRaw);
        if (isNaN(productQuantity)) {
            productQuantity = 1;
        }

        var productPriceRaw = productRow.parent().find('.price span').text();
        var productPrice = toPositiveInt(productPriceRaw);
        addToNavbarCart(productQuantity, productPrice);

        //record to cart
        if (cartObj[productId]) {
            cartObj[productId] = cartObj[productId] + productQuantity;
        } else {
            cartObj[productId] = productQuantity;
        }

        //set cookie
        Cookies.set('cart', JSON.stringify(cartObj));
    });

    $('.product-remove').on('click', function(e){
        e.preventDefault();
        var productRecord = $(this).closest('tr');
        productRecord.remove();

        recalculateCart();
    });

    $('.clear-cart').on('click', function(e){
        e.preventDefault();
        $('.product-position').each(function () {
                $(this).remove();
            }
        );
        recalculateCart();
    });

    $(".quantity").bind('keyup change click', function (e) {
        if (! $(this).data("previousValue") || $(this).data("previousValue") != $(this).val()) {
            $(this).data("previousValue", $(this).val());

            //if quantity changed
            recalculateCart();
        }
    });

    $(".quantity").each(function () {
        $(this).data("previousValue", $(this).val());
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

    $('.cart-container').on('mousemove', function(evt) {
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
    });

    $('.plus').click( function() {
        var product = $(this).closest('.product')
        var q = product.data('quantity') + 1;
        product.data('quantity', q);
        updateProduct(product);
    });

    $('.minus').click( function() {
        var product = $(this).closest('.product')
        var q = Math.max(0, product.data('quantity') - 1);
        product.data('quantity', q);
        updateProduct(product);
    });

    $('.del').click( function() {
        var product = $(this).closest('.product')
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

function updateProduct(product) {
    var quantity = product.data('quantity');
    $('.product-quantity', product).text('x' + quantity);
    updateBill();
}

function updateBill() {
    var subtotal = 0;
    var shipping = 1;
    var total = 0;
    $('.product').each(function () {
        subtotal += $(this).data('quantity') * $(this).data('price');
    });
    total = subtotal + shipping;
    $('.subtotal .value').text(subtotal.toFixed(2) + ' €');
    $('.total .value').text(total.toFixed(2) + ' €');
}








function recalculateCart(){
    var totalSum = 0;
    var totalQuantity = 0;
    var cartObj = {};

    $('.product-position').each(function () {
        var quantityInput = $(this).find('.quantity');

        //get all values
        var productId = toPositiveInt(quantityInput.data('id'));
        var productQuantity = toPositiveInt(quantityInput.val());
        var productPrice = toPositiveInt($(this).find('.price span').text());
        var productSum = productPrice * productQuantity;

        //show new sum
        var productSumSelector = $(this).find('.sum');
        productSumSelector.html(productSum);

        //record to obj
        cartObj[productId] = productQuantity;

        totalSum += productSum;
        totalQuantity += productQuantity;
    });

    //show new total sum
    var totalSumSelector = $('.totalsum');
    totalSumSelector.html(totalSum);

    //update navbar cart
    updateNavbarCart(totalQuantity, totalSum);

    //update cookies
    Cookies.remove('cart');
    Cookies.set('cart', JSON.stringify(cartObj));
}

function toPositiveInt(rawVal) {
    return Math.abs(Math.round(rawVal));
}


function addToNavbarCart(quantity, price){
    //find selectors
    var quantitySelector = $('#cart-quantity');
    var sumSelector = $('#cart-sum');

    var oldQuantity = toPositiveInt(quantitySelector.text());
    var oldSum = toPositiveInt(sumSelector.text());

    if (quantity > 0 && price > 0) {
        var newQuantity = oldQuantity + quantity;
        var newSum = oldSum + (price * quantity);

        quantitySelector.text(newQuantity);
        sumSelector.text(newSum);
    }
}

function updateNavbarCart(totalQuantity, totalSum){
    //find selectors
    var quantitySelector = $('#cart-quantity');
    var sumSelector = $('#cart-sum');

    //show new values
    quantitySelector.text(totalQuantity);
    sumSelector.text(totalSum);
}