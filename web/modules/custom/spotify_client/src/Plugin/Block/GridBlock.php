<?php

namespace Drupal\spotify_client\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\spotify_client\Service\SpotifyClientRequestService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a grid block.
 *
 * @Block(
 *   id = "spotify_client_grid_block",
 *   admin_label = @Translation("Grid Block"),
 *   category = @Translation("Custom")
 * )
 */
class GridBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The spotify request service.
   *
   * @var \Drupal\spotify_client\Service\SpotifyClientRequestService
   */
  protected $spotifyClientRequest;

  /**
   * Constructs a new GridBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\spotify_client\Service\SpotifyClientRequestService $spotify_client_request
   *   The spotify_client.request service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, SpotifyClientRequestService $spotify_client_request) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->spotifyClientRequest = $spotify_client_request;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('spotify_client.request')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme'    => 'grid_block',
      '#attached' => [
        'library' => [
          'spotify_client/region-spotify-client-styles',
          'spotify_client/region-spotify-client-scripts',
        ],
      ],
      '#artists' => $this->spotifyClientRequest->fetch('https://api.spotify.com/v1/search?q=artist:&type=artist&limit=10'),
    ];
  }

}
