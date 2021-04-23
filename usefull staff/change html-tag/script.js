    $(function() {
        $('h3').replaceWith(function() {
            return "<div>" + $(this).text() + "</div>";
        });
    });