<?php
/**
 * @file
 * Contains Drupal\custom_modal\Form\ModalForm.
 */

namespace Drupal\custom_modal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['open_modal_form'] = [
      '#type' => 'link',
      '#title' => $this->t('Open Modal Form'),
      '#url' => Url::fromRoute('custom_modal.modal_form'),
      '#attributes' => [
        'class' => [
          'use-ajax',
          'button',
        ],
      ],
    ];

    // Attach the library for pop-up dialog/modal
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'modal_example_form';
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array - an array of configuration object names that are editable
   * if called in conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['config.modal_example_form'];
  }

}
