<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 */
class Review extends ActiveRecord
{
    public static function create(int $userId, int $vote, string $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = false;
        return $review;
    }

    public function edit(int $vote, string $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    public function isActive(): bool
    {
        return $this->active === true;
    }

    public function getRating(): int
    {
        return $this->vote;
    }

    public function isIdEqualTo(int $id): bool
    {
        return $this->id === $id;
    }

    public static function tableName(): string
    {
        return "{{%shop_reviews}}";
    }
}