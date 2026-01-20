$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var KTCardDraggable = function () {
    return {
    init: function () {
        var containers = document.querySelectorAll('.draggable-zone');
        console.log(containers[0]);
        console.log(containers);
        if (containers.length === 0) {
            return false;
        }

            var swappable = new Sortable.default(containers, {
                draggable: '.draggable',
                handle: '.draggable .draggable-handle',
                mirror: {
                appendTo: 'body',
                constrainDimensions: true
                }
        });
    }
    };
}();

jQuery(document).ready(function () {
    KTCardDraggable.init();
});
function goBack() {
    window.history.back();
}
