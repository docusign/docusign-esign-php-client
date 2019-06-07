<?php

/**
 * DocuSign REST API
 *
 * The DocuSign REST API provides you with a powerful, convenient, and simple Web services API for interacting with DocuSign.
 *
 * Contact: devcenter@docusign.com
 *
 */

namespace DocuSign\eSign\Client\Auth;

/**
 * Oauth Class Doc Comment
 *
 * @category    Class
 * @package     DocuSign\eSign\Client\Auth
 * @author      DocuSign
 */
class OAuth
{
    /**
     * Base path for OAuth
     *
     * @var string
     */
    protected $oAuthBasePath = null;

    /**
     * Base path for api
     *
     * @var string
     */
    protected $basePath = '';

    // OAuth Base path constants
    // Production/Live server base path
    public static $PRODUCTION_OAUTH_BASE_PATH = "account.docusign.com";
    // Demo/Sandbox server base path
    public static $DEMO_OAUTH_BASE_PATH = "account-d.docusign.com";
    // Stage server base path
    public static $STAGE_OAUTH_BASE_PATH = "account-s.docusign.com";

    /**
     * Constructor
     *
     */
    public function __construct()
    {

    }

    /**
     * Sets oAuth base Path
     *
     * @param string $oAuthBasePath base path for oAuth
     * @return OAuth
     */
    public function setOAuthBasePath($oAuthBasePath = null)
    {

        if ($oAuthBasePath) {
            $this->oAuthBasePath = $oAuthBasePath;
            return $this;
        }

        //Derive OAuth Base Path if not given.
        if (substr($this->getBasePath(), 0, 12) === "https://demo"
            || substr($this->getBasePath(), 0, 11) === "https://demo"
        ) {
            $this->oAuthBasePath = self::$DEMO_OAUTH_BASE_PATH;
        } elseif (substr($this->getBasePath(), 0, 13) === "https://stage"
            || substr($this->getBasePath(), 0, 12) === "http://stage"
        ) {
            $this->oAuthBasePath = self::$STAGE_OAUTH_BASE_PATH;
        } else {
            $this->oAuthBasePath = self::$PRODUCTION_OAUTH_BASE_PATH;
        }

        return $this;
    }

    /**
     * Gets the OAuth base Path
     * @return string
     */
    public function getOAuthBasePath()
    {
        if (!$this->oAuthBasePath) {
            $this->setOAuthBasePath();
        }
        return $this->oAuthBasePath;
    }

    /**
     * Sets the Rest API base Path
     *
     * @param string $basePath base path for oAuth
     *
     * @return OAuth
     */
    public function setBasePath($basePath = null)
    {
        $this->basePath = $basePath;
        return $this;
    }

    /**
     * Returns the Rest API Base path
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

}
