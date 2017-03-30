$('#LawyerCityId').select2();
$('#LawyerFieldId').select2();

$(document).ready(function () {
    search();
});
function search() {
    var sk = $('#skip').val();
    var ps = $('#pagesize').val();
    var keywords = $('#Keywords').val();
    var cityId = $('#LawyerCityId').val();

    $('#list_result').html('<img id="searchLoading" src="/public/images/loading.gif" width="40" />');
    $.get("danh-ba-luat-su/tim-kiem.html", ({
        sk: sk,
        ps: ps,
        keywords: keywords,
        cityId:cityId
    }), function (data) {
        $('#list_result').html(data);
    });
}
function searchPaging(pageIndex) {
    pageIndex = pageIndex - 1;
    $('#skip').val(pageIndex * 10);
    search();
}

function OnLawyerSearchSuccess(data) {
    search();
}

function OnLawyerSearchFailure(data) {
    search();
}

function btnSearchClick() {
    $('#skip').val(0);
    search();
}