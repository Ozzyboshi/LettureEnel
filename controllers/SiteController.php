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
use app\models\PasswordForm;
use app\models\User;

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
                        'actions' => ['logout','changepassword'],
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
            $res=$res.",".$string."fascia".$i.",".$string."fascia".$i."-@".$string."fascia".$i."diff as ".$string."delta".$i.",round("."prezzofascia".$i."*(".$string."fascia".$i."-@".$string."fascia".$i."diff),2) as euro".$string.$i." ";
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

    private function orderByQueryPart()
    {
        if (isset ($_GET['sort']) && $_GET['sort']=="data") return "data";
        return "data desc";
    }

    public function actionIndex()
    {
        $query="select letture.id as id,data".$this->composeQueryPart1Full().$this->composeQueryPart2Full()." from letture left join prezzi on data between datainiziovalidita and datafinevalidita,(select @diff1=0".$this->composeQueryPart3Full().") as x order by ".$this->orderByQueryPart();
        $lettureActiverecord = new Letture();

        $dataProvider = new ActiveDataProvider([
            'query' => $lettureActiverecord::findBySql($query), 
            'sort' =>  ['attributes' => ['data']],
            'pagination' => [
                'pageSize' => 0,
            ],
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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDatalogger()
    {
        return $this->render('datalogger');
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

      public function actionChangepassword()
      {
        $model = new PasswordForm;
        $modeluser = User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();
      
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                try
                {
                    $modeluser->password = $_POST['PasswordForm']['newpass'];
                    if($modeluser->save())
                    {
                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        return $this->redirect(['index']);
                    }
                    else
                    {
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );
                        return $this->redirect(['index']);
                    }
                }
                catch(Exception $e)
                {
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('changepassword',[
                        'model'=>$model
                    ]);
                }
            }
            else
            {
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }
        else
        {
            return $this->render('changepassword',[
                'model'=>$model
            ]);
        }
    }
}
