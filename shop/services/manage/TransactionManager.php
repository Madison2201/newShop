<?php

namespace shop\services\manage;

class TransactionManager
{
    /**
     * @throws \Throwable
     */
    public function wrap(callable $function): void
    {
        \Yii::$app->db->transaction($function);
    }
}