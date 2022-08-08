<?php
/**
 * @var View $this
 * @var string $name
 * @var string $message
 * @var Exception|null $exception
 */

use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\web\View;

$this->title = $name;
?>
<div class="site-error">

    <?php
    if ($exception instanceof NotFoundHttpException) {
        echo $this->render('_error400', [
            'name' => $name,
            'message' => $message,
            'exception' => $exception,
        ]);
    } else {
        ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (YII_DEBUG && $exception) {
        echo Html::encode($exception->getMessage()) . ' <pre>' . $exception->getTraceAsString() . '</pre>';
        $exceptionPrevious = $exception->getPrevious();
        if ($exceptionPrevious) {
            echo Html::encode($exceptionPrevious->getMessage()) . ' <pre>' . $exceptionPrevious->getTraceAsString() . '</pre>';
        }
    }
    ?>

</div>
