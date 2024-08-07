<?php
/**
 * AuthenticationStatus
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swagger Codegen team <apihelp@docusign.com>
 * @license  The Docusign PHP Client SDK is licensed under the MIT License.
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Docusign eSignature REST API
 *
 * The Docusign eSignature REST API provides you with a powerful, convenient, and simple Web services API for interacting with Docusign.
 *
 * OpenAPI spec version: v2.1
 * Contact: devcenter@docusign.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.21
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace DocuSign\eSign\Model;

use \ArrayAccess;
use DocuSign\eSign\ObjectSerializer;

/**
 * AuthenticationStatus Class Doc Comment
 *
 * @category    Class
 * @description Contains information about the authentication status.
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The Docusign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class AuthenticationStatus implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'authenticationStatus';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'access_code_result' => '\DocuSign\eSign\Model\EventResult',
        'age_verify_result' => '\DocuSign\eSign\Model\EventResult',
        'any_social_id_result' => '\DocuSign\eSign\Model\EventResult',
        'facebook_result' => '\DocuSign\eSign\Model\EventResult',
        'google_result' => '\DocuSign\eSign\Model\EventResult',
        'identity_verification_result' => '\DocuSign\eSign\Model\EventResult',
        'id_lookup_result' => '\DocuSign\eSign\Model\EventResult',
        'id_questions_result' => '\DocuSign\eSign\Model\EventResult',
        'linkedin_result' => '\DocuSign\eSign\Model\EventResult',
        'live_id_result' => '\DocuSign\eSign\Model\EventResult',
        'ofac_result' => '\DocuSign\eSign\Model\EventResult',
        'open_id_result' => '\DocuSign\eSign\Model\EventResult',
        'phone_auth_result' => '\DocuSign\eSign\Model\EventResult',
        'salesforce_result' => '\DocuSign\eSign\Model\EventResult',
        'signature_provider_result' => '\DocuSign\eSign\Model\EventResult',
        'sms_auth_result' => '\DocuSign\eSign\Model\EventResult',
        's_tan_pin_result' => '\DocuSign\eSign\Model\EventResult',
        'twitter_result' => '\DocuSign\eSign\Model\EventResult',
        'yahoo_result' => '\DocuSign\eSign\Model\EventResult'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'access_code_result' => null,
        'age_verify_result' => null,
        'any_social_id_result' => null,
        'facebook_result' => null,
        'google_result' => null,
        'identity_verification_result' => null,
        'id_lookup_result' => null,
        'id_questions_result' => null,
        'linkedin_result' => null,
        'live_id_result' => null,
        'ofac_result' => null,
        'open_id_result' => null,
        'phone_auth_result' => null,
        'salesforce_result' => null,
        'signature_provider_result' => null,
        'sms_auth_result' => null,
        's_tan_pin_result' => null,
        'twitter_result' => null,
        'yahoo_result' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'access_code_result' => 'accessCodeResult',
        'age_verify_result' => 'ageVerifyResult',
        'any_social_id_result' => 'anySocialIDResult',
        'facebook_result' => 'facebookResult',
        'google_result' => 'googleResult',
        'identity_verification_result' => 'identityVerificationResult',
        'id_lookup_result' => 'idLookupResult',
        'id_questions_result' => 'idQuestionsResult',
        'linkedin_result' => 'linkedinResult',
        'live_id_result' => 'liveIDResult',
        'ofac_result' => 'ofacResult',
        'open_id_result' => 'openIDResult',
        'phone_auth_result' => 'phoneAuthResult',
        'salesforce_result' => 'salesforceResult',
        'signature_provider_result' => 'signatureProviderResult',
        'sms_auth_result' => 'smsAuthResult',
        's_tan_pin_result' => 'sTANPinResult',
        'twitter_result' => 'twitterResult',
        'yahoo_result' => 'yahooResult'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'access_code_result' => 'setAccessCodeResult',
        'age_verify_result' => 'setAgeVerifyResult',
        'any_social_id_result' => 'setAnySocialIdResult',
        'facebook_result' => 'setFacebookResult',
        'google_result' => 'setGoogleResult',
        'identity_verification_result' => 'setIdentityVerificationResult',
        'id_lookup_result' => 'setIdLookupResult',
        'id_questions_result' => 'setIdQuestionsResult',
        'linkedin_result' => 'setLinkedinResult',
        'live_id_result' => 'setLiveIdResult',
        'ofac_result' => 'setOfacResult',
        'open_id_result' => 'setOpenIdResult',
        'phone_auth_result' => 'setPhoneAuthResult',
        'salesforce_result' => 'setSalesforceResult',
        'signature_provider_result' => 'setSignatureProviderResult',
        'sms_auth_result' => 'setSmsAuthResult',
        's_tan_pin_result' => 'setSTanPinResult',
        'twitter_result' => 'setTwitterResult',
        'yahoo_result' => 'setYahooResult'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'access_code_result' => 'getAccessCodeResult',
        'age_verify_result' => 'getAgeVerifyResult',
        'any_social_id_result' => 'getAnySocialIdResult',
        'facebook_result' => 'getFacebookResult',
        'google_result' => 'getGoogleResult',
        'identity_verification_result' => 'getIdentityVerificationResult',
        'id_lookup_result' => 'getIdLookupResult',
        'id_questions_result' => 'getIdQuestionsResult',
        'linkedin_result' => 'getLinkedinResult',
        'live_id_result' => 'getLiveIdResult',
        'ofac_result' => 'getOfacResult',
        'open_id_result' => 'getOpenIdResult',
        'phone_auth_result' => 'getPhoneAuthResult',
        'salesforce_result' => 'getSalesforceResult',
        'signature_provider_result' => 'getSignatureProviderResult',
        'sms_auth_result' => 'getSmsAuthResult',
        's_tan_pin_result' => 'getSTanPinResult',
        'twitter_result' => 'getTwitterResult',
        'yahoo_result' => 'getYahooResult'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['access_code_result'] = isset($data['access_code_result']) ? $data['access_code_result'] : null;
        $this->container['age_verify_result'] = isset($data['age_verify_result']) ? $data['age_verify_result'] : null;
        $this->container['any_social_id_result'] = isset($data['any_social_id_result']) ? $data['any_social_id_result'] : null;
        $this->container['facebook_result'] = isset($data['facebook_result']) ? $data['facebook_result'] : null;
        $this->container['google_result'] = isset($data['google_result']) ? $data['google_result'] : null;
        $this->container['identity_verification_result'] = isset($data['identity_verification_result']) ? $data['identity_verification_result'] : null;
        $this->container['id_lookup_result'] = isset($data['id_lookup_result']) ? $data['id_lookup_result'] : null;
        $this->container['id_questions_result'] = isset($data['id_questions_result']) ? $data['id_questions_result'] : null;
        $this->container['linkedin_result'] = isset($data['linkedin_result']) ? $data['linkedin_result'] : null;
        $this->container['live_id_result'] = isset($data['live_id_result']) ? $data['live_id_result'] : null;
        $this->container['ofac_result'] = isset($data['ofac_result']) ? $data['ofac_result'] : null;
        $this->container['open_id_result'] = isset($data['open_id_result']) ? $data['open_id_result'] : null;
        $this->container['phone_auth_result'] = isset($data['phone_auth_result']) ? $data['phone_auth_result'] : null;
        $this->container['salesforce_result'] = isset($data['salesforce_result']) ? $data['salesforce_result'] : null;
        $this->container['signature_provider_result'] = isset($data['signature_provider_result']) ? $data['signature_provider_result'] : null;
        $this->container['sms_auth_result'] = isset($data['sms_auth_result']) ? $data['sms_auth_result'] : null;
        $this->container['s_tan_pin_result'] = isset($data['s_tan_pin_result']) ? $data['s_tan_pin_result'] : null;
        $this->container['twitter_result'] = isset($data['twitter_result']) ? $data['twitter_result'] : null;
        $this->container['yahoo_result'] = isset($data['yahoo_result']) ? $data['yahoo_result'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets access_code_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getAccessCodeResult()
    {
        return $this->container['access_code_result'];
    }

    /**
     * Sets access_code_result
     *
     * @param \DocuSign\eSign\Model\EventResult $access_code_result The result of a user's attempt to authenticate by using an access code. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setAccessCodeResult($access_code_result)
    {
        $this->container['access_code_result'] = $access_code_result;

        return $this;
    }

    /**
     * Gets age_verify_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getAgeVerifyResult()
    {
        return $this->container['age_verify_result'];
    }

    /**
     * Sets age_verify_result
     *
     * @param \DocuSign\eSign\Model\EventResult $age_verify_result The result of an age verification check. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setAgeVerifyResult($age_verify_result)
    {
        $this->container['age_verify_result'] = $age_verify_result;

        return $this;
    }

    /**
     * Gets any_social_id_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getAnySocialIdResult()
    {
        return $this->container['any_social_id_result'];
    }

    /**
     * Sets any_social_id_result
     *
     * @param \DocuSign\eSign\Model\EventResult $any_social_id_result Deprecated.
     *
     * @return $this
     */
    public function setAnySocialIdResult($any_social_id_result)
    {
        $this->container['any_social_id_result'] = $any_social_id_result;

        return $this;
    }

    /**
     * Gets facebook_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getFacebookResult()
    {
        return $this->container['facebook_result'];
    }

    /**
     * Sets facebook_result
     *
     * @param \DocuSign\eSign\Model\EventResult $facebook_result Deprecated.
     *
     * @return $this
     */
    public function setFacebookResult($facebook_result)
    {
        $this->container['facebook_result'] = $facebook_result;

        return $this;
    }

    /**
     * Gets google_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getGoogleResult()
    {
        return $this->container['google_result'];
    }

    /**
     * Sets google_result
     *
     * @param \DocuSign\eSign\Model\EventResult $google_result Deprecated.
     *
     * @return $this
     */
    public function setGoogleResult($google_result)
    {
        $this->container['google_result'] = $google_result;

        return $this;
    }

    /**
     * Gets identity_verification_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getIdentityVerificationResult()
    {
        return $this->container['identity_verification_result'];
    }

    /**
     * Sets identity_verification_result
     *
     * @param \DocuSign\eSign\Model\EventResult $identity_verification_result The result of an [Identity Verification][IDV] workflow.  [IDV]: /docs/esign-rest-api/reference/accounts/identityverifications/
     *
     * @return $this
     */
    public function setIdentityVerificationResult($identity_verification_result)
    {
        $this->container['identity_verification_result'] = $identity_verification_result;

        return $this;
    }

    /**
     * Gets id_lookup_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getIdLookupResult()
    {
        return $this->container['id_lookup_result'];
    }

    /**
     * Sets id_lookup_result
     *
     * @param \DocuSign\eSign\Model\EventResult $id_lookup_result The result of an ID lookup authentication check. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setIdLookupResult($id_lookup_result)
    {
        $this->container['id_lookup_result'] = $id_lookup_result;

        return $this;
    }

    /**
     * Gets id_questions_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getIdQuestionsResult()
    {
        return $this->container['id_questions_result'];
    }

    /**
     * Sets id_questions_result
     *
     * @param \DocuSign\eSign\Model\EventResult $id_questions_result The result of the user's answers to ID challenge questions. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setIdQuestionsResult($id_questions_result)
    {
        $this->container['id_questions_result'] = $id_questions_result;

        return $this;
    }

    /**
     * Gets linkedin_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getLinkedinResult()
    {
        return $this->container['linkedin_result'];
    }

    /**
     * Sets linkedin_result
     *
     * @param \DocuSign\eSign\Model\EventResult $linkedin_result Deprecated.
     *
     * @return $this
     */
    public function setLinkedinResult($linkedin_result)
    {
        $this->container['linkedin_result'] = $linkedin_result;

        return $this;
    }

    /**
     * Gets live_id_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getLiveIdResult()
    {
        return $this->container['live_id_result'];
    }

    /**
     * Sets live_id_result
     *
     * @param \DocuSign\eSign\Model\EventResult $live_id_result Deprecated.
     *
     * @return $this
     */
    public function setLiveIdResult($live_id_result)
    {
        $this->container['live_id_result'] = $live_id_result;

        return $this;
    }

    /**
     * Gets ofac_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getOfacResult()
    {
        return $this->container['ofac_result'];
    }

    /**
     * Sets ofac_result
     *
     * @param \DocuSign\eSign\Model\EventResult $ofac_result The result of an Office of Foreign Asset Control (OFAC) check. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setOfacResult($ofac_result)
    {
        $this->container['ofac_result'] = $ofac_result;

        return $this;
    }

    /**
     * Gets open_id_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getOpenIdResult()
    {
        return $this->container['open_id_result'];
    }

    /**
     * Sets open_id_result
     *
     * @param \DocuSign\eSign\Model\EventResult $open_id_result Deprecated.
     *
     * @return $this
     */
    public function setOpenIdResult($open_id_result)
    {
        $this->container['open_id_result'] = $open_id_result;

        return $this;
    }

    /**
     * Gets phone_auth_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getPhoneAuthResult()
    {
        return $this->container['phone_auth_result'];
    }

    /**
     * Sets phone_auth_result
     *
     * @param \DocuSign\eSign\Model\EventResult $phone_auth_result The result of the user's attempt to authenticate by using two-factor authentication (2FA) through phone messaging. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setPhoneAuthResult($phone_auth_result)
    {
        $this->container['phone_auth_result'] = $phone_auth_result;

        return $this;
    }

    /**
     * Gets salesforce_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getSalesforceResult()
    {
        return $this->container['salesforce_result'];
    }

    /**
     * Sets salesforce_result
     *
     * @param \DocuSign\eSign\Model\EventResult $salesforce_result Success/failure result of authentication using sign-in with a Salesforce account. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setSalesforceResult($salesforce_result)
    {
        $this->container['salesforce_result'] = $salesforce_result;

        return $this;
    }

    /**
     * Gets signature_provider_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getSignatureProviderResult()
    {
        return $this->container['signature_provider_result'];
    }

    /**
     * Sets signature_provider_result
     *
     * @param \DocuSign\eSign\Model\EventResult $signature_provider_result The result of the user's attempt to authenticate by using a signature provider.
     *
     * @return $this
     */
    public function setSignatureProviderResult($signature_provider_result)
    {
        $this->container['signature_provider_result'] = $signature_provider_result;

        return $this;
    }

    /**
     * Gets sms_auth_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getSmsAuthResult()
    {
        return $this->container['sms_auth_result'];
    }

    /**
     * Sets sms_auth_result
     *
     * @param \DocuSign\eSign\Model\EventResult $sms_auth_result The result of the user's attempt to authenticate by using two-factor authentication (2FA) through SMS messaging on a mobile phone.
     *
     * @return $this
     */
    public function setSmsAuthResult($sms_auth_result)
    {
        $this->container['sms_auth_result'] = $sms_auth_result;

        return $this;
    }

    /**
     * Gets s_tan_pin_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getSTanPinResult()
    {
        return $this->container['s_tan_pin_result'];
    }

    /**
     * Sets s_tan_pin_result
     *
     * @param \DocuSign\eSign\Model\EventResult $s_tan_pin_result The result of a Student Authentication Network (STAN) authentication check. It returns:  - `Status`: `Pass` or `Fail`. - `dateTime`: The date and time that the event occurred. - `FailureDescription`: A string containing the details about a failed authentication. - `VendorFailureStatusCode`: A string containing the vendor's status code for a failed authentication.
     *
     * @return $this
     */
    public function setSTanPinResult($s_tan_pin_result)
    {
        $this->container['s_tan_pin_result'] = $s_tan_pin_result;

        return $this;
    }

    /**
     * Gets twitter_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getTwitterResult()
    {
        return $this->container['twitter_result'];
    }

    /**
     * Sets twitter_result
     *
     * @param \DocuSign\eSign\Model\EventResult $twitter_result Deprecated.
     *
     * @return $this
     */
    public function setTwitterResult($twitter_result)
    {
        $this->container['twitter_result'] = $twitter_result;

        return $this;
    }

    /**
     * Gets yahoo_result
     *
     * @return \DocuSign\eSign\Model\EventResult
     */
    public function getYahooResult()
    {
        return $this->container['yahoo_result'];
    }

    /**
     * Sets yahoo_result
     *
     * @param \DocuSign\eSign\Model\EventResult $yahoo_result Deprecated.
     *
     * @return $this
     */
    public function setYahooResult($yahoo_result)
    {
        $this->container['yahoo_result'] = $yahoo_result;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

