<?php

namespace Drupal\react\Plugin\Field\fieldWidget;

use Drupal\Core\Field\Attribute\FieldWidget;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * A widget bar.
 * #[FieldWidget(
 * id: 'field_example_text',
 * label: new TranslatableMarkup('RGB value as #ffffff'),
 * field_types: [
 *  'baz',
 *  'string',
 * ],
 * )]
*/

class SliderWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element += [
      // Add to the element render array passed in.
      // See WidgetInterface::formElement().
    ];
    
    return ['value' => $element];
  }

}