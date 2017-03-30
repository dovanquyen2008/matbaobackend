$('#Field').select2();
$('#Type').select2();
$('#OrderType').select2();

$(document).ready(function () {
    
    $('#DatePromulgateFrom').datepicker({
        format: "dd/mm/yyyy",
        language: "vi"
    });
    $('#DatePromulgateTo').datepicker({
        format: "dd/mm/yyyy",
        language: "vi"
    });
    $('#DatePromulgateFrom').datepicker("setDate", new Date(1924, 07, 25));
    $('#DatePromulgateTo').datepicker("setDate", new Date());
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

    //$("input[name='FindType']").change(function(){
    //    if ($('.search-option').hasClass('search-option-close')) {
    //        $('.search-option').removeClass('search-option-close');
    //        $('.view-more').html('Thu gọn<i class="fa fa-chevron-circle-up"></i>');
    //    }
    //});
});
function btnSearchClick() {
    $('#Start').val(0);
    Search();
}

function Search()
{
    var _datePromulgateFrom = $("#DatePromulgateFrom").datepicker('getDate') != null ? $("#DatePromulgateFrom").datepicker('getDate').toJSON() : (new Date(0001, 01, 01)).toJSON();
    var _datePromulgateTo = $("#DatePromulgateTo").datepicker('getDate') != null ? $("#DatePromulgateTo").datepicker('getDate').toJSON() : (new Date()).toJSON();
    var query = $('#Keywords').val();
    var field = $('#Field').val();
    var start = $('#Start').val();
    var rows = $('#Rows').val();
    var type = $('#Type').val();
    var ordertype = $('#OrderType').val();
    var findtype = $('input[name=FindType]:checked', '#form_search').val();
    $.get("/van-ban-phap-luat/lay-ket-qua-tim-kiem.html", ({
        q: query,
        field: field,
        start: start,
        rows: rows,
        type: type,
        findType: findtype,
        datePromulgateFrom: _datePromulgateFrom,
        datePromulgateTo: _datePromulgateTo,
        orderType:ordertype
    }), function (data) {
        $('#list_result').html(data);
        if ($('#totalitem').val() == 0) {
            $('.paging-info').html('Không có kết quả nào được tìm thấy!');
        }
        else
        {
            $('.paging-info').html('Danh sách từ ' + (parseInt(start) + 1) + ' đến ' + (parseInt(start) + parseInt(rows)) + ' của &nbsp;<b id="total_item_result">' + $('#totalitem').val() + '</b> kết quả.');
        }
        $('[data-toggle="tooltip"]').tooltip()
    });
}
function searchPaging(pageIndex)
{
    pageIndex = pageIndex - 1;
    $('#Start').val(pageIndex * 10);
    Search();
    //$('#Rows').val(parseInt($('#Start').val()) + 10);
    //$('#form_search').submit();
}

function OnSearchSuccess(data) {
    btnSearchClick();
}

function OnSearchFailure(data) {

}
