<?php if (!empty($errors)) : ?>
    <p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </p>
<?php endif; ?>

<?php if (!empty($user)) : ?>
    <p>
        <form action="" method="post">
            <input type="hidden" id="idx" name="user[idx]" value="<?= $_SESSION['user_idx'] ?>">
            <ul>
                <li>
                    <label for="userId">아이디:</label>
                    <input type="text" id="userId" name="user[id]" value="<?= $_SESSION['id'] ?>" disabled>
                </li>

                <li>
                    <label for="password">패스워드:</label>
                    <input type="password" id="password" name="user[password]" value="">
                </li>

                <li>
                    <label for="name">이름:</label>
                    <input type="text" id="name" name="user[name]" value="<?= $user -> name ?? '' ?>">
                </li>

                <li>
                <label for="email">이메일:</label>
                <input type="text" id="email" name="user[email]" value="<?= $user -> email ?? '' ?>">
                </li>

                <li>
                    <label for="birth">생년월일:</label>
                    <input type="text" id="birth" name="user[birth]" value="<?= $user -> birth ?? '' ?>">
                </li>

                <li>
                    <label>성별:</label>
                    <input type="radio" id="genderChoice1" name="user[gender]" value="0" <?php if ($user -> gender == 0) { echo 'checked'; } ?>>
                    <label for="genderChoice1">선택안함</label>
                    <input type="radio" id="genderChoice2" name="user[gender]" value="1" <?php if ($user -> gender == 1) { echo 'checked'; } ?>>
                    <label for="genderChoice2">남</label>
                    <input type="radio" id="genderChoice3" name="user[gender]" value="2" <?php if ($user -> gender == 2) { echo 'checked'; } ?>>
                    <label for="genderChoice3">여</label>
                </li>

                <li>
                    <label for="phone">핸드폰번호:</label>
                    <input type="text" id="phone" name="user[phone]" value="<?= $user -> phone ?? '' ?>">
                </li>

                <li>
                    <input type="submit" value="회원정보수정">
                </li>
            </ul>
        </form>
    </p>
<?php endif; ?>