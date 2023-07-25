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
                <label for="userId">아이디:</label>
                <input type="text" id="userId" name="user[id]" value="<?= $user['id'] ?? '' ?>">
            </li>

            <li>
                <label for="email">이메일:</label>
                <input type="text" id="email" name="user[email]" value="<?= $user['email'] ?? '' ?>">
            </li>

            <li>
                <input type="submit" value="패스워드 찾기">
            </li>
        </ul>
    </form>
</p>