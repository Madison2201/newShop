<?php

namespace shop\helpers;

use shop\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelper
{
    public static function statusList(): array
    {
        return [
            User::STATUS_ACTIVE => 'Activate',
            User::STATUS_INACTIVE => 'Inactive',
            User::STATUS_DELETE => 'Delete',
        ];
    }

    public static function statusName(int $status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel(int $status): string
    {
        switch ($status) {
            case User::STATUS_ACTIVE:
                $class = 'badge badge-success';
                break;
            case User::STATUS_INACTIVE:
                $class = 'badge badge-secondary';
                break;
            default:
                $class = 'badge badge-danger';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class
        ]);
    }
}