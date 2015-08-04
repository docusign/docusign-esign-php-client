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

require_once 'DocuSign_Service.php';
require_once 'DocuSign_Resource.php';

class DocuSign_ViewsService extends DocuSign_Service {

	public $views;

	/**
	* Constructs the internal representation of the DocuSign View service.
	*
	* @param DocuSign_Client $client
	*/
	public function __construct(DocuSign_Client $client) {
		parent::__construct($client);
		$this->views = new DocuSign_ViewsResource($this);
	}
}

class DocuSign_ViewsResource extends DocuSign_Resource {

	public function __construct(DocuSign_Service $service) {
		parent::__construct($service);
	}


	public function getConsoleView() {
		$url = $this->client->getBaseURL() . '/views/console';
		return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders());
	}


	public function getSenderView($returnUrl, $envelopeId) {
		$url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/views/sender';
		$data = array (
			'returnUrl' => $returnUrl
		);
		return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
	}


	public function getRecipientView($returnUrl, $envelopeId, $userName, $email, $clientUserId = NULL, $authMethod = "email") {
		$url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/views/recipient';
		$data = array (
			'returnUrl' => $returnUrl,
			'authenticationMethod' => $authMethod,
			'userName' => $userName,
			'email' => $email,
			'clientUserId' => $clientUserId,
		);
		return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
	}

}

?>