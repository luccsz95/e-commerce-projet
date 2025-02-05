<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/recaptchaenterprise/v1/recaptchaenterprise.proto

namespace Google\Cloud\RecaptchaEnterprise\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Metrics related to scoring.
 *
 * Generated from protobuf message <code>google.cloud.recaptchaenterprise.v1.ScoreMetrics</code>
 */
class ScoreMetrics extends \Google\Protobuf\Internal\Message
{
    /**
     * Aggregated score metrics for all traffic.
     *
     * Generated from protobuf field <code>.google.cloud.recaptchaenterprise.v1.ScoreDistribution overall_metrics = 1;</code>
     */
    protected $overall_metrics = null;
    /**
     * Action-based metrics. The map key is the action name which specified by the
     * site owners at time of the "execute" client-side call.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.recaptchaenterprise.v1.ScoreDistribution> action_metrics = 2;</code>
     */
    private $action_metrics;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\RecaptchaEnterprise\V1\ScoreDistribution $overall_metrics
     *           Aggregated score metrics for all traffic.
     *     @type array|\Google\Protobuf\Internal\MapField $action_metrics
     *           Action-based metrics. The map key is the action name which specified by the
     *           site owners at time of the "execute" client-side call.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Recaptchaenterprise\V1\Recaptchaenterprise::initOnce();
        parent::__construct($data);
    }

    /**
     * Aggregated score metrics for all traffic.
     *
     * Generated from protobuf field <code>.google.cloud.recaptchaenterprise.v1.ScoreDistribution overall_metrics = 1;</code>
     * @return \Google\Cloud\RecaptchaEnterprise\V1\ScoreDistribution|null
     */
    public function getOverallMetrics()
    {
        return $this->overall_metrics;
    }

    public function hasOverallMetrics()
    {
        return isset($this->overall_metrics);
    }

    public function clearOverallMetrics()
    {
        unset($this->overall_metrics);
    }

    /**
     * Aggregated score metrics for all traffic.
     *
     * Generated from protobuf field <code>.google.cloud.recaptchaenterprise.v1.ScoreDistribution overall_metrics = 1;</code>
     * @param \Google\Cloud\RecaptchaEnterprise\V1\ScoreDistribution $var
     * @return $this
     */
    public function setOverallMetrics($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\RecaptchaEnterprise\V1\ScoreDistribution::class);
        $this->overall_metrics = $var;

        return $this;
    }

    /**
     * Action-based metrics. The map key is the action name which specified by the
     * site owners at time of the "execute" client-side call.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.recaptchaenterprise.v1.ScoreDistribution> action_metrics = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getActionMetrics()
    {
        return $this->action_metrics;
    }

    /**
     * Action-based metrics. The map key is the action name which specified by the
     * site owners at time of the "execute" client-side call.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.recaptchaenterprise.v1.ScoreDistribution> action_metrics = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setActionMetrics($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\RecaptchaEnterprise\V1\ScoreDistribution::class);
        $this->action_metrics = $arr;

        return $this;
    }

}

