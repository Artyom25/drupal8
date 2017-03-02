<?php
/**
 * @file
 *
 * @author Artym Ilyin
 *
 * Contains \Drupal\d8dev\Controller\d8devController.
 */

namespace Drupal\d8dev\Controller;

/**
 * Class d8devController
 * @package Drupal\d8dev\Controller
 *
 * Provides route response for the d8dev module.
 */
class d8devController {

  /**
   * Returns a simple page.
   *
   * @return array
   * A simple renderable array.
   */
  public function myPage() {
    $element = [
      '#type' => 'markup',
      '#markup' => 'Page from d8dev',
    ];

    return $element;
  }

}
