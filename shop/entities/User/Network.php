<?php

namespace shop\entities\User;

use Webmozart\Assert\Assert;
use yii\db\ActiveRecord;

/**
 * @property $user_id
 * @property $network
 * @property $identity
 **/
class Network extends ActiveRecord
{
    public static function create($network, $identity): self
    {
        Assert::NotEmpty($network);
        Assert::NotEmpty($identity);

        $item = new static();
        $item->network = $network;
        $item->identity = $identity;
        return $item;
    }

    public static function tableName()
    {
        return '{{%user_networks}}';
    }

    public function isFor($network, $identity): bool
    {
        return $this->network === $network && $this->identity === $identity;
    }
}