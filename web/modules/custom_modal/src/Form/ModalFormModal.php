<?php
/**
 * @file
 * Contains Drupal\custom_modal\Form\ModalFormModal.
 */

namespace Drupal\custom_modal\Form;

use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\PrependCommand;
use Drupal\Core\Url;

/**
 * Modal form class.
 */
class ModalFormModal extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'modal_form_example_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#prefix'] = '<div id="modal_example_form">';
    $form['#suffix'] = '</div>';

    // Status messsages that will contain any form errors.
    $form['status_messages'] = [
      '#type' => 'status_message',
      '#weight' => 10,
    ];

    // Required checkbox field.
    $form['yeah_dog'] = [
      '#type' => 'markup',
      '#markup' => '<p>Yeah, dog!</p>',
    ];
    $form['our_checkbox'] =[
      '#type' => 'checkbox',
      '#title' => $this->t('Yes/not'),
      '#required' => TRUE,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['send'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit!'),
      '#attributes' => [
        'class' => ['use-ajax'],
      ],
      '#ajax' => [
        'callback' => [$this, 'submitModalFormAjax'],
        'event' => 'click',
      ],
    ];
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    return $form;
  }

  /**
   * AJAX callback handler that displays any errors or a success message.
   */
  public function submitModalFormAjax(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    // if there are any form errors, re-display the form.
    if ($form_state->hasAnyErrors()) {
      $response->addCommand(new ReplaceCommand('#modal_example_form', $form));
      drupal_get_messages();
      $response->addCommand(new PrependCommand('#modal_example_form', '<p style="color:red">Yo, dog, you must answer yes or not.</p>'));
    }
    else {
      $response->addCommand(
        new OpenModalDialogCommand(
          "Success!",
          'Modal form has been submitted',
          ['width' => 800]
        )
      );
      $response->addCommand(new RedirectCommand(Url::fromRoute('custom_modal.form')->toString()));
    }

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * Gets the configuration names that will be editable
   * @return array
   */
  protected function getEditableConfigNames() {
    return ['config.modal_form_example_modal_form'];
  }

}
