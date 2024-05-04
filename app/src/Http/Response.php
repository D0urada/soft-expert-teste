<?php

namespace App\Http;

use App\Utils\Debug;

class Response
{
	/**
	 * codigo do status HTTP
	 * @var interger
	 */
	private $httpCode = 200;

	/**
	 * cabeçalho do response
	 * @var array
	 */
	private $headers = [];

	/**
	 * tipo do conteudo a ser retornado
	 * @var string
	 */
	private $contentType = 'text/html';

	/**
	 * conteudo do response
	 * @var mixed
	 */
	private $content;

	public function __construct($httpCode, $content, $contentType = 'text/html') 
	{
		$this->httpCode 	= $httpCode;
		$this->content 		= $content;
		$this->setContentType($contentType);
	}

	public function setContentType($contentType)
	{
		$this->contentType 	= $contentType;
		$this->addHeader('Content-Type',$contentType);
		
	}

	public function addHeader($key,$value)
	{
		$this->headers[$key] = $value;
	}

	public function sendResponse()
	{
		$this->sendHeaders();

		switch ($this->contentType) {
			case 'text/html':
				echo $this->content;
				exit;
		}
	}

	private function sendHeaders()
	{
		http_response_code($this->httpCode);

		foreach ($this->headers as $key => $value) {
			header($key.': '.$value);
		}
	}
}
