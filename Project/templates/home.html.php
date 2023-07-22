<ul>
    <?php foreach ($variablesTestArr as $key => $value) : ?>
        <li><?= $key ?> => <?= htmlspecialchars($value , ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>