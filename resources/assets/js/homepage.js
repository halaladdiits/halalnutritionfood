$('.productName').select2({
    width: '100%',
    tokenSeparators: [","],
    theme: "bootstrap",
    placeholder: "Click here and start typing to search.",
    ajax: {
        url: laroute.route('api.foodproduct.list'),
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
}).on("select2:select", function(e) {
    window.location.href = laroute.route('foodproduct.show', { foodproduct: e.params.data.id});
});
$('.additive').select2({
    width: '100%',
    tokenSeparators: [","],
    theme: "bootstrap",
    placeholder: "Click here and start typing to search.",
    ajax: {
        url: laroute.route('api.additive.list'),
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 2
}).on("select2:select", function(e) {
    window.location.href = laroute.route('additive.show', { additive: e.params.data.id});
});
