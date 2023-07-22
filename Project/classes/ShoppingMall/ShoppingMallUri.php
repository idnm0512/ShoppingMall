<?php
    namespace ShoppingMall;

    use Common\Uri;
    use ShoppingMall\Controller\Home;

    class ShoppingMallUri implements Uri {

        public function __construct() {
            include __DIR__ . '/../../includes/DatabaseConnection.php';


        }

        public function getUri(): Array {
            $homeController = new Home();

            $uri = [
                '' => [
                    'GET' => [
                        'controller' => $homeController,
                        'action' => 'home'
                    ]
                ]
            ];

            return $uri;
        }

        
    }