<?php

namespace Drupal\spotify_client\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\spotify_client\Service\SpotifyClientRequestService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for spotify_client routes.
 */
class SpotifySongsSingleController extends ControllerBase {

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
  public function build(Request $request) {
    $song = $this->spotifyClientRequest->fetch('https://api.spotify.com/v1/tracks/' . $request->get('id'));
    $genres = [];
    foreach ($song->artists as $artist) {
      $result = $this->spotifyClientRequest->fetch($artist->href);
      if ($result->genres) {
        foreach ($result->genres as $genre) {
          if (!in_array($genre, $genres) ) {
            $genres[] = $genre;
          }
        }
      }
    }
    $song->genres = $genres;
    $build['songs_single_page'] = [
        '#theme'    => 'songs_single_page',
        '#song' => $song,
    ];
    return $build;
  }

}
