<?php
/**
 * TemplateRole
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * DocuSign REST API
 *
 * The DocuSign REST API provides you with a powerful, convenient, and simple Web services API for interacting with DocuSign.
 *
 * OpenAPI spec version: v2
 * Contact: devcenter@docusign.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.21-SNAPSHOT
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
 * TemplateRole Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class TemplateRole implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'templateRole';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'access_code' => '?string',
        'client_user_id' => '?string',
        'default_recipient' => '?string',
        'email' => '?string',
        'email_notification' => '\DocuSign\eSign\Model\RecipientEmailNotification',
        'embedded_recipient_start_url' => '?string',
        'in_person_signer_name' => '?string',
        'name' => '?string',
        'recipient_signature_providers' => '\DocuSign\eSign\Model\RecipientSignatureProvider[]',
        'role_name' => '?string',
        'routing_order' => '?string',
        'signing_group_id' => '?string',
        'tabs' => '\DocuSign\eSign\Model\Tabs'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'access_code' => null,
        'client_user_id' => null,
        'default_recipient' => null,
        'email' => null,
        'email_notification' => null,
        'embedded_recipient_start_url' => null,
        'in_person_signer_name' => null,
        'name' => null,
        'recipient_signature_providers' => null,
        'role_name' => null,
        'routing_order' => null,
        'signing_group_id' => null,
        'tabs' => null
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
        'access_code' => 'accessCode',
        'client_user_id' => 'clientUserId',
        'default_recipient' => 'defaultRecipient',
        'email' => 'email',
        'email_notification' => 'emailNotification',
        'embedded_recipient_start_url' => 'embeddedRecipientStartURL',
        'in_person_signer_name' => 'inPersonSignerName',
        'name' => 'name',
        'recipient_signature_providers' => 'recipientSignatureProviders',
        'role_name' => 'roleName',
        'routing_order' => 'routingOrder',
        'signing_group_id' => 'signingGroupId',
        'tabs' => 'tabs'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'access_code' => 'setAccessCode',
        'client_user_id' => 'setClientUserId',
        'default_recipient' => 'setDefaultRecipient',
        'email' => 'setEmail',
        'email_notification' => 'setEmailNotification',
        'embedded_recipient_start_url' => 'setEmbeddedRecipientStartUrl',
        'in_person_signer_name' => 'setInPersonSignerName',
        'name' => 'setName',
        'recipient_signature_providers' => 'setRecipientSignatureProviders',
        'role_name' => 'setRoleName',
        'routing_order' => 'setRoutingOrder',
        'signing_group_id' => 'setSigningGroupId',
        'tabs' => 'setTabs'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'access_code' => 'getAccessCode',
        'client_user_id' => 'getClientUserId',
        'default_recipient' => 'getDefaultRecipient',
        'email' => 'getEmail',
        'email_notification' => 'getEmailNotification',
        'embedded_recipient_start_url' => 'getEmbeddedRecipientStartUrl',
        'in_person_signer_name' => 'getInPersonSignerName',
        'name' => 'getName',
        'recipient_signature_providers' => 'getRecipientSignatureProviders',
        'role_name' => 'getRoleName',
        'routing_order' => 'getRoutingOrder',
        'signing_group_id' => 'getSigningGroupId',
        'tabs' => 'getTabs'
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
        $this->container['access_code'] = isset($data['access_code']) ? $data['access_code'] : null;
        $this->container['client_user_id'] = isset($data['client_user_id']) ? $data['client_user_id'] : null;
        $this->container['default_recipient'] = isset($data['default_recipient']) ? $data['default_recipient'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['email_notification'] = isset($data['email_notification']) ? $data['email_notification'] : null;
        $this->container['embedded_recipient_start_url'] = isset($data['embedded_recipient_start_url']) ? $data['embedded_recipient_start_url'] : null;
        $this->container['in_person_signer_name'] = isset($data['in_person_signer_name']) ? $data['in_person_signer_name'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['recipient_signature_providers'] = isset($data['recipient_signature_providers']) ? $data['recipient_signature_providers'] : null;
        $this->container['role_name'] = isset($data['role_name']) ? $data['role_name'] : null;
        $this->container['routing_order'] = isset($data['routing_order']) ? $data['routing_order'] : null;
        $this->container['signing_group_id'] = isset($data['signing_group_id']) ? $data['signing_group_id'] : null;
        $this->container['tabs'] = isset($data['tabs']) ? $data['tabs'] : null;
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
     * Gets access_code
     *
     * @return ?string
     */
    public function getAccessCode()
    {
        return $this->container['access_code'];
    }

    /**
     * Sets access_code
     *
     * @param ?string $access_code If a value is provided, the recipient must enter the value as the access code to view and sign the envelope.   Maximum Length: 50 characters and it must conform to the account's access code format setting.  If blank, but the signer `accessCode` property is set in the envelope, then that value is used.  If blank and the signer `accessCode` property is not set, then the access code is not required.
     *
     * @return $this
     */
    public function setAccessCode($access_code)
    {
        $this->container['access_code'] = $access_code;

        return $this;
    }

    /**
     * Gets client_user_id
     *
     * @return ?string
     */
    public function getClientUserId()
    {
        return $this->container['client_user_id'];
    }

    /**
     * Sets client_user_id
     *
     * @param ?string $client_user_id Specifies whether the recipient is embedded or remote.   If the `clientUserId` property is not null then the recipient is embedded. Note that if the `ClientUserId` property is set and either `SignerMustHaveAccount` or `SignerMustLoginToSign` property of the account settings is set to  **true**, an error is generated on sending.ng.   Maximum length: 100 characters.
     *
     * @return $this
     */
    public function setClientUserId($client_user_id)
    {
        $this->container['client_user_id'] = $client_user_id;

        return $this;
    }

    /**
     * Gets default_recipient
     *
     * @return ?string
     */
    public function getDefaultRecipient()
    {
        return $this->container['default_recipient'];
    }

    /**
     * Sets default_recipient
     *
     * @param ?string $default_recipient When set to **true**, this recipient is the default recipient and any tabs generated by the transformPdfFields option are mapped to this recipient.
     *
     * @return $this
     */
    public function setDefaultRecipient($default_recipient)
    {
        $this->container['default_recipient'] = $default_recipient;

        return $this;
    }

    /**
     * Gets email
     *
     * @return ?string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param ?string $email Specifies the email associated with a role name.
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets email_notification
     *
     * @return \DocuSign\eSign\Model\RecipientEmailNotification
     */
    public function getEmailNotification()
    {
        return $this->container['email_notification'];
    }

    /**
     * Sets email_notification
     *
     * @param \DocuSign\eSign\Model\RecipientEmailNotification $email_notification email_notification
     *
     * @return $this
     */
    public function setEmailNotification($email_notification)
    {
        $this->container['email_notification'] = $email_notification;

        return $this;
    }

    /**
     * Gets embedded_recipient_start_url
     *
     * @return ?string
     */
    public function getEmbeddedRecipientStartUrl()
    {
        return $this->container['embedded_recipient_start_url'];
    }

    /**
     * Sets embedded_recipient_start_url
     *
     * @param ?string $embedded_recipient_start_url Specifies a sender provided valid URL string for redirecting an embedded recipient. When using this option, the embedded recipient still receives an email from DocuSign, just as a remote recipient would. When the document link in the email is clicked the recipient is redirected, through DocuSign, to the supplied URL to complete their actions. When routing to the URL, the sender's system (the server responding to the URL) must request a recipient token to launch a signing session.   If set to `SIGN_AT_DOCUSIGN`, the recipient is directed to an embedded signing or viewing process directly at DocuSign. The signing or viewing action is initiated by the DocuSign system and the transaction activity and Certificate of Completion records will reflect this. In all other ways the process is identical to an embedded signing or viewing operation that is launched by any partner.  It is important to remember that in a typical embedded workflow the authentication of an embedded recipient is the responsibility of the sending application, DocuSign expects that senders will follow their own process for establishing the recipient's identity. In this workflow the recipient goes through the sending application before the embedded signing or viewing process in initiated. However, when the sending application sets `EmbeddedRecipientStartURL=SIGN_AT_DOCUSIGN`, the recipient goes directly to the embedded signing or viewing process bypassing the sending application and any authentication steps the sending application would use. In this case, DocuSign recommends that you use one of the normal DocuSign authentication features (Access Code, Phone Authentication, SMS Authentication, etc.) to verify the identity of the recipient.  If the `clientUserId` property is NOT set, and the `embeddedRecipientStartURL` is set, DocuSign will ignore the redirect URL and launch the standard signing process for the email recipient. Information can be appended to the embedded recipient start URL using merge fields. The available merge fields items are: envelopeId, recipientId, recipientName, recipientEmail, and customFields. The `customFields` property must be set fort the recipient or envelope. The merge fields are enclosed in double brackets.   *Example*:   `http://senderHost/[[mergeField1]]/ beginSigningSession? [[mergeField2]]&[[mergeField3]]`
     *
     * @return $this
     */
    public function setEmbeddedRecipientStartUrl($embedded_recipient_start_url)
    {
        $this->container['embedded_recipient_start_url'] = $embedded_recipient_start_url;

        return $this;
    }

    /**
     * Gets in_person_signer_name
     *
     * @return ?string
     */
    public function getInPersonSignerName()
    {
        return $this->container['in_person_signer_name'];
    }

    /**
     * Sets in_person_signer_name
     *
     * @param ?string $in_person_signer_name Specifies the full legal name of the signer in person signer template roles.  Maximum Length: 100 characters.
     *
     * @return $this
     */
    public function setInPersonSignerName($in_person_signer_name)
    {
        $this->container['in_person_signer_name'] = $in_person_signer_name;

        return $this;
    }

    /**
     * Gets name
     *
     * @return ?string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param ?string $name Specifies the recipient's name.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets recipient_signature_providers
     *
     * @return \DocuSign\eSign\Model\RecipientSignatureProvider[]
     */
    public function getRecipientSignatureProviders()
    {
        return $this->container['recipient_signature_providers'];
    }

    /**
     * Sets recipient_signature_providers
     *
     * @param \DocuSign\eSign\Model\RecipientSignatureProvider[] $recipient_signature_providers 
     *
     * @return $this
     */
    public function setRecipientSignatureProviders($recipient_signature_providers)
    {
        $this->container['recipient_signature_providers'] = $recipient_signature_providers;

        return $this;
    }

    /**
     * Gets role_name
     *
     * @return ?string
     */
    public function getRoleName()
    {
        return $this->container['role_name'];
    }

    /**
     * Sets role_name
     *
     * @param ?string $role_name Optional element. Specifies the role name associated with the recipient.<br/><br/>This is required when working with template recipients.
     *
     * @return $this
     */
    public function setRoleName($role_name)
    {
        $this->container['role_name'] = $role_name;

        return $this;
    }

    /**
     * Gets routing_order
     *
     * @return ?string
     */
    public function getRoutingOrder()
    {
        return $this->container['routing_order'];
    }

    /**
     * Sets routing_order
     *
     * @param ?string $routing_order Specifies the routing order of the recipient in the envelope.
     *
     * @return $this
     */
    public function setRoutingOrder($routing_order)
    {
        $this->container['routing_order'] = $routing_order;

        return $this;
    }

    /**
     * Gets signing_group_id
     *
     * @return ?string
     */
    public function getSigningGroupId()
    {
        return $this->container['signing_group_id'];
    }

    /**
     * Sets signing_group_id
     *
     * @param ?string $signing_group_id When set to **true** and the feature is enabled in the sender's account, the signing recipient is required to draw signatures and initials at each signature/initial tab ( instead of adopting a signature/initial style or only drawing a signature/initial once).
     *
     * @return $this
     */
    public function setSigningGroupId($signing_group_id)
    {
        $this->container['signing_group_id'] = $signing_group_id;

        return $this;
    }

    /**
     * Gets tabs
     *
     * @return \DocuSign\eSign\Model\Tabs
     */
    public function getTabs()
    {
        return $this->container['tabs'];
    }

    /**
     * Sets tabs
     *
     * @param \DocuSign\eSign\Model\Tabs $tabs tabs
     *
     * @return $this
     */
    public function setTabs($tabs)
    {
        $this->container['tabs'] = $tabs;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
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

