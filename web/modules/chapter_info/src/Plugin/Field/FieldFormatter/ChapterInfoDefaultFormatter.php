<?php
/**
 * @file
 *
 * Contatins Custom Field Formatter Class.
 */

namespace Drupal\chapter_info\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Class ChapterInfoDefaultFormatter
 * @package Drupal\chapter_info\Plugin\Field\FieldFormatter
 *
 * Plugin implementation of the 'chapter_info_default' formatter.
 *
 * @FieldFormatter(
 *   id = "chapter_info_default",
 *   label = @Translation("Chapter Info Formatter"),
 *   field_types = {
 *     "chapter_info",
 *   }
 *
 * )
 *
 */
class ChapterInfoDefaultFormatter extends FormatterBase {

  public function viewElements(FieldItemListInterface $items, $langcode) {
    $rows = [];

    foreach ($items as $delta => $item) {
      $rows[] = [
        'data' => [
          $item->value,
        ],
      ];
    }

    $headers = [
      t('Chapters per book'),
    ];

    $table = [
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $rows,
      '#empty' => t('No information available'),
      '#attributes' => ['id' => 'chapter-info'],
    ];

    return $elements = ['#markup' => \Drupal::service('renderer')->render($table)];
  }

}
