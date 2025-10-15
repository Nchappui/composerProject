<?php

namespace Drupal\react\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a second React block.
 * 
 * @Block(
 *   id = "react_slider_block",
 *   admin_label = @Translation("React slider block")
 * )
*/
class SliderBlock extends BlockBase {
  public function build() {
    $build = [];
    $build['react_slider_block'] = [
      '#markup' => '<div class="react-slider-app"></div>',
      '#attached' => [
        'library' => ['react/react_slider_app']
      ],
    ];
    return $build;
  }
}