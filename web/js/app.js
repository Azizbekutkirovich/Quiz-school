$(window).on('load', function () {
    $(".loader").fadeOut();
    $("#preloder").delay(200).fadeOut("slow");
    $('.featured__controls li').on('click', function () {
        $('.featured__controls li').removeClass('active');
        $(this).addClass('active');
    });
    if ($('.featured__filter').length > 0) {
        var containerEl = document.querySelector('.featured__filter');
        var mixer = mixitup(containerEl);
    }
})
if (document.URL == "http://localhost/quiz-school/") {
    $('#home').addClass('active-link');
} else if (document.URL == "http://localhost/quiz-school/main/index") {
    $('#home').addClass('active-link');
} else if (document.URL == "http://localhost/quiz-school/main/settings") {
    $('#about').addClass('active-link');
} else if (document.URL == "http://localhost/quiz-school/users/results") {
    $('#info').addClass('active-link');
} else if (document.URL == "http://localhost/quiz-school/home") {
    $('#home').addClass('active-link');
} else if (document.URL == "http://localhost/quiz-school/settings") {
    $('#about').addClass('active-link');
} else if (document.URL == "http://localhost/quiz-school/results") {
    $('#info').addClass('active-link');
}