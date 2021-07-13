<?php
/**
 * WorkspaceList
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
 * WorkspaceList Class Doc Comment
 *
 * @category    Class
 * @description Provides properties that describe the workspaces avaialble.
 * @package     DocuSign\eSign
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class WorkspaceList implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'workspaceList';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'end_position' => '?string',
        'result_set_size' => '?string',
        'start_position' => '?string',
        'total_set_size' => '?string',
        'workspaces' => '\DocuSign\eSign\Model\Workspace[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'end_position' => null,
        'result_set_size' => null,
        'start_position' => null,
        'total_set_size' => null,
        'workspaces' => null
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
        'end_position' => 'endPosition',
        'result_set_size' => 'resultSetSize',
        'start_position' => 'startPosition',
        'total_set_size' => 'totalSetSize',
        'workspaces' => 'workspaces'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'end_position' => 'setEndPosition',
        'result_set_size' => 'setResultSetSize',
        'start_position' => 'setStartPosition',
        'total_set_size' => 'setTotalSetSize',
        'workspaces' => 'setWorkspaces'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'end_position' => 'getEndPosition',
        'result_set_size' => 'getResultSetSize',
        'start_position' => 'getStartPosition',
        'total_set_size' => 'getTotalSetSize',
        'workspaces' => 'getWorkspaces'
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
        $this->container['end_position'] = isset($data['end_position']) ? $data['end_position'] : null;
        $this->container['result_set_size'] = isset($data['result_set_size']) ? $data['result_set_size'] : null;
        $this->container['start_position'] = isset($data['start_position']) ? $data['start_position'] : null;
        $this->container['total_set_size'] = isset($data['total_set_size']) ? $data['total_set_size'] : null;
        $this->container['workspaces'] = isset($data['workspaces']) ? $data['workspaces'] : null;
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
     * Gets end_position
     *
     * @return ?string
     */
    public function getEndPosition()
    {
        return $this->container['end_position'];
    }

    /**
     * Sets end_position
     *
     * @param ?string $end_position The last position in the result set.
     *
     * @return $this
     */
    public function setEndPosition($end_position)
    {
        $this->container['end_position'] = $end_position;

        return $this;
    }

    /**
     * Gets result_set_size
     *
     * @return ?string
     */
    public function getResultSetSize()
    {
        return $this->container['result_set_size'];
    }

    /**
     * Sets result_set_size
     *
     * @param ?string $result_set_size The number of results returned in this response.
     *
     * @return $this
     */
    public function setResultSetSize($result_set_size)
    {
        $this->container['result_set_size'] = $result_set_size;

        return $this;
    }

    /**
     * Gets start_position
     *
     * @return ?string
     */
    public function getStartPosition()
    {
        return $this->container['start_position'];
    }

    /**
     * Sets start_position
     *
     * @param ?string $start_position Starting position of the current result set.
     *
     * @return $this
     */
    public function setStartPosition($start_position)
    {
        $this->container['start_position'] = $start_position;

        return $this;
    }

    /**
     * Gets total_set_size
     *
     * @return ?string
     */
    public function getTotalSetSize()
    {
        return $this->container['total_set_size'];
    }

    /**
     * Sets total_set_size
     *
     * @param ?string $total_set_size The total number of items available in the result set. This will always be greater than or equal to the value of the property returning the results in the in the response.
     *
     * @return $this
     */
    public function setTotalSetSize($total_set_size)
    {
        $this->container['total_set_size'] = $total_set_size;

        return $this;
    }

    /**
     * Gets workspaces
     *
     * @return \DocuSign\eSign\Model\Workspace[]
     */
    public function getWorkspaces()
    {
        return $this->container['workspaces'];
    }

    /**
     * Sets workspaces
     *
     * @param \DocuSign\eSign\Model\Workspace[] $workspaces A list of workspaces.
     *
     * @return $this
     */
    public function setWorkspaces($workspaces)
    {
        $this->container['workspaces'] = $workspaces;

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

