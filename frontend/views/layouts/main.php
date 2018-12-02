<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
//use frontend\assets\AppAsset;
use frontend\assets\ThemesAsset;
use frontend\assets\DatatablesAsset;
use rmrevin\yii\fontawesome\FA;
use common\widgets\Alert;

//AppAsset::register($this);
ThemesAsset::register($this);
DatatablesAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    
    <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="ระบบบริการดูแลสุขภาพผู้ป่วยที่บ้าน (Home Health Care Online) ">
    <meta name="KeyWords" content="Risk">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'HHC Online',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default ', //navbar-fixed-top
        ],
    ]);
    $menuItems = [
       // ['label' => FA::icon('home') . ' หน้าแรก', 'url' => ['/site/index']],
        ['label' => 'เมนูหลัก', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'ติดต่อ', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<footer class="footer">
                <?php $cc = Yii::$app->db->createCommand("SELECT COUNT(id) FROM session_frontend_user")->queryScalar(); ?>
      <div class="container">
            <?php
                $ver = file_get_contents(Yii::getAlias('@webroot/version/version.txt'));
                $ver = explode(',', $ver);
            ?>    
                <p class="pull-left">Copyright &copy; <?= date('Y') ?> <a href="#">HHC Online.</a> Developed By <?= Html::a('Wichian Nunsri', ['site/about']) ?>  <b>Version : <?= $ver[0] ?> </b> </p>
                <p class="pull-right">ผู้เยี่ยมชม <?= $cc;?> ครั้ง </p>
      </div>
</footer>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<style>
    ul,li,p,a,h1,h2,h3,h4,h5,h6,
    a.btn,button.btn,span,th,td,
    div,select{
       font-family: 'Prompt', sans-serif;
    }

</style>
