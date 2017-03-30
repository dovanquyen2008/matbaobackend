$('#LinhVuc').select2();
$('#CoQuanBanHanh').select2();
$('#OrderType').select2();

$(document).ready(function () {
    Search();
    
    $('.view-more').click(function() {
        if($('.search-option').hasClass('search-option-close'))
        {
            $('.search-option').removeClass('search-option-close');
            $('.view-more').html('Thu gọn<i class="fa fa-chevron-circle-up"></i>');
        }
        else{
            $('.search-option').addClass('search-option-close');
            $('.view-more').html('Tìm kiếm nâng cao<i class="fa fa-chevron-circle-down"></i>');
        }
    });

    $('#form_search').keypress(function (e) {
        if (e.which == 13) {
            btnSearchClick();
            e.preventDefault();
        }
    });

});
function btnSearchClick() {
    $('#Start').val(0);
    Search();
}

function Search()
{
    var query = $('#Keywords').val();
    var linhvuc = $('#LinhVuc').val();
    var start = $('#Start').val();
    var rows = $('#Rows').val();
    var cqbh = $('#CoQuanBanHanh').val();
    
    var findtype = $('input[name=FindType]:checked', '#form_search').val();
    $.get("/thu-tuc-hanh-chinh/lay-ket-qua-tim-kiem.html", ({
        q: query,
        linhvuc: linhvuc,
        start: start,
        rows: rows,
        coquanbanhanh: cqbh,
        findType: findtype
    }), function (data) {
        $('#list_result').html(data);
        if ($('#totalitem').val() == 0) {
            $('.paging-info').html('Không có kết quả nào được tìm thấy!');
        }
        else
        {
            $('.paging-info').html('Danh sách từ ' + (parseInt(start) + 1) + ' đến ' + (parseInt(start) + parseInt(rows)) + ' của &nbsp;<b id="total_item_result">' + $('#totalitem').val() + '</b> kết quả.');
        }
        $('[data-toggle="tooltip"]').tooltip();
    });
}
function searchPaging(pageIndex)
{
    pageIndex = pageIndex - 1;
    $('#Start').val(pageIndex * 10);
    Search();
    
}

function OnSearchTTHCSuccess(data) {
    btnSearchClick();
}

function OnSearchTTHCFailure(data) {

}
