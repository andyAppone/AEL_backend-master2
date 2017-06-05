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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        
        <script src="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/pace/pace.min.js'); ?>" type="text/javascript"></script>
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/pace/themes/pace-theme-flash.css'); ?>" rel="stylesheet" type="text/css" />    
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/fullcalendar/fullcalendar.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/jqvmap.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/layout/css/layout.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/layout/css/themes/darkblue.min.css'); ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/layout/css/custom.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        
        
    <!-- END HEAD -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<?php $this->beginBody() ?>

<div class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
	<?php include 'header.php'; ?>
    
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <div class="page-container">
	<?php include 'beginsidebar.php'; ?>
        <?php //echo Breadcrumbs::widget([
            //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //]) ?>
        <?php //echo Alert::widget() ?>
        <?php echo $content ?>
	<?php include 'endsidebar.php'; ?>
    </div>
    <?php include 'footer.php'; ?>
    </div>
</div>
    
<?php //$this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jquery.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/bootstrap/js/bootstrap.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>       

<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/js.cookie.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jquery.blockui.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>     
    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/moment.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>     
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>     
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/morris/morris.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>     
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/morris/raphael-min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>     
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/counterup/jquery.waypoints.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    

<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/counterup/jquery.counterup.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/amcharts.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/serial.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/pie.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/radar.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/themes/light.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    

<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/themes/patterns.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>     
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amcharts/themes/chalk.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/ammap/ammap.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/ammap/maps/js/worldLow.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/amcharts/amstockcharts/amstock.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/fullcalendar/fullcalendar.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/horizontal-timeline/horizontal-timeline.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    

<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/flot/jquery.flot.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/flot/jquery.flot.resize.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>   
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/flot/jquery.flot.categories.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jquery.sparkline.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/jquery.vmap.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>  
    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/global/scripts/app.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/pages/scripts/dashboard.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    

<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/layout/scripts/layout.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/layout/scripts/demo.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/global/scripts/quick-sidebar.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    
<?php $this->registerJsFile(Yii::$app->urlManagerBackEnd->createUrl('/theme/layouts/global/scripts/quick-nav.min.js'),['depends' => [\yii\web\JqueryAsset::className()]]); ?>    

  


    
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->

    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
