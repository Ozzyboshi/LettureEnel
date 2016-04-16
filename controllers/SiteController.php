<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use yii\data\ActiveDataProvider;
use app\models\Letture;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private function composeQueryPart1Full()
    {
        return $this->composeQueryPart1('consumo').$this->composeQueryPart1('produzione').$this->composeQueryPart1('immissione');
    }

    private function composeQueryPart3Full()
    {
        return $this->composeQueryPart3('consumo').$this->composeQueryPart3('produzione').$this->composeQueryPart3('immissione');
    }

    private function composeQueryPart2Full()
    {
        return $this->composeQueryPart2('consumo').$this->composeQueryPart2('produzione').$this->composeQueryPart2('immissione');
    }

    private function composeQueryPart1($string)
    {
        $res="";
        for ($i=1;$i<=3;$i++)
        {
            $res=$res.",".$string."fascia".$i.",".$string."fascia".$i."-@".$string."fascia".$i."diff as ".$string."delta".$i." ";
        }
        return $res;
    }

    private function composeQueryPart2($string)
    {
        $res="";
        for ($i=1;$i<=3;$i++)
        {
            $res=$res.","."@".$string."fascia".$i."diff:=".$string."fascia".$i;
        }
        return $res;
    }

    private function composeQueryPart3($string)
    {
        $res="";
        for ($i=1;$i<=3;$i++)
        {
            $res=$res.","."@".$string."fascia".$i."diff:=0";
        }
        return $res;
    }

    public function actionIndex()
    {


        $query="select id,data".$this->composeQueryPart1Full().$this->composeQueryPart2Full()." from letture,(select @diff1=0".$this->composeQueryPart3Full().") as x order by data";
        $lettureActiverecord = new Letture();
        

        

        $dataProvider = new ActiveDataProvider([
            //'query' => Letture::find()->orderBy('data desc'),
            'query' => $lettureActiverecord::findBySql($query), 
            'sort' => false
        ]);

        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}