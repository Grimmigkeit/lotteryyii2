<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Lottery. You can win something big!';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-lottery">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>No, you can't.</p>
    
    <button href="#" class="random-btn -random">Some random button. Press it!</button>

</div>
