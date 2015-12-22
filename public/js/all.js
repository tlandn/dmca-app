(function() {

    // Quickie PubSub
    var o = $({});
    $.subscribe = function() { o.on.apply(o, arguments) };
    $.unsubscribe = function() { o.off.apply(o, arguments) };
    $.publish = function() { o.trigger.apply(o, arguments) };


})();
(function() {

    // Async submit a form's input.
    var submitAjaxRequest = function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function() {
                $.publish('form.submitted', form);
            }
        });

        e.preventDefault();
    };

    // Forms marked with the "data-remote" attribute will submit via AJAX
    $('form[data-remote]').on('submit', submitAjaxRequest);

})();
(function() {

	$.subscribe('form.submitted', function() {
       $('.flash').fadeIn(500).delay(1000).fadeOut(500);
    });

})();
//# sourceMappingURL=all.js.map
