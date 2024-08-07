<?php
/**
 * DocGenFormFields
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
 * DocGenFormFields Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team <apihelp@docusign.com>
 * @license     The Docusign PHP Client SDK is licensed under the MIT License.
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class DocGenFormFields implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'docGenFormFields';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'doc_gen_document_status' => '?string',
        'doc_gen_errors' => '\DocuSign\eSign\Model\DocGenSyntaxError[]',
        'doc_gen_form_field_list' => '\DocuSign\eSign\Model\DocGenFormField[]',
        'document_id' => '?string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'doc_gen_document_status' => null,
        'doc_gen_errors' => null,
        'doc_gen_form_field_list' => null,
        'document_id' => null
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
        'doc_gen_document_status' => 'docGenDocumentStatus',
        'doc_gen_errors' => 'docGenErrors',
        'doc_gen_form_field_list' => 'docGenFormFieldList',
        'document_id' => 'documentId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'doc_gen_document_status' => 'setDocGenDocumentStatus',
        'doc_gen_errors' => 'setDocGenErrors',
        'doc_gen_form_field_list' => 'setDocGenFormFieldList',
        'document_id' => 'setDocumentId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'doc_gen_document_status' => 'getDocGenDocumentStatus',
        'doc_gen_errors' => 'getDocGenErrors',
        'doc_gen_form_field_list' => 'getDocGenFormFieldList',
        'document_id' => 'getDocumentId'
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
        $this->container['doc_gen_document_status'] = isset($data['doc_gen_document_status']) ? $data['doc_gen_document_status'] : null;
        $this->container['doc_gen_errors'] = isset($data['doc_gen_errors']) ? $data['doc_gen_errors'] : null;
        $this->container['doc_gen_form_field_list'] = isset($data['doc_gen_form_field_list']) ? $data['doc_gen_form_field_list'] : null;
        $this->container['document_id'] = isset($data['document_id']) ? $data['document_id'] : null;
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
     * Gets doc_gen_document_status
     *
     * @return ?string
     */
    public function getDocGenDocumentStatus()
    {
        return $this->container['doc_gen_document_status'];
    }

    /**
     * Sets doc_gen_document_status
     *
     * @param ?string $doc_gen_document_status 
     *
     * @return $this
     */
    public function setDocGenDocumentStatus($doc_gen_document_status)
    {
        $this->container['doc_gen_document_status'] = $doc_gen_document_status;

        return $this;
    }

    /**
     * Gets doc_gen_errors
     *
     * @return \DocuSign\eSign\Model\DocGenSyntaxError[]
     */
    public function getDocGenErrors()
    {
        return $this->container['doc_gen_errors'];
    }

    /**
     * Sets doc_gen_errors
     *
     * @param \DocuSign\eSign\Model\DocGenSyntaxError[] $doc_gen_errors 
     *
     * @return $this
     */
    public function setDocGenErrors($doc_gen_errors)
    {
        $this->container['doc_gen_errors'] = $doc_gen_errors;

        return $this;
    }

    /**
     * Gets doc_gen_form_field_list
     *
     * @return \DocuSign\eSign\Model\DocGenFormField[]
     */
    public function getDocGenFormFieldList()
    {
        return $this->container['doc_gen_form_field_list'];
    }

    /**
     * Sets doc_gen_form_field_list
     *
     * @param \DocuSign\eSign\Model\DocGenFormField[] $doc_gen_form_field_list 
     *
     * @return $this
     */
    public function setDocGenFormFieldList($doc_gen_form_field_list)
    {
        $this->container['doc_gen_form_field_list'] = $doc_gen_form_field_list;

        return $this;
    }

    /**
     * Gets document_id
     *
     * @return ?string
     */
    public function getDocumentId()
    {
        return $this->container['document_id'];
    }

    /**
     * Sets document_id
     *
     * @param ?string $document_id Specifies the document ID number that the tab is placed on. This must refer to an existing Document's ID attribute.
     *
     * @return $this
     */
    public function setDocumentId($document_id)
    {
        $this->container['document_id'] = $document_id;

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

