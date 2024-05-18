<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Address;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $sid
 * @property string $accountSid
 * @property string $friendlyName
 * @property string $phoneNumber
 * @property string $voiceUrl
 * @property string $voiceMethod
 * @property string $voiceFallbackMethod
 * @property string $voiceFallbackUrl
 * @property bool $voiceCallerIdLookup
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $smsFallbackMethod
 * @property string $smsFallbackUrl
 * @property string $smsMethod
 * @property string $smsUrl
 * @property string $addressRequirements
 * @property array $capabilities
 * @property string $statusCallback
 * @property string $statusCallbackMethod
 * @property string $apiVersion
 * @property string $smsApplicationSid
 * @property string $voiceApplicationSid
 * @property string $trunkSid
 * @property string $emergencyStatus
 * @property string $emergencyAddressSid
 * @property string $uri
 */
class DependentPhoneNumberInstance extends InstanceResource {
    /**
     * Initialize the DependentPhoneNumberInstance
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The SID of the Account that created the resource
     * @param string $addressSid The unique string that identifies the resource
     * @return \Twilio\Rest\Api\V2010\Account\Address\DependentPhoneNumberInstance
     */
    public function __construct(Version $version, array $payload, $accountSid, $addressSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'phoneNumber' => Values::array_get($payload, 'phone_number'),
            'voiceUrl' => Values::array_get($payload, 'voice_url'),
            'voiceMethod' => Values::array_get($payload, 'voice_method'),
            'voiceFallbackMethod' => Values::array_get($payload, 'voice_fallback_method'),
            'voiceFallbackUrl' => Values::array_get($payload, 'voice_fallback_url'),
            'voiceCallerIdLookup' => Values::array_get($payload, 'voice_caller_id_lookup'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'smsFallbackMethod' => Values::array_get($payload, 'sms_fallback_method'),
            'smsFallbackUrl' => Values::array_get($payload, 'sms_fallback_url'),
            'smsMethod' => Values::array_get($payload, 'sms_method'),
            'smsUrl' => Values::array_get($payload, 'sms_url'),
            'addressRequirements' => Values::array_get($payload, 'address_requirements'),
            'capabilities' => Values::array_get($payload, 'capabilities'),
            'statusCallback' => Values::array_get($payload, 'status_callback'),
            'statusCallbackMethod' => Values::array_get($payload, 'status_callback_method'),
            'apiVersion' => Values::array_get($payload, 'api_version'),
            'smsApplicationSid' => Values::array_get($payload, 'sms_application_sid'),
            'voiceApplicationSid' => Values::array_get($payload, 'voice_application_sid'),
            'trunkSid' => Values::array_get($payload, 'trunk_sid'),
            'emergencyStatus' => Values::array_get($payload, 'emergency_status'),
            'emergencyAddressSid' => Values::array_get($payload, 'emergency_address_sid'),
            'uri' => Values::array_get($payload, 'uri'),
        );

        $this->solution = array('accountSid' => $accountSid, 'addressSid' => $addressSid, );
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.DependentPhoneNumberInstance]';
    }
}