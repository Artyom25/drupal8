<?php
/**
 * @file
 * Contains Drupal\multistep\Controller\MultistepController.
 */

namespace Drupal\multistep\Controller;

use Drupal\Core\Controller\ControllerBase;

class MultistepController extends ControllerBase {

  public function thanksMessage() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('thanks for filling the form.'),
    ];
  }

}
