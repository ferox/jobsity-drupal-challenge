<?php

namespace Drupal\spotify_client\Service;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use GuzzleHttp\ClientInterface;

/**
 * SpotifyClientRequestService service.
 */
class SpotifyClientRequestService {

  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * The logger channel factory.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $logger;

  /**
   * The string translation service.
   *
   * @var \Drupal\Core\StringTranslation\TranslationInterface
   */
  protected $stringTranslation;

  /**
   * Constructs a SpotifyClientRequestService object.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_channel_interface
   *   The logger channel factory.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The string translation service.
   */
  public function __construct(
    ClientInterface $http_client,
    LoggerChannelFactoryInterface $logger_channel_interface,
    TranslationInterface $string_translation
  ) {
    $this->httpClient = $http_client;
    $this->logger = $logger_channel_interface->get('spotify_client');
    $this->stringTranslation = $string_translation;
  }

  /**
   * Authorization.
   * @return object|null
   *    The Authorization object or null
   */
  protected function authorization()
  {
    try {
      $params = [
        'form_params' =>
          [
            'grant_type'    => 'client_credentials',
            'client_id' => '11b785a3b4a44158926833971addc2fc',
            'client_secret' => '8451b315c2bb439aa585a448dc468db6'
          ],
      ];
      $authorization = $this->httpClient->request('POST', 'https://accounts.spotify.com/api/token', $params);
      return json_decode($authorization->getBody());
    }
    catch (\Exception $e) {
        $this->logger->critical(
          $this->stringTranslation->translate("Error while getting token from the Spotify Api")
        );
        $this->logger->error($e);
    }
    return NULL;
  }

  /**
   * Retrieves data from the Spotify Api.
   * @param string $endpoint
   *    The Spotify api endpoint to retrieves data.
   * @return object|null
   *    The data object or null
   */
  public function fetch($endpoint) {
    $auth = $this->authorization();
    $this->logger->info("Token: " . $auth->access_token);
    try {
      $params = [
        'headers' => [
          'Authorization' => $auth->token_type . ' ' . $auth->access_token,
        ]
      ];
      $request = $this->httpClient->request('GET', $endpoint, $params);
      return json_decode($request->getBody());
    }
    catch (\Exception $e) {
      $this->logger->critical(
        $this->stringTranslation->translate("Error while reading data from the Spotify Api")
      );
      $this->logger->error($e);
    }
    return NULL;
  }

}
