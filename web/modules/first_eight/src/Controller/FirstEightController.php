<?php

namespace Drupal\first_eight\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstEightController extends ControllerBase {

  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('Hello Wodrl!'),
    );
  }

}
