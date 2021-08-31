<?php
/**
 * User: Naveen Gopala
 * Date: 1/25/16
 * Time: 4:58 PM
 */
use DocuSign\eSign\Api\AccountsApi;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions;
use DocuSign\eSign\Api\EnvelopesApi\GetEnvelopeOptions;
use DocuSign\eSign\Api\EnvelopesApi\ListStatusChangesOptions;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\ErrorDetails;
use DocuSign\eSign\Model\Recipients;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\Number;
use DocuSign\eSign\Model\Date;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\TemplateRole;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\RecipientViewRequest;
use DocuSign\eSign\Model\ConsoleViewRequest;
use DocuSign\eSign\Model\ReturnUrlRequest;
use PHPUnit\Framework\TestCase;

class UnitTests extends TestCase
{

    /*
	 * Test 0 - login
	 */
    public function testLogin()
    {
        $testConfig = new TestConfig();

        $config = new Configuration();
        $config->setHost($testConfig->getHost());

        $testConfig->setApiClient(new ApiClient($config));
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

        $testConfig->setApiClient(new ApiClient());

        $this->config = $testConfig;

        $oAuth = $this->config->getApiClient()->getOAuth();
        $oAuth->setBasePath($testConfig->getHost());
        $this->scope = [
            ApiClient::$SCOPE_SIGNATURE,
            ApiClient::$SCOPE_IMPERSONATION
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
        $templateRole = new TemplateRole();
	    $templateRole->setEmail($testConfig->getRecipientEmail());
	    $templateRole->setName($testConfig->getRecipientName());
	    $templateRole->setRoleName($testConfig->getTemplateRoleName());

        $definitionData = [
            'email_subject' => 'Please Sign my PHP SDK Envelope',
            'email_blurb'   => 'Hello, Please sign my PHP SDK Envelope.',
            'template_id'   => $testConfig->getTemplateId(),
            'status'        => 'sent' //send the envelope by setting |status| to "sent". To save as a draft set to "created"
        ];
        $envelopeDefinition = new EnvelopeDefinition($definitionData);
        $envelopeDefinition->setTemplateRoles(array($templateRole));

        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());
        $envelopeSummary = $envelopeApi->createEnvelope($testConfig->getAccountId(), $envelopeDefinition);

        $this->assertNotEmpty($envelopeSummary);
        $this->assertInstanceOf('DocuSign\eSign\Model\EnvelopeSummary', $envelopeSummary);
        $this->assertNotEmpty($envelopeSummary->getEnvelopeId());

        $testConfig->setEnvelopeId($envelopeSummary->getEnvelopeId());

        return $testConfig;
    }

    /**
     * @depends testCreateEnvelope
     */
    public function testGetFormData($testConfig)
    { 
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());    
        $envelopeFormData = $envelopeApi->getFormData( $testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $this->assertNotNull($envelopeFormData);
        $this->assertNotNull($envelopeFormData->getFormData());
        $this->assertNotNull($envelopeFormData->getFormData()[0]);
        $this->assertNotNull($envelopeFormData->getFormData()[0]->getName());
        $this->assertNotNull($envelopeFormData->getPrefillFormData());
        $this->assertNotNull($envelopeFormData->getPrefillFormData()->getFormData());
        $this->assertNotNull($envelopeFormData->getPrefillFormData()->getFormData()[0]);
        $this->assertNotNull($envelopeFormData->getPrefillFormData()->getFormData()[0]->getName());
    }

    /**
     * @depends testCreateEnvelope
     */
    public function testListTabs($testConfig)
    { 
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $createdEnvelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $recipients = $envelopesApi->listRecipients($testConfig->getAccountId(), $createdEnvelope->getEnvelopeId());
        $tabs = $envelopesApi->listTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipients->getSigners()[0]->getRecipientId());
        $listTabs = $tabs->getListTabs();

