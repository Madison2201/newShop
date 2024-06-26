<?php

namespace shop\forms;

use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class CompositeForm extends Model
{
    private array $forms = [];

    abstract protected function internalForms(): array;

    public function load($data, $formName = null): bool
    {
        $success = parent::load($data, $formName);
        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                foreach ($form as $itemName => $itemForm) {
//                    $success = $this->loadInternal($data, $itemForm, $formName, $itemName) && $success;
                    $success = Model::loadMultiple($form, $data, $formName === null ? null : $name) && $success;
                }
            } else {
//                $success = $this->loadInternal($data, $form, $formName, $name) && $success;
                $success = $form->load($data, $formName !== '' ? null : $name) && $success;
            }
        }
        return $success;
    }

    private function loadInternal(array $data, Model $form, $formName, $name): bool
    {
        return $form->load($data, $formName !== '' ? null : $name);
    }

    public function validate($attributeNames = null, $clearErrors = true): bool
    {
        $parentNames = $attributeNames !== null ? array_filter((array)$attributeNames, 'is_string') : null;
        $success = parent::validate($parentNames, $clearErrors);
        foreach ($this->forms as $name => $item) {
            if (is_array($item)) {
                foreach ($item as $itemName => $itemForm) {
                    $innerNames = ArrayHelper::getValue($attributeNames, $itemName);
                    $success = $itemForm->validate($innerNames, $clearErrors) && $success;
                }
            } else {
                $innerNames = ArrayHelper::getValue($attributeNames, $name);
                $success = $item->validate($innerNames, $clearErrors) && $success;
            }
        }
        return $success;
    }

    public function __get($name)
    {
        if (isset($this->forms[$name])) {
            return $this->forms[$name];
        }
        return parent::__get($name);
    }

    public function __set($name, $value): void
    {
        if (in_array($name, $this->internalForms(), true)) {
            $this->forms[$name] = $value;
        } else {
            parent::__set($name, $value);
        }
    }

    public function __isset($name)
    {
        return isset($this->forms[$name]) || parent::__isset($name);
    }
}