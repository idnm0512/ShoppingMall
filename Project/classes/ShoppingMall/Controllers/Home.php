<?php
    namespace ShoppingMall\Controllers;

    class Home {

        public function home() {
            $result = [
                'template' => 'home.html.php',
                'title' => '홈'
            ];

            return $result;
        }
    }