<?php
/**
 * @var $user
 * @var $message
 */
?>

<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <h1>Тестовое задание</h1>
        <div>Пользователь: <b><?= $user->name ?></b></div>
        <div>Баланс: <b><?= round((float)$user->balance, 2) ?></b></div>
        <form method="post">
            <div class="form-group">
                <label for="amount">Сумма для списания</label>
                <input type="number" name="amount" id="amount" required min="0.01" step="0.01" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Списать</button>
        </form>
        <?php if ($message) { ?>
            <div class="alert alert-danger" style="margin-top: 15px">
                <?= $message ?>
            </div>
        <?php } ?>
    </div>
    <div class="col-sm"><a href="/logout">Выход</a></div>
</div>
