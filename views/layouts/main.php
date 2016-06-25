<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Letture ENEL - via G. Degli Ubertini Arezzo',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $items = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Data logger', 'url' => ['/site/datalogger']],
            ];

            if (Yii::$app->user->isGuest)
            {
                $items[]=['label' => 'About', 'url' => ['/site/about']];
                $items[]=['label' => 'Login', 'url' => ['/site/login']];
            }
            else
            {
                $items[]=['label' => 'Prezzi', 'url' => ['/prezzi/index']];
                $items[]=['label' => 'Letture', 'url' => ['/letture/index']];
                $items[]=['label' => 'Bonifici GSE', 'url' => ['bonificigse/index']];
                $items[]=['label' => 'About', 'url' => ['/site/about']];
                $items[]=['label' => 'Cambia password', 'url' => ['/site/changepassword']];
                $items[]=['label' => 'Nuovo utente', 'url' => ['/site/signup']];
                $items[]=['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']];
            }
           
            if ( Yii::$app->user->can('permission_admin'))
              $items[]=['label' => 'Permissions', 'url' => ['/admin/assignment']];

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,

            ]);

            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-right">&copy; Ozzyboshi <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
