<?php
/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var ClientSearch $searchModel
 */

use app\grid\GridView;
use app\grid\IdColumn;
use app\grid\StringColumn;
use app\grid\YesNoColumn;
use app\models\Client;
use app\models\search\ClientSearch;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Clients';
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
                    'attribute' => 'active',
                    'class' => YesNoColumn::class,
                ],
                [
                    'label' => 'Total time, minutes',
                    'value' => static function (Client $client) {
                        return $client
                            ->getUsers()
                            ->joinWith('logs')
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
