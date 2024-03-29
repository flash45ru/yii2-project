<?php


namespace console\models;

use Yii;

/**
 * author IF
 */
class Sender
{
    /**
     * @param array $subscribers
     * @param array $newsList
     */
    public static function run($subscribers, $newsList)
    {
        foreach ($subscribers as $subscriber) {
            $result = Yii::$app->mailer->compose('/mailer/newslist', [
                'newsList' => $newsList,
            ])
                ->setFrom(Yii::$app->params['sandServer'])
                ->setTo($subscriber['email'])
                ->setSubject('Тема сообщения')
                ->send();
        }
    }

}