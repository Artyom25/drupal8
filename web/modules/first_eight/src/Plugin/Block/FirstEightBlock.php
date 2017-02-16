<?php
namespace Drupal\first_eight\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'First Eight' Blokc.
 *
 * @Block(
 *   id = "first_eight_block",
 *   admin_label = @Translation("First Eight block"),
 * )
 */
class FirstEightBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->t('Hello wolrd from block'),
    );
  }

}
