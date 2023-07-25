<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">

    <!-- <link rel="stylesheet" href=".css"> -->
    
    <title><?= $title ?></title>
</head>
<body>
    <nav>
        <header>
            <h1>Test (header)</h1>
        </header>

        <ul>
            <li><a href="/">Home</a></li>
            <?php if (!empty($_SESSION['id'])) : ?>
                <li><a href="/user/info"><?= $_SESSION['id'] ?></a>님, ㅎㅇ</li>
                <li><a href="/user/logout">로그아웃</a></li>
                <li><a href="/user/withdraw">회원탈퇴</a></li>
            <?php else : ?>
                <li><a href="/user/login">로그인</a></li>
                <li><a href="/user/join">회원가입</a></li>
                <li><a href="/user/find-id">아이디 찾기</a> / <a href="/user/find-pwd">패스워드 찾기</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        Test (main)
        <?= $output ?>
    </main>

    <footer>
        Test (footer)
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>