<?php
/**
 * @file
 *
 * Contains ChapterInfoDefaultWidget.
 */

namespace Drupal\chapter_info\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'chapter_info_default' widget.
 *
 * @FieldWidget (
 *   id = "chapter_info_default",
 *   label = @Translation("Chapter field widget"),
 *   field_types = {
 *      "chapter_info"
 *   }
 * )
 */
class ChapterInfoDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['chapters_quantity'] = [
      '#title' => t('Chapters per book'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->value)
        ? $items[$delta]->value : NULL,
    ];

    return $element;
  }

}
