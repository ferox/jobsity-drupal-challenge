<?php

namespace Drupal\spotify_client\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\spotify_client\Service\SpotifyClientRequestService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for spotify_client routes.
 */
class SpotifyArtistsListController extends ControllerBase {

  /**
   * The spotify_client.request service.
   *
   * @var \Drupal\spotify_client\Service\SpotifyClientRequestService
   */
  protected $spotifyClientRequest;

  /**
   * The controller constructor.
   *
   * @param \Drupal\spotify_client\Service\SpotifyClientRequestService $spotify_client_request
   *   The spotify_client.request service.
   */
  public function __construct(SpotifyClientRequestService $spotify_client_request) {
    $this->spotifyClientRequest = $spotify_client_request;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('spotify_client.request')
    );
  }

  /**
   * Builds the response.
   */
  public function build() {
    $id = '5veVxxPm1vzgi6pO2iVA8L';
    $build['artists_list_page'] = [
        '#theme'    => 'artists_list_page',
        '#artists' => $this->spotifyClientRequest->fetch('https://api.spotify.com/v1/search?q=artist:&type=artist&limit=50'),
    ];
    return $build;
  }

}
