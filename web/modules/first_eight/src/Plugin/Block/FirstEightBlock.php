<?php
namespace Drupal\first_eight\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'First Eight' Blokc.
 *
 * @Block(
 *   id = "first_eight_block",
 *   admin_label = @Translation("First Eight block"),
 * )
 */
class FirstEightBlock extends BlockBase implements BlockPluginInterface{

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['first_eight_block_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('WHOOO!'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => isset($config['name']) ? $config['name'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['name'])) {
      $name = $config['name'];
    }
    else {
      $name = $this->t('two no one');
    }

    return array(
      '#markup' => $this->t('Hello @name from block', array(
          '@name' => $name,
        )
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['name'] = $form_state->getValue('first_eight_block_name');
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $default_config = \Drupal::config('first_eight.settings');

    return array(
      'name' => $default_config->get('first_eight.name'),
    );
  }

}
