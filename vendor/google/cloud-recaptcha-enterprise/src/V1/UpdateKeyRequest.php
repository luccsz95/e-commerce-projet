<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/recaptchaenterprise/v1/recaptchaenterprise.proto

namespace Google\Cloud\RecaptchaEnterprise\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The update key request message.
 *
 * Generated from protobuf message <code>google.cloud.recaptchaenterprise.v1.UpdateKeyRequest</code>
 */
class UpdateKeyRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The key to update.
     *
     * Generated from protobuf field <code>.google.cloud.recaptchaenterprise.v1.Key key = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $key = null;
    /**
     * Optional. The mask to control which fields of the key get updated. If the
     * mask is not present, all fields are updated.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    protected $update_mask = null;

    /**
     * @param \Google\Cloud\RecaptchaEnterprise\V1\Key $key        Required. The key to update.
     * @param \Google\Protobuf\FieldMask               $updateMask Optional. The mask to control which fields of the key get updated. If the
     *                                                             mask is not present, all fields are updated.
     *
     * @return \Google\Cloud\RecaptchaEnterprise\V1\UpdateKeyRequest
     *
     * @experimental
     */
    public static function build(\Google\Cloud\RecaptchaEnterprise\V1\Key $key, \Google\Protobuf\FieldMask $updateMask): self
    {
        return (new self())
            ->setKey($key)
            ->setUpdateMask($updateMask);
    }

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\RecaptchaEnterprise\V1\Key $key
     *           Required. The key to update.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           Optional. The mask to control which fields of the key get updated. If the
     *           mask is not present, all fields are updated.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Recaptchaenterprise\V1\Recaptchaenterprise::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The key to update.
     *
     * Generated from protobuf field <code>.google.cloud.recaptchaenterprise.v1.Key key = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\RecaptchaEnterprise\V1\Key|null
     */
    public function getKey()
    {
        return $this->key;
    }

    public function hasKey()
    {
        return isset($this->key);
    }

    public function clearKey()
    {
        unset($this->key);
    }

    /**
     * Required. The key to update.
     *
     * Generated from protobuf field <code>.google.cloud.recaptchaenterprise.v1.Key key = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\RecaptchaEnterprise\V1\Key $var
     * @return $this
     */
    public function setKey($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\RecaptchaEnterprise\V1\Key::class);
        $this->key = $var;

        return $this;
    }

    /**
     * Optional. The mask to control which fields of the key get updated. If the
     * mask is not present, all fields are updated.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return \Google\Protobuf\FieldMask|null
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }

    public function hasUpdateMask()
    {
        return isset($this->update_mask);
    }

    public function clearUpdateMask()
    {
        unset($this->update_mask);
    }

    /**
     * Optional. The mask to control which fields of the key get updated. If the
     * mask is not present, all fields are updated.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

}

