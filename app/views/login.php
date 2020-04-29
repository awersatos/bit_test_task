<?php
/**
 * @var $error
 */
?>
<form method="post">
    <label for="name">Логин</label>
    <input type="text" name="name" id="name" required>
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Войти</button>
</form>
<?php if($error) { ?>
    <span style="color: red;"><?= $error ?></span>
<?php } ?>
