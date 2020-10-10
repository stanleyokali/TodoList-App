<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

//namespace
use app\models\Info;
use app\models\Wikipedia;
use app\models\EntryForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(array('todo/index'));
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    public function actionInfo() {

        $callModel = new Info();

        if ($callModel->load(Yii::$app->request->post())) {

            $callModel->save(false);

             Yii::$app->session->setFlash("success", "Date inserted sucessfully");
            return $this->redirect(['site/getcalls']);
        }
        //passing data to the view
        return $this->render('call', [
            'model' => $callModel
        ]);
    }
    public function actionGetcalls(){
        
        $callData = Info::find()->all();

        return $this->render('callView', [
            'info' => $callData
        ]);
    }
    

    public function actionWikipedia() {      //wikipedia =name of table// not neccesarily name of the table

        $callModel = new Wikipedia();        //wikipedia here is the name of the model

        if ($callModel->load(Yii::$app->request->post())) {

            $callModel->save(false);    // this saves your data to the database

             Yii::$app->session->setFlash("success", "Data inserted sucessfully");  // shows a flash message
            return $this->redirect(['site/getwikipedia']);   // redirects to your wikiview
        }
        //passing data to the view
        return $this->render('wikicall', [   // wikicall name of site name
            'model' => $callModel
        ]);
    }

    public function actionGetwikipedia(){
        
        $callData = Wikipedia::find()->all();

        return $this->render('wikiview', [   //name of site view 
            'wikipedia' => $callData        // $calldata = random variable ,,, wikipedia name of model 
        ]);
    }
    




    public function actionEntry()
    {
        $appmodel = new EntryForm();

        if ($appmodel->load(Yii::$app->request->post())) {
            // valid data received in $model
            $appmodel->save(false);
            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $appmodel]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $appmodel]);
        }
    }
      
    public function actionRegister()
    {
        $user = new User();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()) {
                // Save Record
                $user->save();
                //send message
                yii::$app->getSession()->setFlash('success', 'You are Registered');

                return $this->redirect(array('site/index'));
            }
        }

        return $this->render('register', [
            'user' => $user,
        ]);
    }



}


