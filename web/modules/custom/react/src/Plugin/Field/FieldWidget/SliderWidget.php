<?php

namespace Drupal\react\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'react_slider' widget.
 *
 * @FieldWidget(
 *   id = "react_slider_widget",
 *   label = @Translation("React Slider Widget"),
 *   field_types = {
 *     "string",
 *     "text"
 *   }
 * )
 */
class ReactSliderWidget extends WidgetBase
{

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
  {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    $element += [
      '#type' => 'container',
      '#attributes' => [
        'class' => ['react-slider-app'],
        'data-field-value' => $value,
      ],
      '#attached' => [
        'library' => ['react/react_slider_app'],
        'drupalSettings' => [
          'reactSlider' => [
            'fieldValue' => $value,
          ],
        ],
      ],
    ];

    $element['value'] = [
      '#type' => 'hidden',
      '#default_value' => $value,
      '#attributes' => [
        'class' => ['react-slider-value'],
      ],
    ];

    return $element;
  }
}
