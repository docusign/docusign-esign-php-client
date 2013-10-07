<?php
/*
 * Copyright 2013 DocuSign Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once 'testConfig.php';
require_once '../src/DocuSign_Client.php';
require_once '../src/service/DocuSign_LoginService.php';

class LoginTest extends PHPUnit_Framework_TestCase
{
	public $service;

	protected function setUp() {
		global $testConfig;
		$client = new DocuSign_Client($testConfig);
		$this->service = new DocuSign_LoginService($client);
	}


	public function testGetLoginInformation() {
		global $testData;
		$response = $this->service->login->getLoginInformation();

		$this->assertEquals($response->loginAccounts[0]->name, $testData->account_name);
		$this->assertEquals($response->loginAccounts[0]->accountId, $testData->account_id);
		$this->assertEquals($response->loginAccounts[0]->userName, $testData->user_name);
		$this->assertEquals($response->loginAccounts[0]->email, $testData->user_email);
	}


	public function testGetToken() {
		$response = $this->service->login->getToken();

		// tokens are 28 chars in length
		$this->assertEquals(strlen($response->access_token), 28);
		$this->assertEquals($response->token_type, 'bearer');
		$this->assertEquals($response->scope, 'api');
	}


	public function testGetTokenOnBehalfOf() {
		global $testData;
		$bearer = $this->service->login->getToken()->access_token;
		$response = $this->service->login->getTokenOnBehalfOf($testData->user_name, $bearer);

		$this->assertEquals(strlen($response->access_token), 28);
		$this->assertEquals($response->token_type, 'bearer');
		$this->assertEquals($response->scope, 'api');
	}


	public function testRevokeToken() {
		$token = $this->service->login->getToken()->access_token;
		$response = $this->service->login->revokeToken($token);

		$this->assertEquals($response, NULL);
	}


	public function testUpdatePassword() {
		$newPassword = '<ENTER NEW PASSWORD HERE>';
		$response = $this->service->login->updatePassword($newPassword);

		$this->assertEquals($response->errorCode, 'INVALID_PASSWORD');
		$this->assertEquals($response->message, 'The password is invalid. Invalid new password: <br>Password must NOT be one of your past 12 passwords.');
	}

}

?>
