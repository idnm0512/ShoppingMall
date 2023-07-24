<?php
    namespace Common;

    use Common\DatabaseTable;

    class Authentication {

        private $userTable;
        private $userIdColumnName;
        private $userPwdColumnName;
        
        public function __construct(DatabaseTable $userTable, string $userIdColumnName, string $userPwdColumnName) {
            session_start();

            $this -> userTable = $userTable;
            $this -> userIdColumnName = $userIdColumnName;
            $this -> userPwdColumnName = $userPwdColumnName;
        }

        public function login($userIdValue, $userPwdValue) {
            $userRes = $this -> userTable -> findByColumn($this -> userIdColumnName, $userIdValue);

            if (!empty($userRes) && password_verify($userPwdValue, $userRes[0] -> {$this -> userPwdColumnName})) {
                session_regenerate_id();

                $_SESSION['user_id'] = $userRes[0] -> {$this -> userIdColumnName};

                return true;
            } else {
                return false;
            }
        }
    }