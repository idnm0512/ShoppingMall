<?php
    namespace ShoppingMall\Controllers\User;

    use Common\DatabaseTable;

    class Find {
        
        private $userTable;

        public function __construct(DatabaseTable $userTable) {
            $this -> userTable = $userTable;
        }

        public function getFindIdForm() {
            return [
                'template' => 'findIdForm.html.php',
                'title' => '아이디 찾기'
            ];
        }

        public function getFindPwdForm() {
            return [
                'template' => 'findPwdForm.html.php',
                'title' => '패스워드 찾기'
            ];
        }

        public function findId() {
            $userReq = $_POST['user'];

            $errors = blankCheck($userReq);

            if (!empty($userReq['email'])) {
                if (filter_var($userReq['email'], FILTER_VALIDATE_EMAIL) == false) {
                    $errors[] = '이메일 형식이 올바르지 않습니다.';
                } else if (!count($this -> userTable -> findByColumn('email', $userReq['email'])) > 0) {
                    $errors[] = '유효하지 않은 이메일입니다.';
                }
            }

            if (empty($errors)) {
                // 이메일 인증 구현
                
                exit;
            } else {
                return [
                    'template' => 'findIdForm.html.php',
                    'title' => '아이디 찾기',
                    'variables' => [
                        'errors' => $errors,
                        'user' => $userReq
                    ]
                ];
            }
        }

        public function findPwd() {
            $userReq = $_POST['user'];

            $errors = blankCheck($userReq);

            if (!empty($userReq['id'])) {
                $userRes = $this -> userTable -> findByColumn('id', $userReq['id']);

                if (!empty($userReq['email'])) {
                    if (filter_var($userReq['email'], FILTER_VALIDATE_EMAIL) == false) {
                        $errors[] = '이메일 형식이 올바르지 않습니다.';
                    } else if ($userRes[0] -> email != $userReq['email']) {
                        $errors[] = '회원정보가 일치하지 않습니다.';
                    }
                }
            };

            if (empty($errors)) {
                // 이메일 인증 구현

                exit;
            } else {
                return [
                    'template' => 'findPwdForm.html.php',
                    'title' => '패스워드 찾기',
                    'variables' => [
                        'errors' => $errors,
                        'user' => $userReq
                    ]
                ];
            }
        }
    }