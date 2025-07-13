// This file contains JavaScript code for interactive elements of the website, such as sliders, form validations, and other dynamic functionalities.

$(document).ready(function() {
    // Initialize the slider
    $('.slider-active').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
    });

    // Initialize nice select
    $('select').niceSelect();

    // Scroll to top functionality
    $('#back-top').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });

    // Preloader
    $(window).on('load', function() {
        $('#preloader-active').delay(200).fadeOut('slow');
    });

    // Form validation
    $('.search-box').validate({
        rules: {
            select: {
                required: true
            },
            returnAmount: {
                required: true,
                number: true
            }
        },
        messages: {
            select: "Please select an amount",
            returnAmount: {
                required: "Please enter the return amount",
                number: "Please enter a valid number"
            }
        }
    });
});