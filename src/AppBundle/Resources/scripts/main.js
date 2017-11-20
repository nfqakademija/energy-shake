

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
})