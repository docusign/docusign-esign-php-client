<?php
/**
 * User: Naveen Gopala
 * Date: 1/25/16
 * Time: 4:58 PM
 */
 
use PHPUnit\Framework\TestCase;

class UnitTests extends TestCase
{

    /*
	 * Test 0 - login
	 */
    public function testLogin()
    {
        $testConfig = new TestConfig();

        $config = new DocuSign\eSign\Configuration();
        $config->setHost($testConfig->getHost());

        $testConfig->setApiClient(new DocuSign\eSign\Client\ApiClient($config));
        $testConfig->getApiClient()->getOAuth()->setBasePath($testConfig->getHost());

        $token = $testConfig->getApiClient()->requestJWTUserToken($testConfig->getIntegratorKey(),$testConfig->getUserId(), $testConfig->getClientKey());

        $this->assertInstanceOf('DocuSign\eSign\Client\Auth\OAuthToken', $token[0]);
        $this->assertArrayHasKey('access_token', $token[0]);

        $user = $testConfig->getApiClient()->getUserInfo($token[0]['access_token']);

        $this->assertNotEmpty($user);
        $this->assertEquals($user[1], 200);

        $this->assertInstanceOf('DocuSign\eSign\Client\Auth\UserInfo', $user[0]);
        $this->assertNotEmpty($user[0]);

        $this->assertArrayHasKey('accounts', $user[0]);
        $loginAccount = $user[0]['accounts'][0];
        $accountId = $loginAccount->getAccountId();

        $this->assertNotEmpty($accountId);

        $testConfig->setAccountId($accountId);

        return $testConfig;
    }

    public function testRefreshToken()
    {        
        $testConfig = new TestConfig();

        $testConfig->setApiClient(new DocuSign\eSign\Client\ApiClient());

        $this->config = $testConfig;

        $oAuth = $this->config->getApiClient()->getOAuth();
        $oAuth->setBasePath($testConfig->getHost());
        $this->scope = [
            DocuSign\eSign\Client\ApiClient::$SCOPE_SIGNATURE,
            DocuSign\eSign\Client\ApiClient::$SCOPE_IMPERSONATION
        ];

        $uri = $this->config->getApiClient()->getAuthorizationURI($this->config->getIntegratorKey(), $this->scope, $this->config->getReturnUrl(), 'code');
        $this->assertStringEndsWith($this->config->getReturnUrl(), $uri);
        $this->markTestSkipped(); 
        
        echo $uri; 

         # Use printed URL to navigate through browser for authentication
         # IMPORTANT: after the login, DocuSign will send back a fresh
         # authorization code as a query param of the redirect URI.
         # You should set up a route that handles the redirect call to get
         # that code and pass it to token endpoint as shown in the next lines         
        
        $code = '';
        $initialOAuthToken = $this->config->getApiClient()->generateAccessToken($this->config->getIntegratorKey(), $this->config->getClientSecret(), $code);

        $this->assertInstanceOf('DocuSign\eSign\Client\Auth\OAuthToken', $initialOAuthToken[0]);
        $this->assertArrayHasKey('access_token', $initialOAuthToken[0]);
        $this->assertArrayHasKey('refresh_token', $initialOAuthToken[0]);

        $refreshToken = $initialOAuthToken[0]['refresh_token'];

        $refreshedOAuthToken = $this->config->getApiClient()->refreshAccessToken($this->config->getIntegratorKey(), $this->config->getClientSecret(), $refreshToken);
        $this->assertInstanceOf('DocuSign\eSign\Client\Auth\OAuthToken', $refreshedOAuthToken[0]);
        $this->assertArrayHasKey('access_token', $refreshedOAuthToken[0]);

        $user = $this->config->getApiClient()->getUserInfo($refreshedOAuthToken[0]['access_token']);
        $this->assertNotEmpty($user);
        $this->assertNotEmpty($user[0]);
        $this->assertInstanceOf('DocuSign\eSign\Client\Auth\UserInfo', $user[0]);
        $this->assertSame(200, $user[1]); 
        
        return;
    }

