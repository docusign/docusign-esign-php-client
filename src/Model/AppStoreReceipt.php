<?php
/**
 * AppStoreReceipt
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
 * AppStoreReceipt Class Doc Comment
 *
 * @category    Class
 * @description Contains information about an APP store receipt.
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The Docusign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class AppStoreReceipt implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'appStoreReceipt';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'downgrade_product_id' => '?string',
        'is_downgrade_cancellation' => '?string',
        'product_id' => '?string',
        'receipt_data' => '?string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'downgrade_product_id' => null,
        'is_downgrade_cancellation' => null,
        'product_id' => null,
        'receipt_data' => null
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
        'downgrade_product_id' => 'downgradeProductId',
        'is_downgrade_cancellation' => 'isDowngradeCancellation',
        'product_id' => 'productId',
        'receipt_data' => 'receiptData'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'downgrade_product_id' => 'setDowngradeProductId',
        'is_downgrade_cancellation' => 'setIsDowngradeCancellation',
        'product_id' => 'setProductId',
        'receipt_data' => 'setReceiptData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'downgrade_product_id' => 'getDowngradeProductId',
        'is_downgrade_cancellation' => 'getIsDowngradeCancellation',
        'product_id' => 'getProductId',
        'receipt_data' => 'getReceiptData'
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
        $this->container['downgrade_product_id'] = isset($data['downgrade_product_id']) ? $data['downgrade_product_id'] : null;
        $this->container['is_downgrade_cancellation'] = isset($data['is_downgrade_cancellation']) ? $data['is_downgrade_cancellation'] : null;
        $this->container['product_id'] = isset($data['product_id']) ? $data['product_id'] : null;
        $this->container['receipt_data'] = isset($data['receipt_data']) ? $data['receipt_data'] : null;
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
     * Gets downgrade_product_id
     *
     * @return ?string
     */
    public function getDowngradeProductId()
    {
        return $this->container['downgrade_product_id'];
    }

    /**
     * Sets downgrade_product_id
     *
     * @param ?string $downgrade_product_id 
     *
     * @return $this
     */
    public function setDowngradeProductId($downgrade_product_id)
    {
        $this->container['downgrade_product_id'] = $downgrade_product_id;

        return $this;
    }

    /**
     * Gets is_downgrade_cancellation
     *
     * @return ?string
     */
    public function getIsDowngradeCancellation()
    {
        return $this->container['is_downgrade_cancellation'];
    }

    /**
     * Sets is_downgrade_cancellation
     *
     * @param ?string $is_downgrade_cancellation 
     *
     * @return $this
     */
    public function setIsDowngradeCancellation($is_downgrade_cancellation)
    {
        $this->container['is_downgrade_cancellation'] = $is_downgrade_cancellation;

        return $this;
    }

    /**
     * Gets product_id
     *
     * @return ?string
     */
    public function getProductId()
    {
        return $this->container['product_id'];
    }

    /**
     * Sets product_id
     *
     * @param ?string $product_id 
     *
     * @return $this
     */
    public function setProductId($product_id)
    {
        $this->container['product_id'] = $product_id;

        return $this;
    }

    /**
     * Gets receipt_data
     *
     * @return ?string
     */
    public function getReceiptData()
    {
        return $this->container['receipt_data'];
    }

    /**
     * Sets receipt_data
     *
     * @param ?string $receipt_data Reserved: TBD
     *
     * @return $this
     */
    public function setReceiptData($receipt_data)
    {
        $this->container['receipt_data'] = $receipt_data;

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

