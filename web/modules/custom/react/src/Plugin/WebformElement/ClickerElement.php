<?php

namespace Drupal\react\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElementBase;
use Drupal\webform\WebformSubmissionInterface;

/**
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

  public function getDefaultProperties() {
    return ['default_value' => '0'] + parent::getDefaultProperties();
  }

  public function prepare(array &$element, WebformSubmissionInterface $webform_submission = NULL) {
    parent::prepare($element, $webform_submission);

    $element['#type'] = 'hidden';
    $element['#attributes']['class'][] = 'react-clicker-value';
    $element['#attributes']['data-initial-value'] = $element['#default_value'] ?? '0';
    $element['#attached']['library'][] = 'react/react_clicker_app';
    $element['#prefix'] = '<div class="react-clicker-wrapper"><div class="react-clicker-app"></div>';
    $element['#suffix'] = '</div>';
  }
  
  // getValue(), formatHtmlItem(), formatTextItem() peuvent être supprimées
  // La classe parente les gère déjà correctement


//   /**
//    * {@inheritdoc}
//    */
//   public function getValue(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
//     $value = $webform_submission->getElementData($element['#webform_key']);
//     return $value ?? '0';
//   }

//   /**
//    * {@inheritdoc}
//    */
//   public function formatHtmlItem(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
//     $value = $this->getValue($element, $webform_submission, $options);
//     return [
//       '#markup' => (string) $value,
//     ];
//   }

//   /**
//    * {@inheritdoc}
//    */
//   protected function formatTextItem(array $element, WebformSubmissionInterface $webform_submission, array $options = []) {
//     $value = $this->getValue($element, $webform_submission, $options);
//     return (string) $value;
//   }
   
}