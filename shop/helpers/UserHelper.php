<?php

namespace shop\helpers;

use Exception;
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

    /**
     * @throws Exception
     */
    public static function statusName(int $status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @throws Exception
     */
    public static function statusLabel(int $status): string
    {
        $class = match ($status) {
            User::STATUS_ACTIVE => 'badge badge-success',
            User::STATUS_INACTIVE => 'badge badge-secondary',
            default => 'badge badge-danger',
        };
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class
        ]);
    }
}