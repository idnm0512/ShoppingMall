<?php if (!empty($errors)) : ?>
    <p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </p>
<?php endif; ?>

<p>
    <form action="" method="post">
        <ul>
            <li>
                <label for="email">이메일:</label>
                <input type="text" id="email" name="user[email]" value="<?= $user['email'] ?? '' ?>">
                <input type="button" id="snedMailButton" name="snedMailButton" value="인증번호발송" onclick="sendMailAjax()">
            </li>

            <li>
                <label for="authNumber">인증번호:</label>
                <input type="text" id="authNumber" name="user[auth_number]" value="<?= $user['auth_number'] ?? '' ?>">
            </li>

            <li>
                <input type="submit" value="아이디 찾기">
            </li>
        </ul>
    </form>
</p>

<script>
    function sendMailAjax() {
        var email = $("#email").val();

        // 이메일 유효성 검사 구현..
        

        $.ajax({
            type : "post",
            url : "/mail",
            dataType : "text",
            data : {
                "email" : email
            },
            success : function (result) {
                // console.log(result);

                alert("인증번호를 발송했습니다.\n확인 후 인증번호를 입력해주세요.");
            },
            error : function (request, status, error) {
                // console.log("code: " + request.status)
                // console.log("message: " + request.responseText)
                // console.log("error: " + error);

                alert("인증번호 발송을 실패했습니다.\n잠시후 다시 시도해주세요.");
            }
        });
    }
</script>