        $this->assertNotNull($listTabs);
        $this->assertContainsOnlyInstancesOf('DocuSign\eSign\Model\ModelList', $listTabs);

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

        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        // Add a document to the envelope
        $document = new Document();
        $document->setDocumentBase64(base64_encode(file_get_contents(__DIR__ . $documentFileName)));
        $document->setName($documentName);
        $document->setDocumentId("1");

        // Create a |SignHere| tab somewhere on the document for the recipient to sign
        $signHere = new SignHere();
        $signHere->setXPosition("100");
        $signHere->setYPosition("100");
        $signHere->setDocumentId("1");
        $signHere->setPageNumber("1");
        $signHere->setRecipientId("1");

        $numberTab = new Number();
        $numberTab->setXPosition("100");
        $numberTab->setYPosition("100");
        $numberTab->setDocumentId("1");
        $numberTab->setPageNumber("1");
        $numberTab->setRecipientId("1");

        $dateTab = new Date();
        $dateTab->setXPosition("100");
        $dateTab->setYPosition("100");
        $dateTab->setDocumentId("1");
        $dateTab->setPageNumber("1");
        $dateTab->setRecipientId("1");

        $tabs = new Tabs();
        $tabs->setSignHereTabs(array($signHere));
        $tabs->setNumberTabs(array($numberTab));
        $tabs->setDateTabs(array($dateTab));

        $signer = new Signer();
        $signer->setEmail($testConfig->getRecipientEmail());
        $signer->setName($testConfig->getRecipientName());
        $signer->setRecipientId("1");
        if ($embeddedSigning) {
            $signer->setClientUserId($testConfig->getClientUserId());
        }

        $signer->setTabs($tabs);

        // Add a recipient to sign the document
        $recipients = new Recipients();
        $recipients->setSigners(array($signer));

        $envelop_definition = new EnvelopeDefinition();
        $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Please sign this doc");

        // set envelope status to "sent" to immediately send the signature request
        $envelop_definition->setStatus($status);
        $envelop_definition->setRecipients($recipients);
        $envelop_definition->setDocuments(array($document));

        $options = new CreateEnvelopeOptions();
        $options->setCdseMode('null');
        $options->setMergeRolesOnDraft('true');
        $options->setChangeRoutingOrder('null');
        $options->setCompletedDocumentsOnly('null');
        $options->setTabLabelExactMatches('null');

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


        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        // assign recipient to template role by setting name, email, and role name.  Note that the
        // template role name must match the placeholder role name saved in your account template.
        $templateRole = new  TemplateRole();
        $templateRole->setEmail($testConfig->getRecipientEmail());
        $templateRole->setName($testConfig->getRecipientName());
        $templateRole->setRoleName($testConfig->getTemplateRoleName());

        $envelop_definition = new EnvelopeDefinition();
        $envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Please sign this template doc");

        // add the role to the envelope and assign valid templateId from your account
        $envelop_definition->setTemplateRoles(array($templateRole));
        $envelop_definition->setTemplateId($testConfig->getTemplateId());

        // set envelope status to "sent" to immediately send the signature request
        $envelop_definition->setStatus("sent");

        $options = new CreateEnvelopeOptions();
        $options->setCdseMode('null');
        $options->setMergeRolesOnDraft('true');
        $options->setChangeRoutingOrder('null');
        $options->setCompletedDocumentsOnly('null');
        $options->setTabLabelExactMatches('null');

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
		$envelopeApi = new EnvelopesApi($testConfig->getApiClient());

		$options = new GetEnvelopeOptions();
		$options->setInclude('null');
        $options->setAdvancedUpdate('true');

