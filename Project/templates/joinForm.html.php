<?php if (!empty($errors)) : ?>
    <p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </p>
<?php endif; ?>

<p>
    <form action="" method="post">
        <ul>
            <li>
                <label for="userId">*아이디:</label>
                <input type="text" id="userId" name="user[user_id]" value="<?= $user['user_id'] ?? '' ?>"><br>
            </li>

            <li>
                <label for="password">*패스워드:</label>
                <input type="password" id="password" name="user[password]" value="<?= $user['password'] ?? '' ?>"><br>
            </li>

            <li>
                <label for="name">*이름:</label>
                <input type="text" id="name" name="user[name]" value="<?= $user['name'] ?? '' ?>"><br>
            </li>

            <li>
            <label for="email">*이메일:</label>
            <input type="text" id="email" name="user[email]" value="<?= $user['email'] ?? '' ?>"><br>
            </li>

            <li>
                <label for="birth">*생년월일:</label>
                <input type="text" id="birth" name="user[birth]" value="<?= $user['birth'] ?? '' ?>"><br>
            </li>

            <li>
                <label>성별:</label>
                <input type="radio" id="genderChoice1" name="user[gender]" value="0" checked>
                <label for="genderChoice1">선택안함</label>
                <input type="radio" id="genderChoice2" name="user[gender]" value="1">
                <label for="genderChoice2">남</label>
                <input type="radio" id="genderChoice3" name="user[gender]" value="2">
                <label for="genderChoice3">여</label><br>
            </li>

            <li>
                <label for="phone">*핸드폰번호:</label>
                <input type="text" id="phone" name="user[phone]" value="<?= $user['phone'] ?? '' ?>"><br>
            </li>

            <li>
                <input type="submit" value="회원가입">
            </li>
        </ul>
    </form>
</p>