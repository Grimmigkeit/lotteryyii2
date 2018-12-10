<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Lottery. You can win something big!';
$this->params['breadcrumbs'][] = $this->title;
$classConvert = $classRefuse = 'hidden';
if ($this->params['lottery']['money']) $classConvert = '';
if ($this->params['lottery']['money'] || $this->params['lottery']['prize'] || $this->params['lottery']['points']) $classRefuse = '';
?>

<div class="site-lottery">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>No, you can't.</p>
    
    <button href="#" class="lt-btn -random">Some random button. Press it!</button>

    <p class="result -result">
    	points: <span class="-points"><?= Html::encode($this->params['lottery']['points']) ?></span> <br>
    	money: <span class="-money"><?= Html::encode($this->params['lottery']['money']) ?></span> <br>
    	prize: <span class="-prize"><?= Html::encode($this->params['lottery']['prize']) ?></span> <br>
    </p>
    
    <button href="#" class="lt-btn -convert <?=$classConvert?>">Convert money to points</button>

    <button href="#" class="lt-btn -refuse <?=$classRefuse?>">Refuse prizes</button>
    
</div>