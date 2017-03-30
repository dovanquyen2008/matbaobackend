$(document).ready(function () {
    search();
});
function search()
{
    var sk = $('#skip').val();
    var ps = $('#pagesize').val();
    var curc = $('#curchar').val();
    var keywords = $('#Keywords').val();

    $('#list_result').html('<img id="searchLoading" src="/public/images/loading.gif" width="40" />');
    $.get("thuat-ngu-phap-ly/danh-sach-thuat-ngu-phap-ly.html", ({
        sk: sk,
        ps: ps,
        curc: curc,
        keywords:keywords
    }), function (data) {
        $('#list_result').html(data);
    });
}
function searchPaging(pageIndex) {
    pageIndex = pageIndex - 1;
    $('#skip').val(pageIndex * 10);
    search();
}

function characterClick(c)
{
    $('#curchar').val(c);
    $('ul.list-character>li>a').removeClass('selected');
    $('a.'+c).addClass('selected');
    search();
}

function OnSpecialSearchSuccess(data)
{
    search();
}

function OnSpecialSearchFailure(data) {
    search();
}

function btnSearchClick() {
    $('#skip').val(0);
    search();
}