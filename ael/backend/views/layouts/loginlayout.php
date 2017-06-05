<?php

/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../../backend/web/loginback.jpg'); background-repeat: no-repeat; background-position: center; ">
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container" style="padding-left: 414px;">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html
<?php $this->endPage() ?>

