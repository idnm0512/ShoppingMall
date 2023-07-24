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
        <input type="hidden" id="idx" name="user[idx]" value="<?= $_SESSION['user_idx'] ?>">
        <input type="hidden" id="status" name="user[status]" value="0">
        <ul>
            <li>
                <label for="password">패스워드:</label>
                <input type="password" id="password" name="user[password]" value="">
            </li>

            <li>
                <input type="submit" value="회원탈퇴">
            </li>
        </ul>
    </form>
</p>