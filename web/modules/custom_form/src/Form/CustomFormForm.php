<?php
/**
 * @file
 * Contains \Drupal\custom_form\Form\CustomFormForm.
 */

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

class CustomFormForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form_id';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => t('Some ordinary title'),
      '#required' => TRUE,
    ];
    $form['video'] = [
      '#type' => 'textfield',
      '#title' => t('YouTube video'),
      '#required' => TRUE,
    ];
    $form['develop'] = [
      '#type' => 'checkbox',
      '#title' => t('Yes or Not'),
    ];
    $form['description'] = [
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#states' => [
        'disabled' => [
          ':input[name="develop"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['destiny'] = [
      '#type' => 'select',
      '#title' => t('Choose your destiny'),
      '#options' => [
        '0' => '-none-',
        'first' => 'First val',
        'second' => 'Second val',
        'third' => 'Third val',
        'forth' => 'Forth val',
      ],
      '#default_value' => '0',
      '#states' => [
        'visible' => [
          ':input[name="develop"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Lets go!'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $url_parsed = UrlHelper::parse($form_state->getValue('video'));
    $link = $url_parsed['path'];

    if (!UrlHelper::isValid($form_state->getValue('video'), TRUE) || !stripos($link, 'youtube')) {
      $form_state->setErrorByName(
        'video',
        $this->t(
          'The video url "@url" is invalid. It must link to youtube.',
          ['@url' => $form_state->getValue('video')]
        )
      );
    }
  }

}
