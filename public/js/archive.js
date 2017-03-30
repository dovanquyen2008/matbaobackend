$(document).ready(function () {
    $('#map-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        //var modal = $(this);
        //modal.find('.modal-title').text('New message to ' + recipient);
        //modal.find('.modal-body input').val(recipient);
    });

    $('#tool-menu-bar').affix({
        offset: {
            top: function () {
                var offset = $('#tool-menu-bar').offset();
                return (this.top = offset.top)
            }
        }
    })
    $('#tool-menu-bar').on('affix.bs.affix', function () {
        $('#tool-menu-bar').width($('.tthc-detail').width());
    })

    $('#english').tooltip({
        'html': true,
        'title': 'Click để xem văn bản tiếng Anh',
        'placement': 'auto'
    })
    $('#schema').tooltip({
        'html': true,
        'title': 'Click để xem lược đồ văn bản',
        'placement': 'auto'
    })
    $('#rootarchive').tooltip({
        'html': true,
        'title': 'Click để xem văn bản gốc',
        'placement': 'auto'
    })
    
        
});
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}