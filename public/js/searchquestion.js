$('#Field').select2();
function btnSearchClick() {
    $('#Start').val(0);
    Search();
}

$(document).ready(function () {
    Search();
});

function Search() {
    var query = $('#Keywords').val();
    var field = $('#Field').val();
    var start = $('#Start').val();
    var rows = $('#Rows').val();
    var findtype = $('input[name=FindType]:checked', '#form_search').val();
    $.get("/tinh-huong-phap-luat/lay-ket-qua-tim-kiem.html", ({
        q: query,
        field: field,
        start: start,
        rows: rows,
        findType: findtype
    }), function (data) {
        $('#list_result').html(data);
        if ($('#totalitem').val() == 0) {
            $('.paging-info').html('Không có kết quả nào được tìm thấy!');
        }
        else {
            var f = parseInt(start) + parseInt(rows);
            f = f > 10 ? f : $('#totalitem').val();
            $('.paging-info').html('Danh sách từ ' + (parseInt(start) + 1) + ' đến ' + f + ' của &nbsp;<b id="total_item_result">' + $('#totalitem').val() + '</b> kết quả.');
        }
        $('[data-toggle="tooltip"]').tooltip();
    });
}
function searchPaging(pageIndex) {
    pageIndex = pageIndex - 1;
    $('#Start').val(pageIndex * 10);
    Search();
}

function OnSearchQuestionSuccess(data) {
    btnSearchClick();
}

function OnSearchQuestionFailure(data) {

}
