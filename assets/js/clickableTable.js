const $ = require("jquery");
$(function() {
    $("table tbody tr").click(function(e) {
        const u = $(this).data("link");
        const t = $(this).data("target");
        if (t.length) {
            window.open(u, t);
        } else {
            window.location.href = u;
        }
    });
});
