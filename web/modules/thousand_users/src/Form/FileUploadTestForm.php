<?php
/**
 * @file
 * Contains Drupal\thousand_users\Form\FileUploadTestForm
 */
namespace Drupal\thousand_users\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class FileUploadTestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'thousand_user_file_upload';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['thousand_users_file'] = [
      '#type' => 'managed_file',
      '#title' => t('Choose file'),
      '#upload_location' => 'public://images/',
      '#upload_validators' => array(
        'file_validate_extensions' => array('csv'),
      ),
      '#description' => t('choose your destiny'),
    ];
    $form['form_sub'] = [
      '#type' => 'submit',
      '#value' => t('Upload!'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $img = $form_state->getValue('thousand_users_file');
    $file = File::load($img[0]);
    $file->setPermanent();
    $file->save();
    
    thousand_user_batch_init($file->getFileUri());
  }
  
  

}