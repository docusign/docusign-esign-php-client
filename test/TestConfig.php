<?php

class TestConfig
{
    /**
      * $integratorKey
      * @var string
      */
    protected $integratorKey;
    
    /**
      * $host
      * @var string
      */
    protected $host;
    
    /**
      * $apiClient
      * @var DocuSign\eSign\Client\ApiClient
      */
    protected $apiClient;

    /**
      * $accountId
      * @var string
      */
    protected $accountId;

    /**
      * $recipientEmail
      * @var string
      */
    protected $recipientEmail;

    /**
      * $recipientName
      * @var string
      */
    protected $recipientName;

    /**
      * $templateRoleName
      * @var string
      */
    protected $templateRoleName;

    /**
      * $templateId
      * @var string
      */
    protected $templateId;

    /**
      * $envelopId
      * @var string
      */
    protected $envelopeId;

    /**
     * $createdEnvelopId
     * @var string
     */
    protected $createdEnvelopId;

    /**
     * $returnUrl
     * @var string
     */
    protected $returnUrl;

    /**
     * $clientUserId
     * @var string
     */
    protected $clientUserId;

    /**
     * $clientSecret
     * @var string
     */
    protected $clientSecret;

    /**
     * $clientKey
     * @var string
     */
    protected $clientKey;

    protected $userId;

    public function __construct($integratorKey = null, $host = null, $returnUrl = null, $envelopeId = null, $secret = null, $key = null, $userId = null)
    {
        $this->host = !empty($host) ? $host : "https://demo.docusign.net/restapi";
        $this->integratorKey = !empty($integratorKey) ? $integratorKey : 'ae30ea4e-xxxx-xxxx-xxxx-fcb57d2dc4df';
        $this->clientSecret = !empty($secret) ? $secret : 'b4dccdbe-xxxx-xxxx-xxxx-b2f0f7448f8f';
        $this->clientKey = !empty($key) ? $key : 'Docs/private.pem';

        $this->recipientEmail = !empty($recipientEmail) ? $recipientEmail : 'node_sdk@mailinator.com';
        $this->recipientName = !empty($recipientName) ? $recipientName : 'PHP SDK';

        $this->templateRoleName = !empty($templateRoleName) ? $templateRoleName : 'Manager';
        $this->templateId = !empty($templateId) ? $templateId : 'cf2a46c2-xxxx-xxxx-xxxx-752547b1a419';

        $this->returnUrl = !empty($returnUrl) ? $returnUrl : 'https://www.docusign.com/api';

        $this->envelopeId = !empty($envelopeId) ? $envelopeId : '';
        $this->userId = !empty($userId) ? $userId : 'fcc5726c-xxxx-xxxx-xxxx-40bbbe6ca126'; //can be taken from generateAccessToken returned result

        $this->clientUserId = "1234";
    }

    /**
     * Gets integratorKey
     * @return string
     */
    public function getIntegratorKey()
    {
        return $this->integratorKey;
    }
  
    /**
     * Sets integratorKey
     * @param string $integratorKey
     * @return $this
     */
    public function setIntegratorKey($integratorKey)
    {
        $this->integratorKey = $integratorKey;
        return $this;
    } 

    /**
     * Gets host
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
  
    /**
     * Sets host
     * @param string $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    } 

    /**
     * Gets apiClient
     * @return DocuSign\eSign\Client\ApiClient
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }
  
    /**
     * Sets apiClient
     * @param DocuSign\eSign\Client\ApiClient $apiClient
     * @return $this
     */
    public function setApiClient($apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }
  
    /**
     * Gets accountId
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Sets accountId
     * @param string $accountId
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Gets recipientEmail
     * @return string
     */
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }
  
    /**
     * Sets recipientEmail
     * @param string $recipientEmail
     * @return $this
     */
    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
        return $this;
    } 

    /**
     * Gets recipientName
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }
  
    /**
     * Sets recipientName
     * @param string $recipientName
     * @return $this
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
        return $this;
    } 

    /**
     * Gets templateRoleName
     * @return string
     */
    public function getTemplateRoleName()
    {
        return $this->templateRoleName;
    }
  
    /**
     * Sets templateRoleName
     * @param string $templateRoleName
     * @return $this
     */
    public function setTemplateRoleName($templateRoleName)
    {
        $this->templateRoleName = $templateRoleName;
        return $this;
    } 

    /**
     * Gets templateId
     * @return string
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }
  
    /**
     * Sets templateId
     * @param string $templateId
     * @return $this
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        return $this;
    }

    /**
     * Gets envelopeId
     * @return string
     */
    public function getEnvelopeId()
    {
        return $this->envelopeId;
    }

    /**
     * Sets envelopeId
     * @param string $envelopeId
     * @return $this
     */
    public function setEnvelopeId($envelopeId)
    {
        $this->envelopeId = $envelopeId;
        return $this;
    }

    /**
     * Gets createdEnvelopeId
     * @return string
     */
    public function getCreatedEnvelopeId()
    {
        return $this->createdEnvelopId;
    }

    /**
     * Sets createdEnvelopeId
     * @param string $createdEnvelopeId
     * @return $this
     */
    public function setCreatedEnvelopeId($envelopeId)
    {
        $this->createdEnvelopId = $envelopeId;
        return $this;
    }

    /**
     * Gets returnUrl
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * Sets returnUrl
     * @param string $returnUrl
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * Gets clientUserId
     * @return string
     */
    public function getClientUserId()
    {
        return $this->clientUserId;
    }

    /**
     * Sets clientUserId
     * @param string $clientUserId
     * @return $this
     */
    public function setClientUserId($clientUserId)
    {
        $this->clientUserId = $clientUserId;
        return $this;
    }

    /**
     * Gets client secret
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Sets client secret
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * Gets client key
     * @return string
     */
    public function getClientKey()
    {
        return file_get_contents($this->clientKey);
    }

    /**
     * Sets client key
     * @param string $clientKey
     * @return $this
     */
    public function setClientKey($clientKey)
    {
        $this->clientKey = $clientKey;
        return $this;
    }

    /**
     * Gets client key
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * UserId
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
}

?>
