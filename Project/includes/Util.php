<?php

    function blankCheck($parameters) {
        $errors = [];

        foreach ($parameters as $key => $value) {
            if (trim($value) == '') {
                $errors[] = $key . ' 값을 입력해주세요.';
            }
        }

        return $errors;
    }