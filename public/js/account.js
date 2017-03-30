function OnRegisterSuccess(data) {
    $('#registerLoading').hide();
    $('#register_submit').show();
    if (data.ErrorType == 3)
        alert('Mã bảo vệ không đúng!');
    else if (data.ErrorType == 2)
        alert('Thông tin không hợp lệ, vui lòng kiểm tra lại!');
    else if (data.ErrorType == 1)
        alert('Tạo tài khoản lỗi, vui lòng thử lại!');
    else location.href = "/thanh-vien/kich-hoat-tai-khoan.html";
}

function OnRegisterFailure(ajaxContext) {
    alert("Có lỗi hệ thống xảy ra, vui lòng thử lại!");
    $('#registerLoading').hide();
    $('#register_submit').show();
}

function OnLoginFailure(ajaxContext) {
    alert("Có lỗi hệ thống xảy ra, vui lòng thử lại!");
    $('#LoginLoading').hide();
    $('#btn_login_submit').show();
}

function OnLoginSuccess(data) {
    $('#LoginLoading').hide();
    $('#btn_login_submit').show();
    if (data.ErrorType == 1)
        alert('Tên đăng nhập hoặc mật khẩu không đúng!');
    else if (data.ErrorType == 2)
        {
        alert('Tài khoản chưa được kích hoạt!');
        location.href = "/thanh-vien/lay-lai-ma-kich-hoat-tai-khoan.html";
    }
    else if (data.ErrorType == 3)
        alert('Tài khoản đang tạm khóa, vui lòng liên hệ tổng đài để được giải quyết!');
    else location.href = location.href;
}

function submitLogin()
{
    if ($("#form-login").valid())
    {
        $('#btn_login_submit').hide();
    }
}

function submitRegister() {
    if ($("#form-register").valid()) {
        $('#register_submit').hide();
    }
}

function OnActiveAccountSuccess(data) {
    $('#ActiveAccountLoading').hide();
    $('#active_submit').show();
    if (data.ErrorType == 0) {
        alert('Tài khoản đã được kích hoạt!');
        location.href = "/";
    }
    else if(data.ErrorType == 1)
    {
        alert("Mã xác nhận không đúng. Vui lòng kiểm tra lại!");
    }
    if (data.ErrorType == 2) {
        alert("Mã xác nhận đã hết hạn, vui lòng liên hệ ban quản trị để được hỗ trợ!");
    }
}

function OnActiveAccountFailure(ajaxContext) {
    alert("Có lỗi hệ thống xảy ra, vui lòng thử lại!");
    $('#ActiveAccountLoading').hide();
    $('#active_submit').show();
}

function OnResendCodeActiveAccountSuccess(data) {
    $('#ResendCodeActiveAccountLoading').hide();
    $('#resend_code_active_submit').show();
    if (data.ErrorType == 0) {
        alert('Mã xác nhận mới đã được gửi!');
        location.href = "/thanh-vien/kich-hoat-tai-khoan.html";
    }
    else {
        alert("Có lỗi hệ thống xảy ra, vui lòng thử lại!");
    }
}

function OnResendCodeActiveAccountFailure(ajaxContext) {
    alert("Có lỗi hệ thống xảy ra, vui lòng thử lại!");
    $('#ResendCodeActiveAccountLoading').hide();
    $('#resend_code_active_submit').show();
}