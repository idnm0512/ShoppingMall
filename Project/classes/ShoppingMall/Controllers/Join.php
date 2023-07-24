<?php
    namespace ShoppingMall\Controllers;

    use Common\DatabaseTable;

    class Join {
        
        private $userTable;

        public function __construct(DatabaseTable $userTable) {
            $this -> userTable = $userTable;
        }

        public function joinForm() {
            return [
                'template' => 'joinForm.html.php',
                'title' => '회원가입'
            ];
        }

        public function saveUser() {
            $userReq = $_POST['user'];

            $valid = true;
            $errors = [];

            if (empty($userReq['user_id'])) {
                $valid = false;
                $errors[] = '아이디를 입력하세요.';
            } else {
                if (count($this -> userTable -> findByColumn('user_id', $userReq['user_id'])) > 0) {
                    $valid = false;
                    $errors[] = '이미 존재하는 아이디입니다.';
                };
            }

            if (empty($userReq['password'])) {
                $valid = false;
                $errors[] = '패스워드를 입력하세요.';
            }

            if (empty($userReq['name'])) {
                $valid = false;
                $errors[] = '이름을 입력하세요.';
            }

            if (empty($userReq['email'])) {
                $valid = false;
                $errors[] = '이메일을 입력하세요.';
            } else if (filter_var($userReq['email'], FILTER_VALIDATE_EMAIL) == false) {
                $valid = false;
                $errors[] = '유효하지 않은 이메일입니다.';
            }

            if (empty($userReq['birth'])) {
                $valid = false;
                $errors[] = '생년월일을 입력하세요.';
            }

            if (empty($userReq['phone'])) {
                $valid = false;
                $errors[] = '핸드폰번호를 입력하세요.';
            }

            if ($valid == true) {
                $userReq['password'] = password_hash($userReq['password'], PASSWORD_DEFAULT);

                $this -> userTable -> save($userReq);

                header('location: /user/join');
            } else {
                return [
                    'template' => 'joinForm.html.php',
                    'title' => '회원가입',
                    'variables' => [
                        'errors' => $errors,
                        'user' => $userReq
                    ]
                ];
            }
        }
    }