<?php

use DocuSign\eSign\Model\Envelope;
use DocuSign\eSign\Model\EnvelopeTemplate;

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

    /**
     * $privateKey
     * @var string
     */
    protected $privateKeyB64;

    protected $userId;

    protected $createdUserId;

    protected $folderOneId;

    protected $folderTwoId;

    /**
     * $envelope
     * @var \DocuSign\eSign\Model\Envelope
     */
    protected $envelope;

    /**
     * $envelopeTemplate
     * @var \DocuSign\eSign\Model\EnvelopeTemplate
     */
    protected $template;

    protected $brandId;

    public function __construct($integratorKey = null, $host = null, $returnUrl = null, $envelopeId = null, $secret = null, $key = null, $userId = null, $privateKey = null)
    {
        $this->host = !empty($host) ? $host : 'https://demo.docusign.net/restapi';
        $this->integratorKey = !empty($integratorKey) ? $integratorKey : getenv('INTEGRATOR_KEY_JWT');
        $this->clientSecret = !empty($secret) ? $secret : getenv('CLIENT_SECRET');
        $this->clientKey = !empty($key) ? $key : __DIR__ . '/Docs/private.pem';
        $this->privateKeyB64 = !empty($privateKey) ? $privateKey : getenv('PRIVATE_KEY');

        $this->recipientEmail = !empty($recipientEmail) ? $recipientEmail : 'node_sdk@mailinator.com';
        $this->recipientName = !empty($recipientName) ? $recipientName : 'PHP SDK';

        $this->templateRoleName = !empty($templateRoleName) ? $templateRoleName : 'Manager';
        $this->templateId = !empty($templateId) ? $templateId : getenv('TEMPLATE_ID');

        $this->returnUrl = !empty($returnUrl) ? $returnUrl : getenv('REDIRECT_URI');

        $this->envelopeId = !empty($envelopeId) ? $envelopeId : '';
        $this->userId = !empty($userId) ? $userId : getenv('USER_ID'); //can be taken from generateAccessToken returned result

        $this->brandId = !empty($brandId) ? $brandId : getenv('BRAND_ID');

        $this->clientUserId = "1234";

        $decodedKey = base64_decode($this->privateKeyB64);
        file_put_contents($this->clientKey, $decodedKey);
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
     * @return string
     */
    public function getPrivateKeyB64()
    {
        return $this->privateKeyB64;
    }

    /**
     * @param string $privateKeyB64
     */
    public function setPrivateKeyB64($privateKeyB64)
    {
        $this->privateKeyB64 = $privateKeyB64;
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

    /**
     * Gets BrandId
     * @return string
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * BrandId
     * @param string $brandId
     * @return $this
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;
        return $this;
    }

    /**
     * @return Envelope
     */
    public function getEnvelope(): Model\Envelope
    {
        return $this->envelope;
    }

    /**
     * @param mixed $envelope
     */
    public function setEnvelope($envelope)
    {
        $this->envelope = $envelope;
        return $this;
    }

    /**
     * @param Model\EnvelopeTemplate $template
     */
    public function setTemplate(EnvelopeTemplate $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return Model\EnvelopeTemplate
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return mixed
     */
    public function getFolderOneId()
    {
        return $this->folderOneId;
    }

    /**
     * @param mixed $folderOneId
     */
    public function setFolderOneId($folderOneId)
    {
        $this->folderOneId = $folderOneId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFolderTwoId()
    {
        return $this->folderTwoId;
    }

    /**
     * @param mixed $folderTwoId
     */
    public function setFolderTwoId($folderTwoId)
    {
        $this->folderTwoId = $folderTwoId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }

    /**
     * @param mixed $createdUserId
     */
    public function setCreatedUserId($createdUserId)
    {
        $this->createdUserId = $createdUserId;
        return $this;
    }
}

?>