<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/recaptchaenterprise/v1/recaptchaenterprise.proto

namespace Google\Cloud\RecaptchaEnterprise\V1\TransactionEvent;

use UnexpectedValueException;

/**
 * Enum that represents an event in the payment transaction lifecycle.
 *
 * Protobuf type <code>google.cloud.recaptchaenterprise.v1.TransactionEvent.TransactionEventType</code>
 */
class TransactionEventType
{
    /**
     * Default, unspecified event type.
     *
     * Generated from protobuf enum <code>TRANSACTION_EVENT_TYPE_UNSPECIFIED = 0;</code>
     */
    const TRANSACTION_EVENT_TYPE_UNSPECIFIED = 0;
    /**
     * Indicates that the transaction is approved by the merchant. The
     * accompanying reasons can include terms such as 'INHOUSE', 'ACCERTIFY',
     * 'CYBERSOURCE', or 'MANUAL_REVIEW'.
     *
     * Generated from protobuf enum <code>MERCHANT_APPROVE = 1;</code>
     */
    const MERCHANT_APPROVE = 1;
    /**
     * Indicates that the transaction is denied and concluded due to risks
     * detected by the merchant. The accompanying reasons can include terms such
     * as 'INHOUSE',  'ACCERTIFY',  'CYBERSOURCE', or 'MANUAL_REVIEW'.
     *
     * Generated from protobuf enum <code>MERCHANT_DENY = 2;</code>
     */
    const MERCHANT_DENY = 2;
    /**
     * Indicates that the transaction is being evaluated by a human, due to
     * suspicion or risk.
     *
     * Generated from protobuf enum <code>MANUAL_REVIEW = 3;</code>
     */
    const MANUAL_REVIEW = 3;
    /**
     * Indicates that the authorization attempt with the card issuer succeeded.
     *
     * Generated from protobuf enum <code>AUTHORIZATION = 4;</code>
     */
    const AUTHORIZATION = 4;
    /**
     * Indicates that the authorization attempt with the card issuer failed.
     * The accompanying reasons can include Visa's '54' indicating that the card
     * is expired, or '82' indicating that the CVV is incorrect.
     *
     * Generated from protobuf enum <code>AUTHORIZATION_DECLINE = 5;</code>
     */
    const AUTHORIZATION_DECLINE = 5;
    /**
     * Indicates that the transaction is completed because the funds were
     * settled.
     *
     * Generated from protobuf enum <code>PAYMENT_CAPTURE = 6;</code>
     */
    const PAYMENT_CAPTURE = 6;
    /**
     * Indicates that the transaction could not be completed because the funds
     * were not settled.
     *
     * Generated from protobuf enum <code>PAYMENT_CAPTURE_DECLINE = 7;</code>
     */
    const PAYMENT_CAPTURE_DECLINE = 7;
    /**
     * Indicates that the transaction has been canceled. Specify the reason
     * for the cancellation. For example, 'INSUFFICIENT_INVENTORY'.
     *
     * Generated from protobuf enum <code>CANCEL = 8;</code>
     */
    const CANCEL = 8;
    /**
     * Indicates that the merchant has received a chargeback inquiry due to
     * fraud for the transaction, requesting additional information before a
     * fraud chargeback is officially issued and a formal chargeback
     * notification is sent.
     *
     * Generated from protobuf enum <code>CHARGEBACK_INQUIRY = 9;</code>
     */
    const CHARGEBACK_INQUIRY = 9;
    /**
     * Indicates that the merchant has received a chargeback alert due to fraud
     * for the transaction. The process of resolving the dispute without
     * involving the payment network is started.
     *
     * Generated from protobuf enum <code>CHARGEBACK_ALERT = 10;</code>
     */
    const CHARGEBACK_ALERT = 10;
    /**
     * Indicates that a fraud notification is issued for the transaction, sent
     * by the payment instrument's issuing bank because the transaction appears
     * to be fraudulent. We recommend including TC40 or SAFE data in the
     * `reason` field for this event type. For partial chargebacks, we recommend
     * that you include an amount in the `value` field.
     *
     * Generated from protobuf enum <code>FRAUD_NOTIFICATION = 11;</code>
     */
    const FRAUD_NOTIFICATION = 11;
    /**
     * Indicates that the merchant is informed by the payment network that the
     * transaction has entered the chargeback process due to fraud. Reason code
     * examples include Discover's '6005' and '6041'. For partial chargebacks,
     * we recommend that you include an amount in the `value` field.
     *
     * Generated from protobuf enum <code>CHARGEBACK = 12;</code>
     */
    const CHARGEBACK = 12;
    /**
     * Indicates that the transaction has entered the chargeback process due to
     * fraud, and that the merchant has chosen to enter representment. Reason
     * examples include Discover's '6005' and '6041'. For partial chargebacks,
     * we recommend that you include an amount in the `value` field.
     *
     * Generated from protobuf enum <code>CHARGEBACK_REPRESENTMENT = 13;</code>
     */
    const CHARGEBACK_REPRESENTMENT = 13;
    /**
     * Indicates that the transaction has had a fraud chargeback which was
     * illegitimate and was reversed as a result. For partial chargebacks, we
     * recommend that you include an amount in the `value` field.
     *
     * Generated from protobuf enum <code>CHARGEBACK_REVERSE = 14;</code>
     */
    const CHARGEBACK_REVERSE = 14;
    /**
     * Indicates that the merchant has received a refund for a completed
     * transaction. For partial refunds, we recommend that you include an amount
     * in the `value` field. Reason example: 'TAX_EXEMPT' (partial refund of
     * exempt tax)
     *
     * Generated from protobuf enum <code>REFUND_REQUEST = 15;</code>
     */
    const REFUND_REQUEST = 15;
    /**
     * Indicates that the merchant has received a refund request for this
     * transaction, but that they have declined it. For partial refunds, we
     * recommend that you include an amount in the `value` field. Reason
     * example: 'TAX_EXEMPT' (partial refund of exempt tax)
     *
     * Generated from protobuf enum <code>REFUND_DECLINE = 16;</code>
     */
    const REFUND_DECLINE = 16;
    /**
     * Indicates that the completed transaction was refunded by the merchant.
     * For partial refunds, we recommend that you include an amount in the
     * `value` field. Reason example: 'TAX_EXEMPT' (partial refund of exempt
     * tax)
     *
     * Generated from protobuf enum <code>REFUND = 17;</code>
     */
    const REFUND = 17;
    /**
     * Indicates that the completed transaction was refunded by the merchant,
     * and that this refund was reversed. For partial refunds, we recommend that
     * you include an amount in the `value` field.
     *
     * Generated from protobuf enum <code>REFUND_REVERSE = 18;</code>
     */
    const REFUND_REVERSE = 18;

