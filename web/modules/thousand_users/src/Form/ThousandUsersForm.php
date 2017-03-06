<?php

namespace Drupal\thousand_users\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\thousand_users\Controller\ThousandUsersUserController;

/**
 * Class ThousandUsersForm.
 *
 * @package Drupal\thousand_users\Form
 */
class ThousandUsersForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'thousand_users_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['thousand_user_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name'),
      '#required' => TRUE,
    ];
    $form['thosand_user_mail'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email'),
      '#required' => TRUE,
    ];
    $form['thousand_user_password'] = [
      '#type' => 'password',
      '#title' => $this->t('Your password'),
      '#required' => TRUE,
    ];
    $form['thousand_users'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Create!'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('thousand_user_name');
    $email = $form_state->getValue('thosand_user_mail');
    $pass = $form_state->getValue('thousand_user_password');

    $new_user = new ThousandUsersUserController();
    $uid = $new_user->createUser($name, $email, $pass);

    drupal_set_message('user - ' . $name . ' created. his Id is - ' . $uid);
    drupal_set_message('Coooool!');
  }

}