	    $envelope = $envelopeApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $options);
		$this->assertNotEmpty($envelope);

	    return $testConfig;
	}

	/**
     * @depends testSignatureRequestOnDocument
     */
	public function testListRecipients($testConfig)
    {
    	$envelopeApi = new EnvelopesApi($testConfig->getApiClient());
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

		$envelopeApi = new EnvelopesApi($testConfig->getApiClient());

		$options = new ListStatusChangesOptions();
        $options->setInclude('null');
		$options->setPowerformids('null');
		$options->setAcStatus('null');
		$options->setBlock('null');
		$options->setSearchText('null');
		$options->setStartPosition('null');
		$options->setStatus('Created');
		$options->setToDate('12.12.2021');
		$options->setTransactionIds('null');
		$options->setUserFilter('null');
		$options->setFolderTypes('null');
		$options->setUserId('null');
		$options->setCount('10');
		$options->setEmail('null');
		$options->setEnvelopeIds('null');
		$options->setExclude('null');
		$options->setFolderIds('null');
		$options->setFromDate(date("Y-m-d", strtotime("-30 days")));
		$options->setCustomField('test=test');
		$options->setFromToStatus('created');
		$options->setIntersectingFolderIds('null');
		$options->setOrder('null');
		$options->setOrderBy('null');
		$options->setUserName('test');
		$options->setCdseMode('null');
		$options->setContinuationToken('null');
		$options->setIncludePurgeInformation('null');
        $options->setLastQueriedDate('null');
        $options->setQueryBudget('null');
        $options->setRequesterDateFormat('null');

		$envelopesInformation = $envelopeApi->listStatusChanges($testConfig->getAccountId(), $options);

		$this->assertNotEmpty($envelopesInformation);

		return $testConfig;
	}

	/**
     * @depends testSignatureRequestOnDocument
     */
    public function testListDocumentsAndDownload($testConfig)
	{
		$envelopeApi = new EnvelopesApi($testConfig->getApiClient());

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

    	$envelopeApi = new EnvelopesApi($testConfig->getApiClient());

		$return_url_request = new ReturnUrlRequest();
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
		$envelopeApi = new EnvelopesApi($testConfig->getApiClient());

		$recipient_view_request = new RecipientViewRequest();
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
		$envelopeApi = new EnvelopesApi($testConfig->getApiClient());

		$console_view_request = new ConsoleViewRequest();
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
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());

        $options = new GetEnvelopeOptions();
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
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $options = new GetEnvelopeOptions();        
        $envelopId = uniqid();
        try
        {
            $createdEnvelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $envelopId);
        }
        catch (\Exception $e)
        {
            $this->assertInstanceOf(ApiException::class, $e); 
            $responseObject = $e->getResponseObject();      
            $this->assertNotNull($responseObject);
            $this->assertInstanceOf(ErrorDetails::class, $responseObject); 
            $this->assertNotEmpty($responseObject->getErrorCode()); 
            $this->assertNotEmpty($responseObject->getMessage()); 

            $responseHeaders = $e->getResponseHeaders();
            $this->assertArrayHasKey('X-DocuSign-TraceToken',$responseHeaders);            
        }
        return $testConfig;
    }

    /**
     * @depends testLogin
     */
    public function testUpdateBrandResourcesByContentTypeTest($testConfig)
    {       
        $accountsApi = new AccountsApi($testConfig->getApiClient());
        $brandFile = "/Docs/brand.xml";
        $brandResources = $accountsApi->updateBrandResourcesByContentType($testConfig->getAccountId(),$testConfig->getBrandId(),'email',new SplFileObject(__DIR__ . $brandFile));

        $this->assertNotEmpty($brandResources);
        $this->assertInstanceOf('DocuSign\eSign\Model\BrandResources', $brandResources);
        return $testConfig;
    }

     /**
     * @depends testLogin
     */
    public function testRecipientsUpdate($testConfig)
    {       
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $createdEnvelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $recipients = $envelopesApi->listRecipients($testConfig->getAccountId(), $createdEnvelope->getEnvelopeId());
        $this->assertNotEmpty($recipients);
        $this->assertNotEmpty($recipients->getSigners());
        $this->assertNotEmpty($recipients->getSigners()[0]);
        $recipients->getSigners()[0]->setClientUserId(uniqid());
        $updateRecipients = $envelopesApi->updateRecipients($testConfig->getAccountId(), $createdEnvelope->getEnvelopeId(),$recipients);
        $this->assertNotEmpty($updateRecipients);
        return $testConfig;
    }
}

?>
