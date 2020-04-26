<?php


namespace app\controllers;


use app\models\MyCustomer;
use yii\web\Controller;

class CustomerController extends Controller
{
    public function actionIndex()
    {
        $customers = MyCustomer::find()->all();
        echo '<pre>';
        var_dump($customers);
        echo '/<pre>';
    }

    public function actionView($id)
    {
        MyCustomer::find()
            ->where("id=:id", [
                'id' => $id
            ])->one();
        $customer = MyCustomer::findOne($id);
    }

    public function actionSave()
    {
        $customer = new MyCustomer();
        $customer->username='Jean';
        $customer->email='jean@local.com';
        if($customer->save()) {
            echo '<pre>';
            var_dump("SUCCESS");
            echo '/<pre>';
        } else {
            echo '<pre>';
            var_dump("ERROR ", $customer->errors);
            echo '/<pre>';
        }
    }

    public function actionUpdate($id)
    {
        $customer = MyCustomer::findOne($id);
        $customer->email='test@local.com';

        if($customer->save()) {
            echo '<pre>';
            var_dump("SUCCESS");
            echo '/<pre>';
        } else {
            echo '<pre>';
            var_dump("ERROR ", $customer->errors);
            echo '/<pre>';
        }
    }

    public function actionDelete($id)
    {
        $customer = MyCustomer::findOne($id);

        if($customer->delete()) {
            echo '<pre>';
            var_dump("SUCCESS");
            echo '/<pre>';
        } else {
            echo '<pre>';
            var_dump("ERROR ", $customer->errors);
            echo '/<pre>';
        }
    }
}