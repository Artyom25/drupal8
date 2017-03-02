<?php
/**
 * @file
 *
 * Contains \Drupal\d8dev\Plugin\field\formatter\BookFormatter.
 */

namespace Drupal\d8dev\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Class BookFormatter
 * @package Drupal\d8dev\Plugin\Field\FieldFormatter
 *
 * Plugin implementation of the 'reading_time' formatter.
 *
 * @FieldFormatter(
 *   id = "reading_time",
 *   label = @Translation("Duration"),
 *   field_types = {
 *     "integer",
 *     "decimal",
 *     "float",
 *   }
 *
 * )
 *
 */
class BookFormatter extends FormatterBase {

  /**
   * Simple helper function to get greatest common denominator(gcd) of minutes.
   */
  function gcd($a, $b) {
    $b = ($a == 0) ? 0 : $b;

    return ($a % $b) ? $this->gcd($b, abs($a - $b)) : $b;
  }

  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $hours = floor($item->value / 60);
      $minutes = $item->value % 60;
      $minutes_gcd = $this->gcd($minutes, 60);
      $minutes_fraction = $minutes / $minutes_gcd . "/" . 60 / $minutes_gcd;

      if ($hours > 0) {
        $markup = $hours . ' and ' . $minutes_fraction . ' hours';
      }
      else {
        $markup = $minutes_fraction . ' hours';
      }

      $elements[$delta] = [
        '#theme' => 'reading_time_display',
        '#value' => $markup,
      ];
    }

    return $elements;
  }

}
