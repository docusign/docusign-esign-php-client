# Change Log
All notable changes to this project will be documented in this file.

See [DocuSign Support Center](https://support.docusign.com/en/releasenotes/) for Product Release Notes.

## [4.0.0] - eSignature API v19.1.02 - 2019-06-07
### BREAKING
* Moved ApiClient and ApiException under Client folder
### Removed
* empty test placeholder files
### Changed
* updated existing test cases to use JWT instead of the legacy auth (still not fully working yet)
### Added
* OAuth models under Client/Auth folder
* new dependency for OAuth support (firebase/php-jwt)
* OAuthTests.php for OAuth support test
### Fixed
* A bug with that could cause the *moveEnvelopes* method call to return a response without a *Content-Type* header. (DCM-2871)

## [3.0.1] - Fixed the composer version - 2017-10-25

## [3.0.0] - Published all the DocuSign API endpoints - 2017-03-15

## [2.0.0] - New shiny PHP client - 2017-12-05

## [1.0.0] - Old legacy version - 2016-02-18