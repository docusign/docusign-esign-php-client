<?php

namespace DocuSign\eSign\Test;

use DocuSign\eSign\Client\ApiClient;
use PHPUnit\Framework\TestCase;

/**
 * User: Naveen Gopala
 * Date: 1/25/16
 * Time: 4:58 PM
 */

class OAuthTests extends TestCase
{

    /**
     * scope string to apply
     *
     * @var null
     */
    private $scope = null;

    protected function setUp(): void
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
    }

    public function testOauthUri()
    {
        $uri = $this->config->getApiClient()->getAuthorizationURI($this->config->getIntegratorKey(), $this->scope, $this->config->getReturnUrl(), 'code');
        self::assertStringEndsWith($this->config->getReturnUrl(), $uri);
        echo $uri;
    }

    public function testJwtUser()
    {
        $token = $this->config->getApiClient()->requestJWTUserToken($this->config->getIntegratorKey(), $this->config->getUserId(), $this->config->getClientKey(), $this->scope);
        self::assertInstanceOf('DocuSign\eSign\Client\Auth\OAuthToken', $token[0]);
    }

    public function testJwtApplication()
    {
        $token = $this->config->getApiClient()->requestJWTApplicationToken($this->config->getIntegratorKey(), $this->config->getClientKey(), $this->scope);
        self::assertInstanceOf('DocuSign\eSign\Client\Auth\OAuthToken', $token[0]);
    }

    /**
     * @depends testOauthUri
     */
    public function testAuthorizationCodeLogin()
    {
        # Use printed URL to navigate through browser for authentication
        #  IMPORTANT: after the login, DocuSign will send back a fresh
        # # authorization code as a query param of the redirect URI.
        # # You should set up a route that handles the redirect call to get
        # # that code and pass it to token endpoint as shown in the next
        # # lines:
        # #
        # $code = '';
        # $token = $this->config->getApiClient()->generateAccessToken($this->config->getIntegratorKey(), $this->config->getClientSecret(), $code);

        # self::assertInstanceOf('DocuSign\eSign\Client\Auth\OAuthToken', $token[0]);

        # echo $token[0];

        # $user = $this->config->getApiClient()->getUserInfo($token[0]['access_token']);
        # self::assertInstanceOf('DocuSign\eSign\Client\Auth\UserInfo', $user[0]);
        # self::assertSame(200, $user[1]);

        # $loginAccount = $user[0]['accounts'][0];
        # if (isset($loginInformation)) {
        #     $accountId = $loginAccount->getAccountId();
        #     if (!empty($accountId)) {
        #         $this->config->setAccountId($accountId);
        #     }
        # }
    }


}
