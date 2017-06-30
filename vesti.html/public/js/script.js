$(document).ready(function () {
    var ar = [];
    $('.photo-item > img').each(function () {
        ar.push($(this).height());
    });
    if (ar[0] >= ar[1]) {
        $('.photo-item > img').each(function () {
            $(this).height(ar[0]);
        });
    }
    else {
        $('.photo-item > img').each(function () {
            $(this).height(ar[1]);
        });
    }
    if ($(window).width() > 991) {
        if ($('.sidebar-container').height() < $('aside').prev().height()) {
            $('.sidebar-container').height($('aside').prev().height());
        }
    }
});
$(window).resize(function () {
    $('.photo-item > img').each(function () {
        $(this).height('auto');
    });
    var ar = [];
    $('.photo-item > img').each(function () {
        ar.push($(this).height());
    });
    if (ar[0] >= ar[1]) {
        $('.photo-item > img').each(function () {
            $(this).height(ar[0]);
        });
    }
    else {
        $('.photo-item > img').each(function () {
            $(this).height(ar[1]);
        });
    }
    if ($(window).width() > 991) {
        if ($('.sidebar-container').height() < $('aside').prev().height()) {
            $('.sidebar-container').height($('aside').prev().height());
        }
    }
    else {
        $('.sidebar-container').height('auto');
    }
});


function myFunction() {
    var x = document.getElementById('nav-links');
    if (x.className === "nav-links") {
        var anchors = $('#nav-links a:not(:last-child)');
        anchors.each(function (index) {
            if ($(this).css('display') == 'none') {
                $(this).addClass('show-hidden-item');
            }
            else {
                $(this).removeClass('show-hidden-item');
            }
        });
        if ($('.menu-links').css('display') === 'none') {
            var clone = $('.menu-links').clone(true);
            $('.topnav').parent().append(clone);
            clone.attr('class', 'menu-links-mob');
            $('.menu-links-mob').css('display', 'block');
        }

        $('.show-hidden-item').wrapAll('<div class = "show-hidden-menu">');
        var elems = $('.show-hidden-menu');
        $('.topnav').parent().append(elems);
        x.className += " responsive";

    } else {
        x.className = "nav-links";
        var anchors = $('.show-hidden-menu a');
        $('#nav-links a:last-child').before($(".show-hidden-menu"));
        $('.show-hidden-item').unwrap();
        anchors.each(function (index) {
            if ($(this).css('display') == 'block') {
                $(this).removeClass('show-hidden-item');
            }

        });
        $('.menu-links-mob').remove();
        // $('.menu-links').css('display', "");
        // $('.nav-links').before($('.menu-links-mob'));
        // $('.menu-links-mob').css('display', 'none');
        // $('.menu-links-mob').attr('class', 'menu-links');
    }
}

