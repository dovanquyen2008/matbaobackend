$('#FieldId').select2();
function OnCreateQuestionSuccess(data) {
    if (data.ErrorType == 1)
    {
        alert('Chưa chọn lĩnh vực.');
    }
    else if (data.ErrorType == 3) {
        alert('Mã bảo vệ chưa đúng.');
    }
    else if (data.ErrorType == 2) {
        alert('Dữ liệu chưa đúng.');
    }
    else if (data.ErrorType == 4) {
        alert('Có lỗi khi gửi câu hỏi, vui lòng thử lại.');
    }
    else if (data.ErrorType == 0) {
        alert('Câu hỏi đã được gửi và đang được kiểm duyệt.\nXin cảm ơn bạn đã sử dụng hệ thống NewMBN.');
        document.location = document.location.href;
    }
    $('#create_question_submit').show();
}

function OnCreateQuestionFailure(data) {

}

function submitCreateQuestion() {
    if ($("#form-create-question").valid()) {
        $('#create_question_submit').hide();
    }
}


function OnCreateAnswerSuccess(data) {
    if (data.ErrorType == 0) {
        alert('Câu trả lời đã được gửi và đang được kiểm duyệt.\nXin cảm ơn bạn đã sử dụng hệ thống NewMBN.');
        document.location = document.location.href;
    }
    else if (data.ErrorType == 1) {
        alert('Dữ liệu không hợp lệ, vui lòng thử lại.');
    }
    else if (data.ErrorType == 2) {
        alert('Có lỗi xảy ra khi gửi câu trả lời, vui lòng thử lại.');
    }
    $('#create_answer_submit').show();
}
function OnCreateAnswerFailure(data) {

}
function submitCreateAnswer() {
    if ($("#form-create-answer").valid()) {
        $('#create_answer_submit').hide();
    }
}

$(document).ready(function () {
    getAnswer();
});
function getAnswer()
{
    
    $.get("/tinh-huong-phap-luat/danh-sach-tra-loi.html", ({
        questionId: $('#QuestionId').val()
    }), function (data) {
        $('.list-answer').html(data);
    });
}