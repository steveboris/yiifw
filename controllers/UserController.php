<?php


namespace app\controllers;


use yii\db\Connection;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        // etablish connection with the
        $db = \Yii::$app->db;
        // query to get all users
        $users = $db->createCommand("SELECT * FROM user")->queryAll();
        // var_dump the output
        echo '<pre>';
        var_dump($users);
        echo '</pre>';
        return "List of users";
    }

    public function actionView($id)
    {
        $db = \Yii::$app->db;
        // query to get all users
        $user = $db->createCommand("SELECT * FROM user WHERE id = :id")
            ->bindValue('id', $id) // bind the value of the with receive in parameter for the best practice
            ->queryOne();
        /* Or for bind multiple params
         *  $user = $db->createCommand("SELECT * FROM user WHERE id = :id AND username = :username")
            ->bindValues([
                'id' => $id,
                'username' => $username
            ])
            ->queryOne();
         */
        // var_dump the output
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
    }

    public function actionCreate()
    {
        $db = \Yii::$app->db;

        // insert only one item
        $db->createCommand()->insert('user', [
            'username' => 'yii4',
            'email' => 'yii4@local.com',
            'status' => 1
        ])->execute();

        // By the way to install many user with the same command
        /*$db->createCommand()->batchInsert('user', ['username', 'email', 'status'], [
            [
                'username' => 'yii5',
                'email' => 'yii5@local.com',
                'status' => 1
            ],
            [
                'username' => 'yii6',
                'email' => 'yii6@local.com',
                'status' => 1
            ],
        ])->execute();*/

        return "user created";
    }

    public function actionUpdate()
    {
        $db = \Yii::$app->db;
        $db->createCommand()->update('user', [
            'email' => 'yii6@local.com' // column to be updated
        ], [
            'id' => 5 // condition
        ])->execute();
        return "User updated";
    }

    public function actionDelete($id)
    {
        $db = \Yii::$app->db;
        $db->createCommand()->delete('user', 'id = :id', [
            'id' => $id
        ])->execute();
        return "User deleted";
    }

    public function actionUpsert()
    {
        // Method that trying to insert data in the db by if the data already exists this will just update it
        $db = \Yii::$app->db;

        $db->createCommand()->upsert('user',[
            'username' => 'yii3',
            'email' => 'yii3@local.com'
        ], [
            'email' => 'new@local.com'
        ])->execute();
    }

    public function actionQuoting()
    {
        // method that help to framework to recognize what are the columns and what are tables.
        // for example: SELECT username FROM user will be resolve to SELECT `username` FROM `user`
        $db = \Yii::$app->db;
        $db->createCommand("SELECT IFNULL([[email]], [[username]]) FROM {{user}}")->execute();
        // add the symbol % from each table name to read table with the prefixTable if defining
        // for example: if {{%user}} and the table prefix is 'tbl_' than this will resolve to tbl_user
        // The good practice is to use this way to write the code
    }
}