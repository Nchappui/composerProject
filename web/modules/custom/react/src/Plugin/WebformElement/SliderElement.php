<?php

namespace Drupal\react\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElementBase;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Provides a 'slider' element.
 *
 * @WebformElement(
 *   id = "react_slider",
 *   label = @Translation("React Slider"),
 *   description = @Translation("Provides a React slider element."),
 *   category = @Translation("Custom elements"),
 *   states_wrapper = TRUE,
 *   default_key = "react_slider"
 * )
 */
class SliderElement extends WebformElementBase
{

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties()
  {
    return ['default_value' => '30'] + parent::getDefaultProperties();
  }

  /**
   * {@inheritdoc}
   */
  public function prepare(array &$element, WebformSubmissionInterface $webform_submission = NULL)
  {
    parent::prepare($element, $webform_submission);

    $element['#type'] = 'hidden';
    $element['#attributes']['class'][] = 'react-slider-value';
    $element['#attributes']['data-initial-value'] = $element['#default_value'] ?? '30';
    $element['#attached']['library'][] = 'react/react_slider_app';
    $element['#prefix'] = '<div class="react-slider-wrapper"><div class="react-slider-app"></div>';
    $element['#suffix'] = '</div>';
  }
}
