<?php
/**
 * @file
 *
 * Contains \Drupal\custom_field\Plugin\Field\FieldType\ChapterInfoItem.
 */

namespace Drupal\chapter_info\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'chapter_info' field type.
 *
 * @FieldType(
 *   id = "chapter_info",
 *   label = @Translation("Chapter Information"),
 *   description = @Translation("This field stores a chapter information in the database."),
 *   category = @Translation("Custom"),
 *   default_widget = "chapter_info_default",
 *   default_formatter = "chapter_info_default"
 * )
 */
class ChapterInfoItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'integer',
          'length' => 25,
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Number of chapters per book'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $chapter_quantity = $this->get('value')->getValue();

    return empty($chapter_quantity);
  }

}
