<?php
/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 */

use app\grid\GridView;
use app\grid\IdColumn;
use app\grid\Select2Column;
use app\grid\StringColumn;
use app\models\Client;
use app\models\search\UserSearch;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Users';
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
                    'attribute' => 'name',
                    'class' => StringColumn::class,
                ],
                [
                    'attribute' => 'client_id',
                    'class' => Select2Column::class,
                    'filter' => Client::getList(),
                    'isWithNull' => false,
                    'isWithNotNull' => false,
                    'filterWidgetOptions' => [
                        'options' => ['multiple' => true],
                    ],
                    'value' => static function (User $user) {
                        return Html::a($user->client, ['/client/index', 'ClientSearch[id]' => $user->client_id]);
                    },
                ],
                [
                    'label' => 'Total time, minutes',
                    'value' => static function (User $user) {
                        return $user
                            ->getLogs()
                            ->andWhere(['<=', 'log.startdate', new yii\db\Expression('log.enddate')]) # Idiot-proof
                            ->sum('TIMESTAMPDIFF(MINUTE, log.startdate, log.enddate)');
                    },
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
