<?php
/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var LogSearch $searchModel
 */

use app\grid\DateTimeRangeColumn;
use app\grid\GridView;
use app\grid\IdColumn;
use app\grid\Select2Column;
use app\models\Client;
use app\models\Log;
use app\models\search\LogSearch;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Logs';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];

?>

<?php
Pjax::begin() ?>
<div class="table-responsive user-index">
    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'class' => IdColumn::class,
                    'isLink' => false,
                ],
                [
                    'attribute' => 'user_id',
                    'class' => Select2Column::class,
                    'filter' => User::getList(),
                    'isWithNull' => false,
                    'isWithNotNull' => false,
                    'filterWidgetOptions' => [
                        'options' => ['multiple' => true],
                    ],
                    'value' => static function (Log $log) {
                        return Html::a($log->user, ['/user/index', 'UserSearch[id]' => $log->user_id]);
                    },
                ],
                [
                    'attribute' => 'client_id',
                    'label' => 'Client',
                    'format' => 'html',
                    'class' => Select2Column::class,
                    'filter' => Client::getList(),
                    'isWithNull' => false,
                    'isWithNotNull' => false,
                    'filterWidgetOptions' => [
                        'options' => ['multiple' => true],
                    ],
                    'value' => static function (Log $log) {
                        $user = $log->user;
                        return Html::a($user->client, ['/client/index', 'ClientSearch[id]' => $user->client_id]);
                    },
                ],
                [
                    'attribute' => 'startdate',
                    'class' => DateTimeRangeColumn::class,
                ],
                [
                    'attribute' => 'enddate',
                    'class' => DateTimeRangeColumn::class,
                ],
            ],
        ]
    ) ?>
    <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]) ?>
</div>
<?php
Pjax::end() ?>
