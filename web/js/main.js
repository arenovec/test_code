function isset(accessor) {
    try {
        // Note we're seeing if the returned value of our function is not
        // undefined
        return typeof accessor() !== 'undefined'
    } catch (e) {
        // And we're able to catch the Error it would normally throw for
        // referencing a property of undefined
        return false
    }
}

/**
 *  Прокрутка после неудачной валидации
 */
$("form").on("afterValidate", function (event, messages) {
    if (typeof $(".has-error").first().offset() !== "undefined") {
        $("html, body").animate({
            scrollTop: $(".has-error").first().offset().top - 85
        }, 1000);
    }
});

