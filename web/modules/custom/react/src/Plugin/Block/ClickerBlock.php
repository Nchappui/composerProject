<?php

namespace Drupal\react\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'ClickerBlock' block.
 * 
 * @Block(
 *   id = "react_clicker_block",
 *   admin_label = @Translation("React clicker block")
 * )
*/
class ClickerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['react_clicker_block'] = [
      '#markup' => '<div class="react-clicker-app"></div>',
      '#attached' => [
        'library' => ['react/react_clicker_app']
      ],
    ];
    return $build;
  }
}