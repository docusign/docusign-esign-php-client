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

class DocuSign_LoginService extends DocuSign_Service {

	public $login;

	/**
	* Constructs the internal representation of the DocuSign Login service.
	*
	* @param DocuSign_Client $client
	*/
	public function __construct(DocuSign_Client $client) {
		parent::__construct($client);
		$this->login = new DocuSign_LoginResource($this);
	}
}

class DocuSign_LoginResource extends DocuSign_Resource {

	public function __construct(DocuSign_Service $service) {
		parent::__construct($service);
		$this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/login_information';
	}


	public function getLoginInformation() {
		return $this->curl->makeRequest($this->url, 'GET', $this->client->getHeaders());
	}


	public function getToken() {
		$this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/oauth2/token';
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/x-www-form-urlencoded'
		);
		$data = array (
			'grant_type' => 'password',
			'scope' => 'api',
			'client_id' => $this->client->getCreds()->getIntegratorKey(),
			'username' => $this->client->getCreds()->getEmail(),
			'password' => $this->client->getCreds()->getPassword()
		);
		return $this->curl->makeRequest($this->url, 'POST', $headers, array(), http_build_query($data));
	}


	public function getTokenOnBehalfOf($userName, $bearer) {
		$this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/oauth2/token';
		$headers = array(
			'Authorization: bearer ' . $bearer,
			'Accept: application/json',
			'Content-Type: application/x-www-form-urlencoded'
		);
		$data = array(
			'grant_type' => 'password',
			'scope' => 'api',
			'client_id' => $this->client->getCreds()->getIntegratorKey(),
			'username' => $userName,
			'password' => 'password'
		);
		return $this->curl->makeRequest($this->url, 'POST', $headers, array(), http_build_query($data));
	}


	public function revokeToken($token) {
		$this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/oauth2/revoke';
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/x-www-form-urlencoded'
		);
		$data = array(
			'token' => $token
		);
		return $this->curl->makeRequest($this->url, 'POST', $headers, array(), http_build_query($data));
	}


	public function updatePassword($newPassword) {
		$this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/login_information/password';
		$data = array(
			"currentPassword" => $this->client->getCreds()->getPassword(),
			"email" => $this->client->getCreds()->getEmail(),
			"newPassword" => $newPassword
		);
		return $this->curl->makeRequest($this->url, 'PUT', $this->client->getHeaders(), array(), json_encode($data));	
	}

}

?>