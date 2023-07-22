<?php
    use Common\EntryPoint;
    use ShoppingMall\ShoppingMallUri;

    try {
        include __DIR__ . '/../includes/Autoload.php';

        $request_uri = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        $request_method = $_SERVER['REQUEST_METHOD'];

        $entryPoint = new EntryPoint(new ShoppingMallUri(), $request_uri, $request_method);

        $entryPoint -> run();

    } catch (PDOException $e) {
        $title = 'Error';

        $output = '데이터베이스 서버에 접속할 수 없습니다.'
            . '<br>내용: ' . $e -> getMessage()
            . '<br>위치: ' . $e -> getFile()
            . '<br>라인: ' . $e -> getLine();
        
        include __DIR__ . '/../templates/layout.html.php';
    }