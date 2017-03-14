<?php
/**
 * @file
 * Contains \Drupal\custom_modal\Controller\CustomModalController.
 */

namespace Drupal\custom_modal\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

class CustomModalController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function page() {
    $url = Url::fromRoute('custom_modal.modal', ['js' => 'ajax']);

    return [
      '#type' => 'link',
      '#title' => $this->t('Some title'),
      '#url' => $url,
      '#options' => [
        'attributes' => [
          'class' => ['use-ajax'],
          'data-dialog-type' => 'modal',
        ],
      ],
      '#attached' => ['library' => ['core/drupal.dialog.ajax']],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function modal($js = 'nojs') {
    if ($js == 'ajax') {
      $response = new AjaxResponse();
      $response->addCommand(
        new OpenModalDialogCommand(t('Modal'), t('This is the modal with Javascript.'))
      );
      return $response;
    }
    else {
      return t('This is the page without Javascript');
    }
  }

}
