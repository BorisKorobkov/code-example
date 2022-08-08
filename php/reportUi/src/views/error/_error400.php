<?php
/**
 * @var View $this
 * @var string $name
 * @var string $message
 * @var Exception|null $exception
 */

use yii\base\View;
use yii\helpers\Html;

$this->title = $name;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="alert alert-danger">
    <?= nl2br(Html::encode($message)) ?>
</div>
