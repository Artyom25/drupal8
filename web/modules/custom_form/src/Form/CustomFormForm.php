<?php
/**
 * @file
 * Contains \Drupal\custom_form\Form\CustomFormForm.
 */

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;

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
    $form['replaceable'] = array(
      '#type' => 'markup',
      '#markup' => '<div id="hey"></div>'
    );
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
      '#ajax' => array(
        'callback' => array($this, 'addMoreCallback'),
      ),
    ];
    return $form;
  }

  public function addMoreCallback(array &$form, FormStateInterface $form_state) {
    $dev = $form_state->getValue('develop');
    $message = '<div id="hey">values:<br/>';
    $message .= 'title: ' . $form_state->getCompleteForm()['title']['#value'] . '<br/>';
    $message .= 'video: ' . $form_state->getCompleteForm()['video']['#value'] . '<br/>';
    $message .= 'develop: ' . $form_state->getCompleteForm()['develop']['#value'] . '<br/>';
    if (!$dev) {
      $message .= 'description: ' . $form_state->getCompleteForm()['description']['#value'] . '<br/>';
    }
    else {
      $message .= 'destiny: ' . $form_state->getCompleteForm()['destiny']['#value'] . '</div>';
    }
    $response = new AjaxResponse();
    $response->addCommand(new ReplaceCommand('#hey', $message));

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {}

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
