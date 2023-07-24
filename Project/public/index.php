<?php
    use Common\EntryPoint;
    use ShoppingMall\ShoppingMallUri;

    try {
        include __DIR__ . '/../includes/Autoload.php';
        include __DIR__ . '/../includes/Util.php';

        $reqUri = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

        $entryPoint = new EntryPoint(new ShoppingMallUri(), $reqUri, $_SERVER['REQUEST_METHOD']);

        $entryPoint -> run();

    } catch (PDOException $e) {
        $title = 'Error';

        $output = 'Error'
            . '<br>내용: ' . $e -> getMessage()
            . '<br>위치: ' . $e -> getFile()
            . '<br>라인: ' . $e -> getLine();
        
        include __DIR__ . '/../templates/layout.html.php';
    }