    private static $valueToName = [
        self::TRANSACTION_EVENT_TYPE_UNSPECIFIED => 'TRANSACTION_EVENT_TYPE_UNSPECIFIED',
        self::MERCHANT_APPROVE => 'MERCHANT_APPROVE',
        self::MERCHANT_DENY => 'MERCHANT_DENY',
        self::MANUAL_REVIEW => 'MANUAL_REVIEW',
        self::AUTHORIZATION => 'AUTHORIZATION',
        self::AUTHORIZATION_DECLINE => 'AUTHORIZATION_DECLINE',
        self::PAYMENT_CAPTURE => 'PAYMENT_CAPTURE',
        self::PAYMENT_CAPTURE_DECLINE => 'PAYMENT_CAPTURE_DECLINE',
        self::CANCEL => 'CANCEL',
        self::CHARGEBACK_INQUIRY => 'CHARGEBACK_INQUIRY',
        self::CHARGEBACK_ALERT => 'CHARGEBACK_ALERT',
        self::FRAUD_NOTIFICATION => 'FRAUD_NOTIFICATION',
        self::CHARGEBACK => 'CHARGEBACK',
        self::CHARGEBACK_REPRESENTMENT => 'CHARGEBACK_REPRESENTMENT',
        self::CHARGEBACK_REVERSE => 'CHARGEBACK_REVERSE',
        self::REFUND_REQUEST => 'REFUND_REQUEST',
        self::REFUND_DECLINE => 'REFUND_DECLINE',
        self::REFUND => 'REFUND',
        self::REFUND_REVERSE => 'REFUND_REVERSE',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}


