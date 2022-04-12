<?php

use DocuSign\eSign\Api\AccountsApi;
use DocuSign\eSign\Api\ConnectApi;
use DocuSign\eSign\Api\CustomTabsApi;
use DocuSign\eSign\Api\DiagnosticsApi;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions;
use DocuSign\eSign\Api\EnvelopesApi\GetEnvelopeOptions;
use DocuSign\eSign\Api\EnvelopesApi\ListStatusChangesOptions;
use DocuSign\eSign\Api\FoldersApi;
use DocuSign\eSign\Api\GroupsApi;
use DocuSign\eSign\Api\TemplatesApi;
use DocuSign\eSign\Api\UsersApi;
use DocuSign\eSign\Api\EnvelopesApi\ListStatusOptions;
use DocuSign\eSign\Api\BillingApi;
use DocuSign\eSign\Api\SigningGroupsApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Model\AccountInformation;
use DocuSign\eSign\Model\CustomFieldsEnvelope;
use DocuSign\eSign\Model\DiagnosticsSettingsInformation;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\Envelope;
use DocuSign\eSign\Model\EnvelopeAuditEventResponse;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\ErrorDetails;
use DocuSign\eSign\Model\EnvelopeTemplate;
use DocuSign\eSign\Model\EnvelopeTemplateResults;
use DocuSign\eSign\Model\EnvelopeUpdateSummary;
use DocuSign\eSign\Model\FolderItemsResponse;
use DocuSign\eSign\Model\Checkbox;
use DocuSign\eSign\Model\FoldersResponse;
use DocuSign\eSign\Model\GroupInformation;
use DocuSign\eSign\Model\NewUsersDefinition;
use DocuSign\eSign\Model\NewUsersSummary;
use DocuSign\eSign\Model\PermissionProfileInformation;
use DocuSign\eSign\Model\Recipients;
use DocuSign\eSign\Model\TabMetadataList;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\Number;
use DocuSign\eSign\Model\Date;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\TemplateRole;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\RecipientViewRequest;
use DocuSign\eSign\Model\ConsoleViewRequest;
use DocuSign\eSign\Model\TemplateInformation;
use DocuSign\eSign\Model\TemplateSummary;
use DocuSign\eSign\Model\TemplateUpdateSummary;
use DocuSign\eSign\Model\UserInfo;
use DocuSign\eSign\Model\UserInfoList;
use DocuSign\eSign\Model\UserInformation;
use DocuSign\eSign\Model\UserInformationList;
use DocuSign\eSign\Model\UserSettingsInformation;
use DocuSign\eSign\Model\UsersResponse;
use DocuSign\eSign\Model\ViewUrl;
use DocuSign\eSign\Model\Radio;
use DocuSign\eSign\Model\RadioGroup;
use DocuSign\eSign\Model\Text;
use DocuSign\eSign\Model\ModelList;
use DocuSign\eSign\Model\TemplateRecipients;
use DocuSign\eSign\Model\RecipientsUpdateSummary;
use DocuSign\eSign\Model\EnvelopeIdsRequest;
use DocuSign\eSign\Model\AccountBillingPlanResponse;
use DocuSign\eSign\Model\DocumentFieldsInformation;
use DocuSign\eSign\Model\SigningGroupInformation;
use DocuSign\eSign\Model\TemplateDocumentsResult;
use DocuSign\eSign\Model\Notification;
use DocuSign\eSign\Model\BrandsResponse;
use DocuSign\eSign\Model\EnvelopesInformation;
use DocuSign\eSign\Model\EnvelopeDocumentsResult;
use DocuSign\eSign\Model\TextCustomField;
use DocuSign\eSign\Model\CustomFields;
use DocuSign\eSign\Model\ReturnUrlRequest;
use DocuSign\eSign\Model\CorrectViewRequest;
use DocuSign\eSign\Model\FoldersRequest;
use DocuSign\eSign\Model\BillingChargeResponse;
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
        $tabs = $envelopesApi->listTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipients->getSigners()[1]->getRecipientId());
        $listTabs = $tabs->getListTabs();

        $this->assertNotNull($listTabs);
        $this->assertContainsOnlyInstancesOf('DocuSign\eSign\Model\ModelList', $listTabs);

        return $testConfig;
    }

    /**
     * @depends testLogin
     */
    public function testGetFolders($testConfig)
    {
        $foldersApi = new FoldersApi($testConfig->getApiClient());
        $foldersResponse = $foldersApi->callList($testConfig->getAccountId());

        $this->assertNotEmpty($foldersResponse);
        $this->assertNotEmpty($foldersResponse->getFolders());
        $this->assertInstanceOf(FoldersResponse::class, $foldersResponse);

        $folders = $foldersResponse->getFolders();
        if (count($folders) >= 2) {
            $testConfig->setFolderOneId($folders[0]->getFolderId());
            $testConfig->setFolderTwoId($folders[1]->getFolderId());
        }

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
        $this->assertNotEmpty($envelope->getEnvelopeId());
        $this->assertInstanceOf(Envelope::class, $envelope);

	    return $testConfig;
	}

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testPostAccountConsoleView($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        $viewUrl = $envelopeApi->createConsoleView($testConfig->getAccountId());

        $this->assertNotEmpty($viewUrl);
        $this->assertNotEmpty($viewUrl->getUrl());
        $this->assertInstanceOf(ViewUrl::class, $viewUrl);
    }

    /**
     * @depends testGetEnvelopeInformation
     */
    public function testListAuditEvents($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        $auditEventResponse = $envelopeApi->listAuditEvents($testConfig->getAccountId(), $testConfig->getEnvelopeId());

        $this->assertNotEmpty($auditEventResponse);
        $this->assertNotEmpty($auditEventResponse->getAuditEvents());
        $this->assertInstanceOf(EnvelopeAuditEventResponse::class, $auditEventResponse);
    }

    /**
     * @depends testGetEnvelopeInformation
     */
    public function testListCustomFields($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        $customFields = $envelopeApi->listCustomFields($testConfig->getAccountId(), $testConfig->getEnvelopeId());

        $this->assertNotEmpty($customFields);
        $this->assertInstanceOf(CustomFieldsEnvelope::class, $customFields);
    }

    /**
     * @depends testGetEnvelopeInformation
     */
    public function testUpdateEnvelope($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        $newEnvelope = new Envelope();
        $newEnvelope->setEnvelopeId($testConfig->getEnvelopeId());
        $newEnvelope->setEmailSubject("new email subject");
        $newEnvelope->setEmailBlurb("new email message");

        $envelopeStatus = $envelopeApi->update($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $newEnvelope);

        $this->assertNotEmpty($envelopeStatus);
        $this->assertNotEmpty($envelopeStatus->getEnvelopeId());
        $this->assertInstanceOf(EnvelopeUpdateSummary::class, $envelopeStatus);

        $renewedEnvelope = $envelopeApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $this->assertEquals($renewedEnvelope->getEmailSubject(), $newEnvelope->getEmailSubject());
        $this->assertEquals($renewedEnvelope->getEmailBlurb(), $newEnvelope->getEmailBlurb());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetEnvelopeTemplates($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        $templateInformation = $envelopeApi->listTemplates($testConfig->getAccountId(), $testConfig->getEnvelopeId());

        $this->assertNotEmpty($templateInformation);
        $this->assertNotEmpty($templateInformation->getModelName());
        $this->assertInstanceOf(TemplateInformation::class, $templateInformation);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetUser($testConfig)
    {
        $usersApi = new UsersApi($testConfig->getApiClient());

        $userInformation = $usersApi->getInformation($testConfig->getAccountId(), $testConfig->getUserId());

        $this->assertNotEmpty($userInformation);
        $this->assertNotEmpty($userInformation->getEmail());
        $this->assertInstanceOf(UserInformation::class, $userInformation);

        return $testConfig;
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCallUsersList($testConfig)
    {
        $usersApi = new UsersApi($testConfig->getApiClient());

        $userInformationList = $usersApi->callList($testConfig->getAccountId());

        $this->assertNotEmpty($userInformationList);
        $this->assertNotEmpty($userInformationList->getUsers());
        $this->assertInstanceOf(UserInformationList::class, $userInformationList);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCreateUsers($testConfig)
    {
        $usersApi = new UsersApi($testConfig->getApiClient());

        $userInformation = new UserInformation();
        $userInformation->setEmail('SdkTestUser@gmail.com');
        $userInformation->setFirstName("SdkTest");
        $userInformation->setLastName("User");
        $userInformation->setUserName("SdkTest User");

        $userDefinition = new NewUsersDefinition();
        $userDefinition->setNewUsers([$userInformation]);

        $newUserSummary = $usersApi->create($testConfig->getAccountId(), $userDefinition);

        $this->assertNotEmpty($newUserSummary);
        $this->assertEquals($newUserSummary->getNewUsers()[0]->getEmail(), $userInformation->getEmail());
        $this->assertEquals($newUserSummary->getNewUsers()[0]->getUserName(), $userInformation->getUserName());
        $this->assertInstanceOf(NewUsersSummary::class, $newUserSummary);

        $testConfig->setCreatedUserId($newUserSummary->getNewUsers()[0]->getUserId());

        return $testConfig;
    }

    /**
     * @depends testCreateUsers
     */
    public function testDeleteUsers($testConfig)
    {
        $usersApi = new UsersApi($testConfig->getApiClient());

        $userInfo = new UserInfo();
        $userInfo->setUserId($testConfig->getCreatedUserId());

        $userInformation = new UserInfoList();
        $userInformation->setUsers([$userInfo]);

        $userResponse = $usersApi->delete($testConfig->getAccountId(), $userInformation);

        $this->assertNotEmpty($userResponse);
        $this->assertNotEmpty($userResponse->getUsers());
        $this->assertEquals($userResponse->getUsers()[0]->getUserId(), $testConfig->getCreatedUserId());
        $this->assertInstanceOf(UsersResponse::class, $userResponse);

        $deletedUser = $usersApi->getInformation($testConfig->getAccountId(), $testConfig->getCreatedUserId());

        $this->assertNotEmpty($deletedUser);
        $this->assertEquals($deletedUser->getUserStatus(), "Closed");
        $this->assertInstanceOf(UserInformation::class, $deletedUser);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetUserSettings($testConfig)
    {
        $usersApi = new UsersApi($testConfig->getApiClient());

        $userSettingsInformation = $usersApi->getSettings($testConfig->getAccountId(), $testConfig->getUserId());

        $this->assertNotEmpty($userSettingsInformation);
        $this->assertNotEmpty($userSettingsInformation->getAdminOnly());
        $this->assertInstanceOf(UserSettingsInformation::class, $userSettingsInformation);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetAccountInformation($testConfig)
    {
        $accountsApi = new AccountsApi($testConfig->getApiClient());
        $accountInformation = $accountsApi->getAccountInformation($testConfig->getAccountId());

        $this->assertNotEmpty($accountInformation);
        $this->assertNotEmpty($accountInformation->getAccountName());
        $this->assertInstanceOf(AccountInformation::class, $accountInformation);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetPermissionProfiles($testConfig)
    {
        $accountsApi = new AccountsApi($testConfig->getApiClient());
        $permissionProfileInformation = $accountsApi->listPermissions($testConfig->getAccountId());

        $this->assertNotEmpty($permissionProfileInformation);
        $this->assertNotEmpty($permissionProfileInformation->getPermissionProfiles());
        $this->assertInstanceOf(PermissionProfileInformation::class, $permissionProfileInformation);
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
        $this->assertInstanceOf(Recipients::class, $recipients);

    	return $testConfig;
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testListTemplates($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $envelopeTemplates = $templatesApi->listTemplates($testConfig->getAccountId());

        $this->assertNotEmpty($envelopeTemplates);
        $this->assertNotEmpty($envelopeTemplates->getEnvelopeTemplates());
        $this->assertInstanceOf(EnvelopeTemplateResults::class, $envelopeTemplates);

        $testConfig->setTemplate($envelopeTemplates->getEnvelopeTemplates()[0]);

        return $testConfig;
    }

    /**
     * @depends testListTemplates
     */
    public function testGetTemplate($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $envelopeTemplate = $templatesApi->get($testConfig->getAccountId(), $testConfig->getTemplate()->getTemplateId());

        $this->assertNotEmpty($envelopeTemplate);
        $this->assertNotEmpty($envelopeTemplate->getTemplateId());
        $this->assertInstanceOf(EnvelopeTemplate::class, $envelopeTemplate);
    }

    /**
     * @depends testListTemplates
     */
    public function testPutTemplate($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());

        $existingTemplate = $templatesApi->get($testConfig->getAccountId(), $testConfig->getTemplate()->getTemplateId());
        $existingTemplate->setName("Other name");

        $templateUpdate = $templatesApi->update($testConfig->getAccountId(), $existingTemplate->getTemplateId(), $existingTemplate);

        $this->assertNotEmpty($templateUpdate);
        $this->assertInstanceOf(TemplateUpdateSummary::class, $templateUpdate);

        $renewedTemplate = $templatesApi->get($testConfig->getAccountId(), $existingTemplate->getTemplateId());

        $this->assertEquals($renewedTemplate->getName(), $existingTemplate->getName());
    }

    /**
     * @depends testListTemplates
     */
    public function testPostTemplate($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());

        $documentFileName = "/Docs/SignTest1.pdf";
        $documentName = "SignTest1.docx";

        $document = new Document();
        $document->setDocumentBase64(base64_encode(file_get_contents(__DIR__ . $documentFileName)));
        $document->setName($documentName);
        $document->setDocumentId("1");

        $envelopeTemplate = new EnvelopeTemplate();
        $envelopeTemplate->setDocuments([$document]);

        $templateSummary = $templatesApi->createTemplate($testConfig->getAccountId(), $envelopeTemplate);

        $this->assertNotEmpty($templateSummary);
        $this->assertNotEmpty($templateSummary->getTemplateId());

        $this->assertInstanceOf(TemplateSummary::class, $templateSummary);

        $createdTemplate = $templatesApi->get($testConfig->getAccountId(), $templateSummary->getTemplateId());

        $this->assertNotEmpty($createdTemplate);
        $this->assertEquals($createdTemplate->getDocuments()[0]->getName(), $documentName);
        $this->assertEquals($createdTemplate->getTemplateId(), $templateSummary->getTemplateId());
        $this->assertInstanceOf(EnvelopeTemplate::class, $createdTemplate);
    }

    /**
     * @depends testLogin
     */
    public function testRequestLogSettings($testConfig)
    {
        $diagnosticApi = new DiagnosticsApi($testConfig->getApiClient());
        $diagnosticSettingsInformation = $diagnosticApi->getRequestLogSettings();

        $this->assertNotEmpty($diagnosticSettingsInformation);
        $this->assertNotEmpty($diagnosticSettingsInformation->getModelName());
        $this->assertInstanceOf(DiagnosticsSettingsInformation::class, $diagnosticSettingsInformation);
    }

    /**
     * @depends testLogin
     */
    public function testGetGroups($testConfig)
    {
        $groupsApi = new GroupsApi($testConfig->getApiClient());

        $groupInformation = $groupsApi->listGroups($testConfig->getAccountId());

        $this->assertNotEmpty($groupInformation);
        $this->assertNotEmpty($groupInformation->getGroups());
        $this->assertInstanceOf(GroupInformation::class, $groupInformation);
    }

    /**
     * @depends testLogin
     */
    public function testGetConnectLogs($testConfig)
    {
        $connectApi = new ConnectApi($testConfig->getApiClient());

        $connectLogs = $connectApi->listEventLogs($testConfig->getAccountId());

        $this->assertNotEmpty($connectLogs);
        $this->assertInstanceOf('DocuSign\eSign\Model\ConnectLogs', $connectLogs);
    }

    /**
     * @depends testLogin
     */
    public function testGetCustomTabs($testConfig)
    {
        $customTabsApi = new CustomTabsApi($testConfig->getApiClient());

        $tabMetadata = $customTabsApi->callList($testConfig->getAccountId());

        $this->assertNotEmpty($tabMetadata);
        $this->assertNotEmpty($tabMetadata->getTabs());
        $this->assertInstanceOf(TabMetadataList::class, $tabMetadata);
    }

    /**
     * @depends testGetFolders
     */
    public function testGetFolder($testConfig)
    {
        $foldersApi = new FoldersApi($testConfig->getApiClient());

        $folderItemsResponse = $foldersApi->listItems($testConfig->getAccountId(), $testConfig->getFolderOneId());

        $this->assertNotEmpty($folderItemsResponse);
        $this->assertNotEmpty($folderItemsResponse->getFolders());
        $this->assertInstanceOf(FolderItemsResponse::class, $folderItemsResponse);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testPutDocuments($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());

        $documentFileName = "/Docs/SignTest1.pdf";
        $documentName = "SignTest1.docx";

        $document = new Document();
        $document->setDocumentBase64(base64_encode(file_get_contents(__DIR__ . $documentFileName)));
        $document->setName($documentName);
        $document->setDocumentId("1");

        $envelopeDefinition = new EnvelopeDefinition();
        $envelopeDefinition->setDocuments([$document]);

        $envelopeDocumentsResult = $envelopesApi->updateDocuments($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $envelopeDefinition);

        $this->assertNotEmpty($envelopeDocumentsResult);
        $this->assertNotEmpty($envelopeDocumentsResult->getEnvelopeId());
        $this->assertInstanceOf('\DocuSign\eSign\Model\EnvelopeDocumentsResult', $envelopeDocumentsResult);

        $addedDocument = $envelopesApi->getDocument($testConfig->getAccountId(), $document->getDocumentId(), $testConfig->getEnvelopeId());

        $this->assertNotEmpty($addedDocument);
        $this->assertInstanceOf(SplFileObject::class, $addedDocument);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testDeleteRecipient($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());

        $recipients = $envelopesApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $totalRecipients = $recipients->getRecipientCount();

        $recipients = $envelopesApi->deleteRecipient($testConfig->getAccountId(), $testConfig->getEnvelopeId(), "1");

        $this->assertNotEmpty($recipients);
        $this->assertInstanceOf(Recipients::class, $recipients);

        $recipients = $envelopesApi->listRecipients($testConfig->getAccountId(),  $testConfig->getEnvelopeId());
        $totalRecipientsAfterDelete = $recipients->getRecipientCount();

        $this->assertEquals($totalRecipientsAfterDelete + 1, $totalRecipients);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testUpdateEnvelopeRecipients($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());
        
        // create new recipient
        $signHere1 = new SignHere([
            'name' => 'SignHereTab',
            'x_position' => '75',
            'y_position' => '572',
            'tab_label' => 'SignHereTab',
            'page_number' => '1',
            'document_id' => '1',
            'recipient_id' => '1'
        ]);
        $signer1Tabs = new Tabs;
        $signer1Tabs->setSignHereTabs(array($signHere1));
        $recipientName = 'Test Test';
        $recipientEmail = 'testRecipientEmail@test.com';
        $signer1 = new Signer([
            'name' => $recipientName,
            'email' => $recipientEmail,
            'routing_order' => '1',
            'status' => 'created',
            'delivery_method' => 'Email',
            'recipient_id' => '1', #represents your {RECIPIENT_ID}
            'tabs' => $signer1Tabs,
            'id_check_configuration_name' => 'ID Check'
        ]);
        $recipients = new Recipients;
        $recipients->setSigners(array($signer1));
        
        // update recipients
        $response = $envelopeApi->updateRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipients);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(RecipientsUpdateSummary::class, $response);
        
        // get new recipients
        $recipients = $envelopeApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $signers = $recipients->getSigners();

        // signer is newly added recipient
        $this->assertEquals($recipientName, $signers[0]->getName());
        $this->assertEquals($recipientEmail, $signers[0]->getEmail());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCreateEnvelopeRecipientTabs($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());
        $recipients = $envelopeApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $signers = $recipients->getSigners();
        $recipientId = $signers[0]->getRecipientId();

        // new tab
        $name = 'CustomSignHereTab';
        $sign_here = new SignHere([
            'name' => $name,
            'anchor_units' => 'pixels',
            'anchor_y_offset' => '123', 
            'anchor_x_offset' => '234',
            'document_id' => '1',
            'page_number' => '1',
            'recipient_id' => '1'
        ]);
        $tabs = new Tabs(['sign_here_tabs' => [$sign_here]]);

        // creating new tab
        $response = $envelopeApi->createTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipientId, $tabs);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(Tabs::class, $response);

        // new tab has same name
        $tabs = $envelopeApi->listTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipientId);
        $signHereTabs = $tabs->getSignHereTabs();
        $lastTabKey = array_key_last($signHereTabs);
        $this->assertEquals($signHereTabs[$lastTabKey]->getName(), $name);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testUpdateEnvelopeRecipientTabs($testConfig)
    {
        $envelopeApi = new EnvelopesApi($testConfig->getApiClient());

        // get recipient id
        $recipients = $envelopeApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $signers = $recipients->getSigners();
        $recipientId = $signers[0]->getRecipientId();

        // get tabs
        $tabs = $envelopeApi->listTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipientId);
        $this->assertInstanceOf(Tabs::class, $tabs);
        
        // setting new height
        $signHereTabs = $tabs->getSignHereTabs();
        $oldHeight = $signHereTabs[0]->getHeight();
        $newHeight = $oldHeight + 1;
        $signHereTabs[0]->setHeight($newHeight);
        
        // update tabs
        $response = $envelopeApi->updateTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipientId, $tabs);
        $this->assertInstanceOf(Tabs::class, $response);
        
        // get tabs again
        $updatedTabs = $envelopeApi->listTabs($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipientId);
        $signHereTabs = $updatedTabs->getSignHereTabs();
        
        $this->assertEquals($newHeight, $signHereTabs[0]->getHeight());
    }

    /**
     * @depends testLogin
     */
    public function testAddRecipientToTemplate($testConfig)
    {
        // new signer
        $recipientId = '123';
        $firstName = 'TestSignerFirstName';
        $lastName = 'TestSignerLastName';
        $signer = new Signer([
            'role_name' => 'signer', 
            'recipient_id' => $recipientId, 
            'routing_order' => '1',
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);
        $sign_here = new SignHere(['document_id' => '1', 'page_number' => '1',
            'x_position' => '191', 'y_position' => '148']);
        $check1 = new Checkbox(['document_id' => '1', 'page_number' => '1',
            'x_position' => '75', 'y_position' => '417', 'tab_label' => 'ckAuthorization']);
        $check2 = new Checkbox(['document_id' => '1', 'page_number' => '1',
            'x_position' => '75', 'y_position' => '447', 'tab_label' => 'ckAuthentication']);
        $check3 = new Checkbox(['document_id' => '1', 'page_number' => '1',
            'x_position' => '75', 'y_position' => '478', 'tab_label' => 'ckAgreement']);
        $check4 = new Checkbox(['document_id' => '1', 'page_number' => '1',
            'x_position' => '75', 'y_position' => '508', 'tab_label' => 'ckAcknowledgement']);
        $list1 = new ModelList([
            'font' => "helvetica",
            'font_size' => "size11",
            'anchor_string' => '/l1q/',
            'anchor_y_offset' => '-10', 'anchor_units' => 'pixels',
            'anchor_x_offset' => '0',
            'list_items' => [
                    ['text' => "Red"   , 'value' => "red"   ], ['text' => "Orange", 'value' => "orange"],
                    ['text' => "Yellow", 'value' => "yellow"], ['text' => "Green" , 'value' => "green" ],
                    ['text' => "Blue"  , 'value' => "blue"  ], ['text' => "Indigo", 'value' => "indigo"]
                ],
            'required' => "true",
            'tab_label' => "l1q"
        ]);
        $number1 = new Number(['document_id' => "1", 'page_number' => "1",
            'x_position' => "163", 'y_position' => "260",
            'font' => "helvetica", 'font_size' => "size14", 'tab_label' => "numbersOnly",
            'width' => "84", 'required' => "false"]);
        $radio_group = new RadioGroup(['document_id' => "1", 'group_name' => "radio1",
            'radios' => [
                new Radio(['page_number' => "1", 'x_position' => "142", 'y_position' => "384",
                    'value' => "white", 'required' => "false"]),
                new Radio(['page_number' => "1", 'x_position' => "74", 'y_position' => "384",
                    'value' => "red", 'required' => "false"]),
                new Radio(['page_number' => "1", 'x_position' => "220", 'y_position' => "384",
                    'value' => "blue", 'required' => "false"])
            ]]);
        $text = new Text(['document_id' => "1", 'page_number' => "1",
            'x_position' => "153", 'y_position' => "230",
            'font' => "helvetica", 'font_size' => "size14", 'tab_label' => "text",
            'height' => "23", 'width' => "84", 'required' => "false"]);
        $signer->setTabs(new Tabs(['sign_here_tabs' => [$sign_here],
            'checkbox_tabs' => [$check1, $check2, $check3, $check4], 'list_tabs' => [$list1],
            'number_tabs' => [$number1], 'radio_group_tabs' => [$radio_group], 'text_tabs' => [$text]
        ]));

        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $recipients = new TemplateRecipients(['signers' => [$signer]]);

        // get recipients before 
        $recipientsBefore = $templatesApi->listRecipients($testConfig->getAccountId(), $testConfig->getTemplateId());
        $this->assertInstanceOf(Recipients::class, $recipientsBefore);

        // add recipient
        $response = $templatesApi->createRecipients($testConfig->getAccountId(), $testConfig->getTemplateId(), $recipients);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(Recipients::class, $response);

        // signer with same attributes
        $recipientsAfter = $templatesApi->listRecipients($testConfig->getAccountId(), $testConfig->getTemplateId());
        $signersAfter = $recipientsAfter->getSigners();
        $lastSignerKey = array_key_last($signersAfter);
        $this->assertEquals($recipientId, $signersAfter[$lastSignerKey]->getRecipientId());       
        $this->assertEquals($firstName, $signersAfter[$lastSignerKey]->getFirstName());       
        $this->assertEquals($lastName, $signersAfter[$lastSignerKey]->getLastName());       
    }

    /**
     * @depends testLogin
     * @depends testAddRecipientToTemplate
     */
    public function testGetTemplateRecipients($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $response = $templatesApi->listRecipients($testConfig->getAccountId(), $testConfig->getTemplateId());

        $this->assertNotEmpty($response);
        $this->assertInstanceOf(Recipients::class, $response);
        $this->assertInstanceOf(Signer::class, $response->getSigners()[0]);
    }

    /**
     * @depends testLogin
     * @depends testAddRecipientToTemplate
     */
    public function testDeleteTemplateRecipient($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());

        // get recipients
        $recipients = $templatesApi->listRecipients($testConfig->getAccountId(), $testConfig->getTemplateId());
        $totalRecipients = $recipients->getRecipientCount();
        
        // get recipient id
        $signers = $recipients->getSigners();
        $recipientId = $signers[0]->getRecipientId();
        
        // delete recipient
        $response = $templatesApi->deleteRecipient($testConfig->getAccountId(), $recipientId, $testConfig->getTemplateId());
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(Recipients::class, $response);

        // get recipients again
        $recipients = $templatesApi->listRecipients($testConfig->getAccountId(), $testConfig->getTemplateId());
        $totalRecipientsAfterDelete = $recipients->getRecipientCount();

        // recipient was deleted 
        $this->assertEquals($totalRecipients - 1, $totalRecipientsAfterDelete);
    }

    /**
     * @depends testLogin
     */
    public function testGetBilingPlan($testConfig)
    {
        $billingApi = new BillingApi($testConfig->getApiClient());
        $billingPlan = $billingApi->getPlan($testConfig->getAccountId());

        $this->assertNotEmpty($billingPlan);
        $this->assertInstanceOf(AccountBillingPlanResponse::class, $billingPlan);
        $this->assertNotEmpty($billingPlan->getPaymentMethod());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testListDocumentFields($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $documentFields = $envelopesApi->listDocumentFields((string) $testConfig->getAccountId(), (string) 1, (string) $testConfig->getEnvelopeId());

        $this->assertNotEmpty($documentFields);
        $this->assertInstanceOf(DocumentFieldsInformation::class, $documentFields);
    }

    /**
     * @depends testLogin
     */
    public function testSigningGroupsApiCallList($testConfig)
    {
        $signingGroupsApi = new SigningGroupsApi($testConfig->getApiClient());
        $signingGroups = $signingGroupsApi->callList($testConfig->getAccountId());
        
        $this->assertNotEmpty($signingGroups);
        $this->assertInstanceOf(SigningGroupInformation::class, $signingGroups);
    }

    /**
     * @depends testLogin
     */
    public function testlistDocuments($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $templateDocuments = $templatesApi->listDocuments($testConfig->getAccountId(), $testConfig->getTemplateId());
        
        $this->assertNotEmpty($templateDocuments);
        $this->assertInstanceOf(TemplateDocumentsResult::class, $templateDocuments);
        $this->assertNotEmpty($templateDocuments->getTemplateId());
    }
    
    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetNotificationSettings($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $notificationSettings = $envelopesApi->getNotificationSettings($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        
        $this->assertNotEmpty($notificationSettings);
        $this->assertInstanceOf(Notification::class, $notificationSettings);
    }

    /**
     * @depends testLogin
     */
    public function testTemplatesApiGetDocument($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $document = $templatesApi->getDocument($testConfig->getAccountId(), (string) 1, $testConfig->getTemplateId());

        $this->assertNotEmpty($document);
        $this->assertInstanceOf(\SplFileObject::class, $document);
    }

    /**
     * @depends testLogin
     */
    public function testListBrands($testConfig)
    {
        $accountsApi = new AccountsApi($testConfig->getApiClient());
        $brands = $accountsApi->listBrands($testConfig->getAccountId());

        $this->assertNotEmpty($brands);
        $this->assertInstanceOf(BrandsResponse::class, $brands);
        $this->assertNotEmpty($brands->getSenderBrandIdDefault());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testGetDocumentTabs($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $documentTabs = $envelopesApi->getDocumentTabs($testConfig->getAccountId(), (string) 1, $testConfig->getEnvelopeId());

        $this->assertNotEmpty($documentTabs);
        $this->assertInstanceOf(Tabs::class, $documentTabs);
    }

    /**
     * @depends testLogin
     */
    public function testGetBillingCharges($testConfig)
    {
        $accountsApi = new AccountsApi($testConfig->getApiClient());
        $billingCharges = $accountsApi->getBillingCharges($testConfig->getAccountId());

        $this->assertNotEmpty($billingCharges);
        $this->assertInstanceOf(BillingChargeResponse::class, $billingCharges);
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testDeleteRecipients($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $recipientsBeforeDelete = $envelopesApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());

        $result = $envelopesApi->deleteRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $recipientsBeforeDelete);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(Recipients::class, $result);

        // recipients after delete
        $recipientsAfterDelete = $envelopesApi->listRecipients($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $this->assertEquals(0, $recipientsAfterDelete->getRecipientCount());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testDeleteDocuments($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());

        // create new document
        $documentFileName = "/Docs/SignTest1.pdf";
        $documentName = "SignTest1.docx";
        $documentId = '66';
        $document = new Document();
        $document->setDocumentBase64(base64_encode(file_get_contents(__DIR__ . $documentFileName)));
        $document->setName($documentName);
        $document->setDocumentId($documentId);
        $envelopeDefinition = new EnvelopeDefinition();
        $envelopeDefinition->setDocuments([$document]);

        // add new document to envelope
        $envelopesApi->updateDocuments($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $envelopeDefinition);

        // delete this document
        $result = $envelopesApi->deleteDocuments($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $envelopeDefinition);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(EnvelopeDocumentsResult::class, $result);
        
        // document does not exist after delete 
        try
        {
            $envelopesApi->getDocument($testConfig->getAccountId(), $documentId, $testConfig->getEnvelopeId());
        }
        catch (\Exception $e)
        {
            $this->assertInstanceOf(ApiException::class, $e); 
            $responseBody = $e->getResponseBody();      
            $this->assertNotNull($responseBody);
            $this->assertEquals("DOCUMENT_DOES_NOT_EXIST",$responseBody->errorCode); 
            $this->assertNotEmpty("The document specified was not found.",$responseBody->message); 

            $responseHeaders = $e->getResponseHeaders();
            $this->assertArrayHasKey('X-DocuSign-TraceToken',$responseHeaders);            
        }
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCreateCustomFields($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());

        // new text custom field
        $customFieldName = 'new custom field';
        $customFieldValue = '7654321';
        $customField = new TextCustomField([
            'name' => $customFieldName,
            'required' => 'false',
            'show' => 'true', # Yes, include in the CoC
            'value' => $customFieldValue
        ]);
        $customFields = new CustomFields();
        $customFields->setTextCustomFields([$customField]);

        // add new custom field
        $result = $envelopesApi->createCustomFields($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $customFields);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(CustomFields::class, $result);

        // check that custom field was added
        $customFieldsAfterCreation = $envelopesApi->listCustomFields($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $textCustomFields = $customFieldsAfterCreation->getTextCustomFields();

        $this->assertEquals($customFieldName, $textCustomFields[0]->getName());
        $this->assertEquals($customFieldValue, $textCustomFields[0]->getValue());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCreateEditView($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $viewRequest = new ReturnUrlRequest();
        $viewRequest->setReturnUrl('https://www.google.com/');
        
        $result = $envelopesApi->createEditView($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $viewRequest);
        
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(ViewUrl::class, $result);
    }
    
    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testCreateCorrectView($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $viewRequest = new CorrectViewRequest();
        $viewRequest->setReturnUrl('https://www.google.com/');
        $viewRequest->setViewUrl('https://www.google.com/');

        $result = $envelopesApi->createCorrectView($testConfig->getAccountId(), $testConfig->getEnvelopeId(), $viewRequest);
        
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(ViewUrl::class, $result);
    }

    /**
     * @depends testLogin
     */
    public function testTemplatesApiCreateEditView($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $returnUrlRequest = new ReturnUrlRequest();
        $returnUrlRequest->setReturnUrl('https://www.google.com/');

        $result = $templatesApi->createEditView($testConfig->getAccountId(), $testConfig->getTemplateId(), $returnUrlRequest);

        $this->assertNotEmpty($result);
        $this->assertInstanceOf(ViewUrl::class, $result);
    }

    /**
     * @depends testLogin
     */
    public function testUpdateDocuments($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        
        // create new document
        $documentFileName = "/Docs/SignTest1.pdf";
        $documentName = "SignTest1.docx";
        $documentId = '66';
        $document = new Document();
        $document->setDocumentBase64(base64_encode(file_get_contents(__DIR__ . $documentFileName)));
        $document->setName($documentName);
        $document->setDocumentId($documentId);
        $envelopeDefinition = new EnvelopeDefinition();
        $envelopeDefinition->setDocuments([$document]);

        // add new document to template
        $result = $templatesApi->updateDocuments($testConfig->getAccountId(), $testConfig->getTemplateId(), $envelopeDefinition);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(TemplateDocumentsResult::class, $result);

        // get newly added document
        $addedDocument = $templatesApi->getDocument($testConfig->getAccountId(), $documentId, $testConfig->getTemplateId());
        $this->assertNotEmpty($addedDocument);
        $this->assertInstanceOf(\SplFileObject::class, $addedDocument);
    }

    /**
     * @depends testLogin
     */
    public function testUpdateGroupShare($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $groupsApi = new GroupsApi($testConfig->getApiClient());
        $groupInformation = $groupsApi->listGroups($testConfig->getAccountId());
        
        // share template with group
        $result = $templatesApi->updateGroupShare($testConfig->getAccountId(), $testConfig->getTemplateId(), 'groups', $groupInformation);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(GroupInformation::class, $result);
        
        // template became shared
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        $template = $templatesApi->get($testConfig->getAccountId(), $testConfig->getTemplateId());
        $this->assertNotEmpty($template);
        $this->assertInstanceOf(EnvelopeTemplate::class, $template);
        $this->assertEquals('true', $template->getShared());
    }

    /**
     * @depends testLogin
     */
    public function testUpdateRecipients($testConfig)
    {
        $templatesApi = new TemplatesApi($testConfig->getApiClient());
        
        // create new recipient
        $signHere1 = new SignHere([
            'name' => 'SignHereTab',
            'x_position' => '75',
            'y_position' => '572',
            'tab_label' => 'SignHereTab',
            'page_number' => '1',
            'document_id' => '1',
            'recipient_id' => '1'
        ]);
        $signer1Tabs = new Tabs;
        $signer1Tabs->setSignHereTabs(array($signHere1));
        $recipientName = 'Test Test';
        $recipientEmail = 'testRecipientEmail@test.com';
        $signer1 = new Signer([
            'name' => $recipientName,
            'email' => $recipientEmail,
            'routing_order' => '1',
            'status' => 'created',
            'delivery_method' => 'Email',
            'recipient_id' => '1', #represents your {RECIPIENT_ID}
            'tabs' => $signer1Tabs,
            'id_check_configuration_name' => 'ID Check'
        ]);
        $recipients = new TemplateRecipients;
        $recipients->setSigners(array($signer1));

        // update recipients
        $response = $templatesApi->updateRecipients($testConfig->getAccountId(), $testConfig->getTemplateId(), $recipients);
        $this->assertNotEmpty($response);
        $this->assertInstanceOf(RecipientsUpdateSummary::class, $response);
        
        // get new recipients
        $recipients = $templatesApi->listRecipients($testConfig->getAccountId(), $testConfig->getTemplateId());
        $signers = $recipients->getSigners();

        // signer is newly added recipient
        $this->assertEquals($recipientName, $signers[0]->getName());
        $this->assertEquals($recipientEmail, $signers[0]->getEmail());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testMoveEnvelopes($testConfig)
    {
        $foldersApi = new FoldersApi($testConfig->getApiClient());
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $foldersRequest = new FoldersRequest();
        $foldersRequest->setEnvelopeIds([$testConfig->getEnvelopeId()]);
        
        // get envelope before voiding
        $envelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $this->assertEmpty($envelope->getVoidedDateTime());

        // void envelope
        $result = $foldersApi->moveEnvelopes($testConfig->getAccountId(), 'recyclebin', $foldersRequest);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(FoldersResponse::class, $result);

        // make shure that envelope was voided
        $envelopeAfterVoiding = $envelopesApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $this->assertNotEmpty($envelopeAfterVoiding->getVoidedDateTime());
    }

    /**
     * @depends testSignatureRequestOnDocument
     */
    public function testEnvelopesApiListStatus($testConfig)
    {
        $envelopesApi = new EnvelopesApi($testConfig->getApiClient());
        $envelope = $envelopesApi->getEnvelope($testConfig->getAccountId(), $testConfig->getEnvelopeId());
        $listStatusOptions = new ListStatusOptions();
        $listStatusOptions->setEnvelopeIds($testConfig->getEnvelopeId());
        $listStatusOptions->setTransactionIds($envelope->getTransactionId());

        $envelopeIdsRequest = new EnvelopeIdsRequest();
        $envelopeIdsRequest->setEnvelopeIds([$testConfig->getEnvelopeId()]);
        $envelopeIdsRequest->setTransactionIds([$envelope->getTransactionId()]);

        $status = $envelopesApi->listStatus($testConfig->getAccountId(), $envelopeIdsRequest, $listStatusOptions);
        $this->assertNotEmpty($status);
        $this->assertInstanceOf(EnvelopesInformation::class, $status);
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
		$options->setToDate(date("Y-m-d"));
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
