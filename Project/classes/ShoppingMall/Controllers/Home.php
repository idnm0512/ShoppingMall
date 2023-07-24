<?php
    namespace ShoppingMall\Controllers;

    class Home {

        public function home() {
            return [
                'template' => 'home.html.php',
                'title' => '홈'
            ];
        }
    }