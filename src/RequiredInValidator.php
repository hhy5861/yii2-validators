<?php

namespace mike\validators;

use yii\validators\Validator;

/**
 * requiredIn Validator
 *
 * 多个字段都不能同时为空 。
 */
class RequiredInValidator extends Validator
{
    /**
     * @var bool 必验证
     */
    public $skipOnEmpty = false;

    /**
     * @var string 错误信息
     */
    public $message = '%s不能同时空。';

    /**
     * @var string slice ,
     */
    public $strict = ',';

    /**
     * Validates a single attribute.
     * Child classes must implement this method to provide the actual validation logic.
     * @param \yii\base\Model $model the data model to be validated
     * @param string $attribute the name of the attribute to be validated.
     */
    public function validateAttribute($model, $attribute)
    {
        $fields = [];
        $valid = false;

        foreach ($this->attributes as $attribute) {
            $fields[] = $attribute;
            if ($model->$attribute) {
                $valid = true;
            }
        }

        if ($valid === false) {
            $model->addError(null, sprintf($this->message, implode($this->strict, $fields)));
        }
    }
}
