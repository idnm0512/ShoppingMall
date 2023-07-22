<?php
    namespace ShoppingMall\Controller;

    class Home {

        public function home(): Array {
            $variablesTestArr = [
                'test1' => '현재는 배열로 테스트',
                'test2' => '객체로 변경 예정'
            ];

            $result = [
                'template' => 'home.html.php',
                'title' => 'Home',
                'variables' => [
                    'variablesTestArr' => $variablesTestArr
                ]
            ];

            return $result;
        }
    }