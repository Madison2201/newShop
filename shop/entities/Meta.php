<?php

namespace shop\entities;
class Meta
{
    public string $title;
    public string $description;
    public string $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}