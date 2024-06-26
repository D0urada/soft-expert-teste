<?php

declare(strict_types=1);

namespace App\Http;

use App\Utils\Debug;

class Response
{

  /**
   * Código do status HTTP.
   *
   * @var int
   */
  private $httpCode = 200;

  /**
   * Cabeçalho da resposta HTTP.
   *
   * @var array
   */
  private $headers = [];

  /**
   * Tipo do conteúdo retornado na resposta HTT.
   *
   * @var string
   */
  private $contentType = 'text/html';

  /**
   * Conteúdo retornado na resposta HTTP.
   *
   * @var mixed
   */
  private $content;

  /**
   * Construtor da classe.
   *
   * @param  int $httpCode
   * @param  mixed $content
   * @param  string $contentType
   * @return void
   */
  public function __construct($httpCode, $content, $contentType = 'text/html')
  {
    $this->httpCode = $httpCode;
    $this->content = $content;
    self::setContentType($contentType);
  }

  /**
   * Alterar o tipo do conteúdo da resposta HTTP diretamente no cabeçalho. 
   *
   * @param string $contentType Tipo do conteúdo.
   * @return void
   */
  public function setContentType($contentType)
  {
    $this->contentType = $contentType;
    self::addHeader('Content-Type', $contentType);
  }

  /**
   * Adicionar um cabeçalho à resposta HTTP.
   *
   * @param string $key Chave do cabeçalho
   * @param string $value Valor da chave do cabeçalho
   * @return void
   */
  public function addHeader($key, $value)
  {
    $this->headers[$key] = $value;
  }

  /**
   * Enviar cabeçalho HTTP para o navegador.
   *
   * @return void
   */
  private function sendHeaders()
  {
    http_response_code($this->httpCode);

    foreach ($this->headers as $key => $value) {
      header($key . ': ' . $value);
    }
  }

  /**
   *
   * @return void
   */
  public function sendResponse()
  {
    self::sendHeaders();

    switch ($this->contentType) {
      case 'text/html':
        echo $this->content;
        exit;
    }
  }
}