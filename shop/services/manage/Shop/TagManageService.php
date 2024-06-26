<?php

namespace shop\services\manage\Shop;

use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\TagForm;
use shop\repositories\Shop\TagRepository;

class TagManageService
{
    private TagRepository $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
        return $tag;
    }

    public function edit(int $id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
    }

    public function remove(int $id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }
}