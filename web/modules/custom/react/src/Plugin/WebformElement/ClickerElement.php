<?php

namespace Drupal\react\Plugin\WebformElement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Plugin\WebformElementBase;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Provides a 'clicker' element.
 *
 * @WebformElement(
 *   id = "react_clicker",
 *   label = @Translation("React Clicker"),
 *   description = @Translation("Provides a React clicker element."),
 *   category = @Translation("Custom elements"),
 *   states_wrapper = TRUE,
 *   default_key = "react_clicker"
 * )
 */
class ClickerElement extends WebformElementBase {

  /**
   * {@inheritdoc}
   */
  public function getDefaultProperties() {
    return [
      // Element settings.
      'multiple' => FALSE,
      'title' => '',
      'default_value' => '0',
    ] + parent::getDefaultProperties();
  }

  /**
   * {@inheritdoc}
   */
  public function prepare(array &$element, WebformSubmissionInterface $webform_submission = NULL) {
    parent::prepare($element, $webform_submission);

    // Set the element type to hidden (it will store the value)
    $element['#type'] = 'hidden';
    $element['#attributes']['class'][] = 'react-clicker-value';
    
    // Get stored value or default to 0
    $stored_value = $element['#default_value'] ?? '0';
    $element['#default_value'] = $stored_value;
    $element['#attributes']['data-initial-value'] = $stored_value;
    
    // Add library
    $element['#attached']['library'][] = 'react/react_clicker_app';
    
    // Add wrapper that will contain both the React app and the hidden input
    $element['#prefix'] = '<div class="react-clicker-wrapper"><div class="react-clicker-app"></div>';
    $element['#suffix'] = '</div>';
  }

  /**
   * {@inheritdoc}
   */
  public function getValue(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
    $value = $webform_submission->getElementData($element['#webform_key']);
    return $value ?? '0';
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