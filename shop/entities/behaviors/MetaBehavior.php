<?php

namespace shop\entities\behaviors;

use shop\entities\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class MetaBehavior extends Behavior
{

    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }


    public function onAfterFind(Event $event): void
    {
        $brand = $event->sender;
        $meta = Json::decode($brand->getAttribute('meta_json'));
        $brand->meta = new Meta($meta['title'], $meta['description'], $meta['keywords']);
    }

    public function onBeforeSave(Event $event): void
    {
        $brand = $event->sender;
        $brand->setAttribute('meta_json', Json::encode([
            'title' => $brand->meta->title,
            'description' => $brand->meta->description,
            'keywords' => $brand->meta->keywords,
        ]));
    }
}