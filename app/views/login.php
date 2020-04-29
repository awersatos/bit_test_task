<?php
/**
 * @var $error
 */
?>
<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <h1>Вход</h1>
        <form method="post">
            <div class="form-group">
                <label for="name">Логин</label>
                <input type="text" name="name" id="name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
        <?php if ($error) { ?>
            <div style="margin-top: 15px" class="alert alert-danger"><?= $error ?></div>
        <?php } ?>
    </div>
    <div class="col-sm"></div>
</div>

