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
                <input type="text" id="userId" name="user[user_id]" value="<?= $user['user_id'] ?? '' ?>"><br>
            </li>

            <li>
                <label for="password">패스워드:</label>
                <input type="password" id="password" name="user[password]" value="<?= $user['password'] ?? '' ?>"><br>
            </li>

            <li>
                <input type="submit" value="로그인">
            </li>
            <!-- <input type="button" value="로그인" onclick="ajaxTest()"> -->
        </ul>
    </form>
</p>

<script>
    function ajaxTest() {

        $.ajax({
            
        });
    }
</script>