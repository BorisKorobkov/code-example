<?php
/**
 * @var View $this
 */

use yii\web\View;

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Report UI</h1>

        <p class="lead">Simple mode for white-collar workers. With <span style="text-decoration: line-through;">blackjack and hookers</span> 3d party libraries.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Clients</h2>

                <p>ID, name, active, total time.</p>

                <p><a class="btn btn-lg btn-success" href="/client">View grid</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Users</h2>

                <p>ID, name, client, total time</p>

                <p><a class="btn btn-lg btn-success" href="/user">View grid</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Logs</h2>

                <p>User, client, start date, end date</p>

                <p><a class="btn btn-lg btn-success" href="/log">View grid</a></p>
            </div>
        </div>

    </div>
</div>

