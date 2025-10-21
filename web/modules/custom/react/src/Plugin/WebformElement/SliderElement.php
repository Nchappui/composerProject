<?php

namespace Drupal\react\Plugin\WebformElement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
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
class SliderElement extends WebformElementBase {

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties() {
    return [
      // Element settings.
      'multiple' => FALSE,
      'title' => '',
      'default_value' => '30',
    ] + parent::getDefaultProperties();
  }

  /**
   * {@inheritdoc}
   */
  public function checkAccessRules($operation, array $element, AccountInterface $account = NULL) {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function prepare(array &$element, WebformSubmissionInterface $webform_submission = NULL) {
    parent::prepare($element, $webform_submission);

    // Set the element type to hidden (it will store the value)
    $element['#type'] = 'hidden';
    $element['#attributes']['class'][] = 'react-slider-value';
    
    // Get stored value or default to 30
    $stored_value = $element['#default_value'] ?? '30';
    $element['#default_value'] = $stored_value;
    $element['#attributes']['data-initial-value'] = $stored_value;
    
    // Add library
    $element['#attached']['library'][] = 'react/react_slider_app';
    
    // Add wrapper that will contain both the React app and the hidden input
    $element['#prefix'] = '<div class="react-slider-wrapper"><div class="react-slider-app"></div>';
    $element['#suffix'] = '</div>';
  }

  /**
   * {@inheritdoc}
   */
  public function getValue(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
    $value = $webform_submission->getElementData($element['#webform_key']);
    return $value ?? '30';
  }

  /**
   * {@inheritdoc}
   */
  public function formatHtmlItem(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
    $value = $this->getValue($element, $webform_submission, $options);
    return [
      '#markup' => (string) $value,
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function formatTextItem(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
    $value = $this->getValue($element, $webform_submission, $options);
    return (string) $value;
  }
}