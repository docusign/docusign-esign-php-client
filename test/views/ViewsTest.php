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
require_once '../src/service/DocuSign_ViewsService.php';

class ViewsTest extends PHPUnit_Framework_TestCase
{
	public $service;

	protected function setUp() {
		global $testConfig;
		$client = new DocuSign_Client($testConfig);
		$this->service = new DocuSign_ViewsService($client);
	}


	public function testGetConsoleView() {
		$response = $this->service->views->getConsoleView();
		$this->assertNotNull($response->url);
	}


	public function testGetSenderView() {
		global $testData;
		$returnUrl = "http://www.docusign.com";
		$response = $this->service->views->getSenderView($returnUrl, $testData->envelope_id);
		$this->assertNotNull($response->url);
	}


	public function testGetRecipientView() {
		global $testData;
		$returnUrl = "http://www.docusign.com";
		$response = $this->service->views->getRecipientView($returnUrl, $testData->envelope_id, $testData->recipient_name, $testData->recipient_email);
		$this->assertNotNull($response->url);
	}

}

?>
