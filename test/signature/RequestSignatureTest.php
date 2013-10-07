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
require_once '../src/service/DocuSign_RequestSignatureService.php';

class RequestSignatureTest extends PHPUnit_Framework_TestCase
{
	public $service;

	protected function setUp() {
		global $testConfig;
		$client = new DocuSign_Client($testConfig);
		$this->service = new DocuSign_RequestSignatureService($client);
	}


	public function testCreateEnvelopeFromTemplate() {
		global $testData;
		$emailSubject = "Test envelope for testCreateEnvelopeFromTemplate()";
		$emailBlurb = "Test envelope for testCreateEnvelopeFromTemplate()";
		$status = "created";
		$tempRole = new DocuSign_TemplateRole($testData->template_role, $testData->recipient_name, $testData->recipient_email);
		$templateRoles = array( $tempRole );
		$eventNotifications = array();
		$response = $this->service->signature->createEnvelopeFromTemplate($emailSubject, $emailBlurb, $testData->templateId, $status, $templateRoles, $eventNotifications);

		$this->assertEquals(strlen($response->envelopeId), 36);
		$this->assertEquals($response->status, $status);
		$this->assertNotNull($response->uri);
		$this->assertNotNull($response->statusDateTime);
	}


	public function testCreateEnvelopeFromDocument() {
		global $testData;
		$emailSubject = "Test envelope for testCreateEnvelopeFromDocument()";
		$emailBlurb = "Test envelope for testCreateEnvelopeFromDocument()";
		$status = "created";
		$documents = array( new DocuSign_Document("sample.pdf", "1", file_get_contents("sample.pdf", FILE_USE_INCLUDE_PATH)) );
		$signers = array( new DocuSign_Recipient("1", "1", $testData->recipient_name, $testData->recipient_email) );
		$eventNotifications = array();
		$response = $this->service->signature->createEnvelopeFromDocument($emailSubject, $emailBlurb, $status, $documents, $signers, $eventNotifications);

		$this->assertEquals(strlen($response->envelopeId), 36);
		$this->assertEquals($response->status, $status);
		$this->assertNotNull($response->uri);
		$this->assertNotNull($response->statusDateTime);
	}


	public function testCreateEnvelopeWithNoDocument() {
		global $testData;
		$emailSubject = "Test envelope for testCreateEnvelopeWithNoDocument()";
		$emailBlurb = "Test envelope for testCreateEnvelopeWithNoDocument()";
		$status = "created";
		$signers = array( new DocuSign_Recipient("1", "1", $testData->recipient_name, $testData->recipient_email) );
		$response = $this->service->signature->createEnvelopeFromDocument($emailSubject, $emailBlurb, $status, array(), $signers);

		$this->assertEquals(strlen($response->envelopeId), 36);
		$this->assertEquals($response->status, $status);
		$this->assertNotNull($response->uri);
		$this->assertNotNull($response->statusDateTime);
	}

}

?>
