<?php
/**
 * @file
 *
 * Contains Drupal\chapter_info\Plugin\Block\ChapterInfoBlock.
 */

namespace Drupal\chapter_info\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ChapterInfoBlock
 * @package Drupal\chapter_info\Plugin\Block
 *
 * Provides ChapterIfo Block.
 *
 * @Block(
 *   id = "chapter_info_block",
 *   admin_label = @Translation("Chapter Info Block"),
 * )
 */
class ChapterInfoBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $plugin_id = $this->getPluginId();
    $config = $this->getConfiguration();

    $form['user_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t(
        'Hey, @user!',
        ['@user' => \Drupal::currentUser()->getAccount()->getAccountName()]
      ),
      '#description' => $this->t(
        'PLugin id is @plugin. Plugin provided by @provider',
        [
          '@plugin' => $plugin_id,
          '@provider' => $config['provider'],
        ]
      ),
      '#default_value' => isset($config['name']) ? $config['name'] : '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $name = $this->t('some name');

    if (isset($config['name'])) {
      $name = $config['name'];
    }

    return ['#markup' => $this->t("Greetings, @user_name!", ['@user_name' => $name])];
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['name'] = $form_state->getValue('user_name');
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $default_config = \Drupal::config('chapter_info.settings');

    return ['name' => $default_config->get('chapter_info.username')];
  }

}
