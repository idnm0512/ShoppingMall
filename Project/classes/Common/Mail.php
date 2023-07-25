<?php
    namespace Common;

    use PHPMailer\PHPMailer\PHPMailer;

    class Mail {

        public function sendMail() {
            require_once __DIR__ . '/../../lib/PHPMailer/src/PHPMailer.php';
            require_once __DIR__ . '/../../lib/PHPMailer/src/SMTP.php';
            require_once __DIR__ . '/../../lib/PHPMailer/src/Exception.php';

            /* gmail 계정 > 보안 > 보안 수준이 낮은 앱의 엑세스 사용으로 변경 필요 */

            $mail = new PHPMailer(true);

            // 서버세팅
            $mail -> SMTPDebug = 0;     // 디버깅 설정
            $mail -> isSMTP();          // SMTP 사용 설정

            $mail -> Host = gethostbyname('smtp.gmail.com');    // email 보낼때 사용할 서버를 지정
            $mail -> SMTPAuth = true;                           // SMTP 인증을 사용함
            $mail -> Username = 'idnm0512@gmail.com';           // 메일 계정
            $mail -> Password = 'wiepmmvnxbayvdmv';             // 앱 비밀번호
            $mail -> SMTPSecure = 'ssl';                        // SSL을 사용함
            $mail -> Port = 465;                                // email 보낼때 사용할 포트를 지정
            $mail -> CharSet = 'utf-8';                         // 문자셋 인코딩

            // 보내는 메일
            $mail -> setFrom('idnm0512@gmail.com', '쇼핑몰');

            // 받는 메일
            $mail -> addAddress($_POST['email'], '회원님');

            // 메일 내용
            $mail -> isHTML(true);                     // HTML 태그 사용 여부
            $mail -> Subject = '메일 제목 테스트';      // 메일 제목
            // $mail -> AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/static/images/mail/logo.png', 'logo');
            // $mail -> Body = '메일 내용 테스트<img src="cid:logo">';

            // 랜덤한 인증번호 구현
            

            $mail -> Body = '메일 내용 테스트';

            // Gmail로 메일을 발송하기 위해서는 CA인증이 필요하다.
            // CA 인증을 받지 못한 경우에는 아래 설정하여 인증체크를 해지해야 한다.
            $mail -> SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false
                    , 'verify_peer_name' => false
                    , 'allow_self_signed' => true
                )
            );

            // 메일 전송
            if (!$mail->send()) throw new \Exception('일시적인 오류가 발생했습니다. 잠시후 다시 시도해주세요.');
        }
    }