<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MTMbiz Design Administrator</title>

    <link rel="icon" href="/resources/admin/favicon/favicon.ico">

    <link rel="stylesheet" href="/resources/admin/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/resources/admin/css/adminlte.css">
    <link rel="stylesheet" href="/resources/admin/css/style.css">

    <script src="/resources/admin/jquery/jquery.min.js"></script>
    <script src="/resources/admin/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/resources/admin/js/sb-admin-2.min.js"></script>
    <script src="/resources/admin/js/common.js"></script>
</head>

<body class="login-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg" style="margin-top:50%;">
                    <div class="card-body p-0">
                        <div class="login_top py-4">
                            <span>MTMbiz Design Administrator</span>
                        </div>
                        <div class="p-5">
                            <form class="user" method="post">
                                <div class="form-group pb-3">
                                    <input type="email" class="form-control form-control-user form-valid fv_empty" id="loginID" aria-describedby="emailHelp" title="아이디" placeholder="아이디를 입력하세요." />
                                </div>
                                <div class="form-group pb-4">
                                    <input type="password" class="form-control form-control-user form-valid fv_empty" id="loginPW" title="비밀번호" placeholder="비밀번호를 입력하세요." />
                                </div>
                                <button type="button" id="loginSubmit" class="btn btn-navy btn-block">로그인</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('/admin/include/_3_modal'); ?>
</body>

</html>

<script>
    $(function() {
        $("#loginSubmit").on("click", function(e) {
            e.preventDefault();
            certifySubmit();
        });

        $(document).on("keypress", function(e) {
            if (e.keyCode == 13) {
                certifySubmit();
            }
        });
    });

    function certifySubmit() {
        var form_data = {
            "loginID": $('#loginID').val(),
            "loginPW": $('#loginPW').val()
        };

        $.ajax({
            method: "POST",
            url: "/admin/login/loginSubmit",
            beforeSend: function(xhr, opts) {
                if (!formValidate()) xhr.abort();
            },
            data: form_data,
            success: function(data) {
                var result = JSON.parse(data);
                if (result.flag) {
                    location.href = "/admin/main/";
                } else {
                    $modal_alert("로그인 실패", result.message, function() {
                        $modal_hide();
                    });
                }
            }
        });
    }
</script>