    /**
     *
     * Test creating envelop process
     *
     * @param $testConfig
     * @return mixed
     * @throws \DocuSign\eSign\Client\ApiException
     * @depends testLogin
     */
    function testCreateEnvelope($testConfig)
    {
        $templateRole = new  DocuSign\eSign\Model\TemplateRole();
	    $templateRole->setEmail($testConfig->getRecipientEmail());
	    $templateRole->setName($testConfig->getRecipientName());
	    $templateRole->setRoleName($testConfig->getTemplateRoleName());

        $definitionData = [
            'email_subject' => 'Please Sign my PHP SDK Envelope',
            'email_blurb'   => 'Hello, Please sign my PHP SDK Envelope.',
            'template_id'   => $testConfig->getTemplateId(),
            'status'        => 'sent' //send the envelope by setting |status| to "sent". To save as a draft set to "created"
        ];
        $envelopeDefinition = new DocuSign\eSign\Model\EnvelopeDefinition($definitionData);
        $envelopeDefinition->setTemplateRoles(array($templateRole));

        $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());
        $envelopeSummary = $envelopeApi->createEnvelope($testConfig->getAccountId(), $envelopeDefinition);

        $this->assertNotEmpty($envelopeSummary);
        $this->assertInstanceOf('DocuSign\eSign\Model\EnvelopeSummary', $envelopeSummary);
        $this->assertNotEmpty($envelopeSummary->getEnvelopeId());

        $testConfig->setEnvelopeId($envelopeSummary->getEnvelopeId());

