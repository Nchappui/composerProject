<?php

/**
 * @file
 * A form to collect an email address for RSVP details.
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RSVPForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'rsvplist_email_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Attempt to get the fully loaded node object of the viewed page.
    $node = \Drupal::routeMatch()->getParameter('node');

    $nid = is_null($node) ? 0 : $node->id();

    // Establish the $form render array. It has an email text field, a submit button,
    // and a hidden field containing the node ID.
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => t('Email address'),
      '#size' => 25,
      '#description' => t("We will send updates to the email address you provide."),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('RSVP'),
    ];
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
  */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $submitted_email = $form_state -> getValue('email');
    if ( !(\Drupal::service('email.validator')->isValid($submitted_email)) ){
      $form_state->setErrorByName('email', $this->t('It appears that %mail is not a valid mail. Please try again...', ['%mail' => $submitted_email]));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    try{
      $uid = \Drupal::currentuser()->id();
      $nid = $form_state->getValue('nid');
      $email = $form_state->getValue('email');
      $current_time = \Drupal::time()->getRequestTime();

      $query = \Drupal::database()->insert('rsvplist');
      $query->fields(['uid', 'nid', 'mail', 'created',]);
      $query->values([$uid, $nid, $email, $current_time,]);
      $query->execute();

      \Drupal::messenger()->addMessage(
        t('Thank you for your RSVP, you are on the list for the event!')
      );
    }
    catch (\Exception $e){
      \Drupal::messenger()->addError(
        t('Unable to save RSVP settings at this time due to a database ettot. Please try again.')
      );
    }

  }
}