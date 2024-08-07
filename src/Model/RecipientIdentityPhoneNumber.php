<?php
/**
 * RecipientIdentityPhoneNumber
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
 * RecipientIdentityPhoneNumber Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The Docusign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class RecipientIdentityPhoneNumber implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'recipientIdentityPhoneNumber';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'country_code' => '?string',
        'country_code_lock' => '?string',
        'country_code_metadata' => '\DocuSign\eSign\Model\PropertyMetadata',
        'extension' => '?string',
        'extension_metadata' => '\DocuSign\eSign\Model\PropertyMetadata',
        'number' => '?string',
        'number_metadata' => '\DocuSign\eSign\Model\PropertyMetadata'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'country_code' => null,
        'country_code_lock' => null,
        'country_code_metadata' => null,
        'extension' => null,
        'extension_metadata' => null,
        'number' => null,
        'number_metadata' => null
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
        'country_code' => 'countryCode',
        'country_code_lock' => 'countryCodeLock',
        'country_code_metadata' => 'countryCodeMetadata',
        'extension' => 'extension',
        'extension_metadata' => 'extensionMetadata',
        'number' => 'number',
        'number_metadata' => 'numberMetadata'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'country_code' => 'setCountryCode',
        'country_code_lock' => 'setCountryCodeLock',
        'country_code_metadata' => 'setCountryCodeMetadata',
        'extension' => 'setExtension',
        'extension_metadata' => 'setExtensionMetadata',
        'number' => 'setNumber',
        'number_metadata' => 'setNumberMetadata'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'country_code' => 'getCountryCode',
        'country_code_lock' => 'getCountryCodeLock',
        'country_code_metadata' => 'getCountryCodeMetadata',
        'extension' => 'getExtension',
        'extension_metadata' => 'getExtensionMetadata',
        'number' => 'getNumber',
        'number_metadata' => 'getNumberMetadata'
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
        $this->container['country_code'] = isset($data['country_code']) ? $data['country_code'] : null;
        $this->container['country_code_lock'] = isset($data['country_code_lock']) ? $data['country_code_lock'] : null;
        $this->container['country_code_metadata'] = isset($data['country_code_metadata']) ? $data['country_code_metadata'] : null;
        $this->container['extension'] = isset($data['extension']) ? $data['extension'] : null;
        $this->container['extension_metadata'] = isset($data['extension_metadata']) ? $data['extension_metadata'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['number_metadata'] = isset($data['number_metadata']) ? $data['number_metadata'] : null;
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
     * Gets country_code
     *
     * @return ?string
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code
     *
     * @param ?string $country_code 
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->container['country_code'] = $country_code;

        return $this;
    }

    /**
     * Gets country_code_lock
     *
     * @return ?string
     */
    public function getCountryCodeLock()
    {
        return $this->container['country_code_lock'];
    }

    /**
     * Sets country_code_lock
     *
     * @param ?string $country_code_lock 
     *
     * @return $this
     */
    public function setCountryCodeLock($country_code_lock)
    {
        $this->container['country_code_lock'] = $country_code_lock;

        return $this;
    }

    /**
     * Gets country_code_metadata
     *
     * @return \DocuSign\eSign\Model\PropertyMetadata
     */
    public function getCountryCodeMetadata()
    {
        return $this->container['country_code_metadata'];
    }

    /**
     * Sets country_code_metadata
     *
     * @param \DocuSign\eSign\Model\PropertyMetadata $country_code_metadata Metadata that indicates if the `countryCode` property is editable.
     *
     * @return $this
     */
    public function setCountryCodeMetadata($country_code_metadata)
    {
        $this->container['country_code_metadata'] = $country_code_metadata;

        return $this;
    }

    /**
     * Gets extension
     *
     * @return ?string
     */
    public function getExtension()
    {
        return $this->container['extension'];
    }

    /**
     * Sets extension
     *
     * @param ?string $extension 
     *
     * @return $this
     */
    public function setExtension($extension)
    {
        $this->container['extension'] = $extension;

        return $this;
    }

    /**
     * Gets extension_metadata
     *
     * @return \DocuSign\eSign\Model\PropertyMetadata
     */
    public function getExtensionMetadata()
    {
        return $this->container['extension_metadata'];
    }

    /**
     * Sets extension_metadata
     *
     * @param \DocuSign\eSign\Model\PropertyMetadata $extension_metadata Metadata that indicates if the `extension` property is editable.
     *
     * @return $this
     */
    public function setExtensionMetadata($extension_metadata)
    {
        $this->container['extension_metadata'] = $extension_metadata;

        return $this;
    }

    /**
     * Gets number
     *
     * @return ?string
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param ?string $number 
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets number_metadata
     *
     * @return \DocuSign\eSign\Model\PropertyMetadata
     */
    public function getNumberMetadata()
    {
        return $this->container['number_metadata'];
    }

    /**
     * Sets number_metadata
     *
     * @param \DocuSign\eSign\Model\PropertyMetadata $number_metadata Metadata that indicates if the `number` property is editable.
     *
     * @return $this
     */
    public function setNumberMetadata($number_metadata)
    {
        $this->container['number_metadata'] = $number_metadata;

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

