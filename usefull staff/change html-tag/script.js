    $(function() {
        $('h3').replaceWith(function() {
            return "<div>" + $(this).text() + "</div>";
        });
    });
// или так 
// отставляет весь внутренний контент с вложенными html-тегами
    $(function() {
        $('h3').replaceWith(function() {
            return "<div>" + $(this).html() + "</div>";
        });
    });
