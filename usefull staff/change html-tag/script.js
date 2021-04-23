    $(function() {
        $('h3').replaceWith(function() {
            return "<div>" + $(this).text() + "</div>";
        });
    });
//    Отставляет весь внутренний контент с вложенными html-тегами
    $(function() {
        $('h3').replaceWith(function() {
            return "<div>" + $(this).html() + "</div>";
        });
    });
