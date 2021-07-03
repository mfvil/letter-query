<?php


namespace Drupal\letter_query\Plugin\views;

use Drupal\Component\Serialization\Json;


class letterQueryClient {

  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * LetterQueryClient constructor.
   *
   * @param $http_client_factory \Drupal\Core\Http\ClientFactory
   */
  public function __construct($http_client_factory) {
    $this->client = $http_client_factory->fromOptions([
      'base_uri' => '****',
    ]);
  }


  public function getLetters() {
    $response = $this->client->get('****');
    $data = Json::decode($response->getBody());
    return $data;
}

}
