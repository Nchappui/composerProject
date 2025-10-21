<?php

namespace Drupal\react\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElementBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Provides an 'article' element.
 *
 * @WebformElement(
 *   id = "article",
 *   label = @Translation("Article"),
 *   description = @Translation("Provides item for article."),
 *   category = @Translation("Custom"),
 * )
 */
class Article extends WebformElementBase {

    /**
     * {@inheritdoc}
     */
    public function getDefaultProperties() {
        return ['title' => ''];
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state) {
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function prepare(array &$element, WebformSubmissionInterface $webform_submission = NULL) {
        $element['#type'] = 'value';
        parent::prepare($element, $webform_submission);
    }

    /**
     * {@inheritdoc}
     */
    public function preSave(array &$element, WebformSubmissionInterface $webform_submission) {
        $source_data = $webform_submission->getElementData('article');
        $webform_submission->setElementData('article_1', $source_data);
    }

    /**
     * {@inheritdoc}
     */
    public function buildExportHeader(array $element, array $options) {
        return [
            $this->t('Title'),
            $this->t('URL'),
            $this->t('Tags'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildExportRecord(array $element, WebformSubmissionInterface $webform_submission, array $export_options) {
        $entity_id = $this->getValue($element, $webform_submission);

        if ($entity_id && ($entity = $this->entityTypeManager->getStorage('node')->load($entity_id))) {
            $tags = [];
            foreach ($entity->field_tags as $name) {
                $tags[] = $name->entity->label();
            }

            return [
                $entity->label(),
                $entity->toUrl('canonical', ['absolute' => TRUE])->toString(),
                implode(', ', $tags),
            ];
        }

        return parent::buildExportRecord($element, $webform_submission, $export_options);
    }


}