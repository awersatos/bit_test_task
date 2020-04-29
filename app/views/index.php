<?php
/**
 * @var $user
 * @var $message
 */
?>
<div>Пользователь: <?= $user->name ?></div>
<div>Баланс: <?= round((float)$user->balance, 2) ?></div>
<form method="post">
    <label for="amount">Сумма для списания</label>
    <input type="number" name="amount" id="amount" required min="0.01" step="0.01">
    <button type="submit">Списать</button>
</form>
<?php if(is_array($message)) { ?>
    <div style="color: <?= ($message['type'] == 'success') ? 'green' : 'red' ?>" >
        <?= $message['text'] ?>
    </div>
<?php } ?>
