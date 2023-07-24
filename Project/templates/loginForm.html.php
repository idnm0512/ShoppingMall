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
                <label for="password">패스워드:</label>
                <input type="password" id="password" name="user[password]" value="<?= $user['password'] ?? '' ?>">
            </li>

            <li>
                <input type="submit" value="로그인">
            </li>
        </ul>
    </form>
</p>