        return $testConfig;
    }


    /**
     * @depends testLogin
     */
    public function testSignatureRequestOnDocument($testConfig, $embeddedSigning = false)
    {
        return $this->signatureRequestOnDocument($testConfig, "sent", $embeddedSigning);
    }

    /**
     * @depends testLogin
     */
    public function testSignatureRequestOnDocumentCreated($testConfig, $embeddedSigning = false)
    {
        return $this->signatureRequestOnDocument($testConfig, "created", $embeddedSigning);
    }

    function signatureRequestOnDocument($testConfig, $status = "sent", $embeddedSigning = false)
	{
		$documentFileName = "/Docs/SignTest1.pdf";
		$documentName = "SignTest1.docx";

		$envelop_summary = null;

        $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

        // Add a document to the envelope
        $document = new DocuSign\eSign\Model\Document();
        $document->setDocumentBase64(base64_encode(file_get_contents(__DIR__ . $documentFileName)));
        $document->setName($documentName);
        $document->setDocumentId("1");

        // Create a |SignHere| tab somewhere on the document for the recipient to sign
        $signHere = new \DocuSign\eSign\Model\SignHere();
        $signHere->setXPosition("100");
        $signHere->setYPosition("100");
        $signHere->setDocumentId("1");
        $signHere->setPageNumber("1");
        $signHere->setRecipientId("1");

        $numberTab = new \DocuSign\eSign\Model\Number();
        $numberTab->setXPosition("100");
        $numberTab->setYPosition("100");
        $numberTab->setDocumentId("1");
        $numberTab->setPageNumber("1");
        $numberTab->setRecipientId("1");

        $dateTab = new \DocuSign\eSign\Model\Date();
        $dateTab->setXPosition("100");
        $dateTab->setYPosition("100");
        $dateTab->setDocumentId("1");
        $dateTab->setPageNumber("1");
        $dateTab->setRecipientId("1");

        $tabs = new DocuSign\eSign\Model\Tabs();
        $tabs->setSignHereTabs(array($signHere));
        $tabs->setNumberTabs(array($numberTab));
        $tabs->setDateTabs(array($dateTab));

        $signer = new \DocuSign\eSign\Model\Signer();
        $signer->setEmail($testConfig->getRecipientEmail());
        $signer->setName($testConfig->getRecipientName());
        $signer->setRecipientId("1");
        if ($embeddedSigning) {
            $signer->setClientUserId($testConfig->getClientUserId());
        }

        $signer->setTabs($tabs);

        // Add a recipient to sign the document
        $recipients = new DocuSign\eSign\Model\Recipients();
        $recipients->setSigners(array($signer));

        $envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
        $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Please sign this doc");

        // set envelope status to "sent" to immediately send the signature request
        $envelop_definition->setStatus($status);
        $envelop_definition->setRecipients($recipients);
        $envelop_definition->setDocuments(array($document));

        $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
        $options->setCdseMode(null);
        $options->setMergeRolesOnDraft(null);

        $envelop_summary = $envelopeApi->createEnvelope($testConfig->getAccountId(), $envelop_definition, $options);

        $this->assertNotEmpty($envelop_summary);

        if ($status == "created") {
            $testConfig->setCreatedEnvelopeId($envelop_summary->getEnvelopeId());
        } else {
            $testConfig->setEnvelopeId($envelop_summary->getEnvelopeId());
        }

		return $testConfig;
	}

	/**
     * @depends testLogin
     */
	public function testRequestSignatureFromTemplate($testConfig)
    {
		$envelop_summary = null;


        $envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

        // assign recipient to template role by setting name, email, and role name.  Note that the
        // template role name must match the placeholder role name saved in your account template.
        $templateRole = new  DocuSign\eSign\Model\TemplateRole();
        $templateRole->setEmail($testConfig->getRecipientEmail());
        $templateRole->setName($testConfig->getRecipientName());
        $templateRole->setRoleName($testConfig->getTemplateRoleName());

        $envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
        $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Please sign this template doc");

        // add the role to the envelope and assign valid templateId from your account
        $envelop_definition->setTemplateRoles(array($templateRole));
        $envelop_definition->setTemplateId($testConfig->getTemplateId());

        // set envelope status to "sent" to immediately send the signature request
        $envelop_definition->setStatus("sent");

        $options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
        $options->setCdseMode(null);
        $options->setMergeRolesOnDraft(null);

        $envelop_summary = $envelopeApi->createEnvelope($testConfig->getAccountId(), $envelop_definition, $options);
        if(!empty($envelop_summary))
        {
//				$testConfig->setEnvelopeId($envelop_summary->getEnvelopeId());
        }

		$this->assertNotEmpty($envelop_summary);

		return $testConfig;
	}

	/**
     * @depends testSignatureRequestOnDocument
     */
	public function testGetEnvelopeInformation($testConfig)
    {
		$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

		$options = new \DocuSign\eSign\Api\EnvelopesApi\GetEnvelopeOptions();
		$options->setInclude(null);

	    $envelope = $envelopeApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $options);
		$this->assertNotEmpty($envelope);

	    return $testConfig;
	}

	/**
     * @depends testSignatureRequestOnDocument
     */
	public function testListRecipients($testConfig)
    {
    	$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());
        $recipients = $envelopeApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());

        $this->assertNotEmpty($recipients);
		$this->assertNotEmpty($recipients->getRecipientCount());

    	return $testConfig;
    }

	/**
	 * @depends testLogin
	 */
	public function testListStatusChanges($testConfig)
	{
		date_default_timezone_set('America/Los_Angeles');

		$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

		$options = new \DocuSign\eSign\Api\EnvelopesApi\ListStatusChangesOptions();
//		$options->setInclude(null);
//		$options->setPowerformids(null);
		$options->setAcStatus(null);
		$options->setBlock(null);
//		$options->setSearchText(null);
		$options->setStartPosition(null);
		$options->setStatus(null);
		$options->setToDate(null);
		$options->setTransactionIds(null);
//		$options->setUserFilter(null);
//		$options->setFolderTypes(null);
//		$options->setUserId(null);
		$options->setCount(10);
		$options->setEmail(null);
		$options->setEnvelopeIds(null);
//		$options->setExclude(null);
//		$options->setFolderIds(null);
		$options->setFromDate(date("Y-m-d", strtotime("-30 days")));
		$options->setCustomField(null);
		$options->setFromToStatus(null);
//		$options->setIntersectingFolderIds(null);
//		$options->setOrder(null);
//		$options->setOrderBy(null);
		$options->setUserName(null);

		$envelopesInformation = $envelopeApi->listStatusChanges($testConfig->getAccountId(), $options);

		$this->assertNotEmpty($envelopesInformation);

		return $testConfig;
	}

	/**
     * @depends testSignatureRequestOnDocument
     */
    public function testListDocumentsAndDownload($testConfig)
	{
		$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

		$docsList = $envelopeApi->listDocuments($testConfig->getAccountId(), $testConfig->getEnvelopeId());
		$this->assertNotEmpty($docsList);
		$this->assertNotEmpty($docsList->getEnvelopeId());

		$docCount = count($docsList->getEnvelopeDocuments());
		if (intval($docCount) > 0)
		{
			foreach($docsList->getEnvelopeDocuments() as $document)
			{
				$this->assertNotEmpty($document->getDocumentId());
				$file = $envelopeApi->getDocument($testConfig->getAccountId(), $document->getDocumentId(), $testConfig->getEnvelopeId());
				$this->assertNotEmpty($file);
			}
		}

    	return $testConfig;
    }

    /**
     * @depends testSignatureRequestOnDocumentCreated
     */
	public function testCreateEmbeddedSendingView($testConfig)
    {
    	$testConfig = $this->testSignatureRequestOnDocument($testConfig, "created", true);

    	$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

		$return_url_request = new \DocuSign\eSign\Model\ReturnUrlRequest();
		$return_url_request->setReturnUrl($testConfig->getReturnUrl());
		
		$senderView = $envelopeApi->createSenderView($testConfig->getAccountId(), $testConfig->getCreatedEnvelopeId(), $return_url_request);

		$this->assertNotEmpty($senderView);
		$this->assertNotEmpty($senderView->getUrl());

    	return $testConfig;
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
	public function testCreateEmbeddedSigningView($testConfig)
    {
		$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

		$recipient_view_request = new \DocuSign\eSign\Model\RecipientViewRequest();
		$recipient_view_request->setReturnUrl($testConfig->getReturnUrl());
		$recipient_view_request->setClientUserId($testConfig->getClientUserId());
		$recipient_view_request->setAuthenticationMethod("email");
		$recipient_view_request->setUserName($testConfig->getRecipientName());
		$recipient_view_request->setEmail($testConfig->getRecipientEmail());

		$signingView = $envelopeApi->createRecipientView($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipient_view_request);

		$this->assertNotEmpty($signingView);
		$this->assertNotEmpty($signingView->getUrl());

    	return $testConfig;
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCreateEmbeddedConsoleView($testConfig)
    {
		$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

		$console_view_request = new \DocuSign\eSign\Model\ConsoleViewRequest();
		$console_view_request->setEnvelopeId($testConfig->getEnvelopeId());
		$console_view_request->setReturnUrl($testConfig->getReturnUrl());

		$view_url = $envelopeApi->createConsoleView($testConfig->getAccountId(), $console_view_request);

		$this->assertNotEmpty($view_url);
		$this->assertNotEmpty($view_url->getUrl());

    	return $testConfig;
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testNumberTabs($testConfig)
    {
        $testConfig = $this->testSignatureRequestOnDocument($testConfig, "created", true);
        $envelopesApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());

        $options = new \DocuSign\eSign\Api\EnvelopesApi\GetEnvelopeOptions();
        $options->setInclude("tabs,recipients");

        $createdEnvelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $recipients = $envelopesApi->listRecipients($testConfig->getAccountId(), $createdEnvelope->getEnvelopeId());
        $tabs = $envelopesApi->listTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipients->getSigners()[0]->getRecipientId());
        $numberTabs = $tabs->getNumberTabs();

        $this->assertNotNull($numberTabs);
        $this->assertEquals(count($numberTabs), 1);

        return $testConfig;
    }

    /**
     * @depends testLogin
     */
    public function testApiException($testConfig)
    {       
        $envelopesApi = new DocuSign\eSign\Api\EnvelopesApi($testConfig->getApiClient());
        $options = new \DocuSign\eSign\Api\EnvelopesApi\GetEnvelopeOptions();        
        $envelopId = uniqid();
        try
        {
            $createdEnvelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $envelopId);
        }
        catch (\Exception $e)
        {
            $this->assertInstanceOf(\DocuSign\eSign\Client\ApiException::class, $e); 
            $responseObject = $e->getResponseObject();      
            $this->assertNotNull($responseObject);
            $this->assertInstanceOf(\DocuSign\eSign\Model\ErrorDetails::class, $responseObject); 
            $this->assertNotEmpty($responseObject->getErrorCode()); 
            $this->assertNotEmpty($responseObject->getMessage()); 
        }
        return $testConfig;
    }

    /**
     * @depends testLogin
     */
    public function testUpdateBrandResourcesByContentTypeTest($testConfig)
    {       
        $accountsApi = new DocuSign\eSign\Api\AccountsApi($testConfig->getApiClient());
        $brandFile = "/Docs/brand.xml";
        $brandResources = $accountsApi->updateBrandResourcesByContentType($testConfig->getAccountId(),$testConfig->getBrandId(),'email',new SplFileObject(__DIR__ . $brandFile));

        $this->assertNotEmpty($brandResources);
        $this->assertInstanceOf('DocuSign\eSign\Model\BrandResources', $brandResources);
        return $testConfig;
    }
}

?>
