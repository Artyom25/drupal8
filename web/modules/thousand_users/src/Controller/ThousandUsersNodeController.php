<?php

namespace Drupal\thousand_users\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class ThousandUsersNodeController extends ControllerBase {

  public function content() {
    $node = Node::create([
      'type' => 'book',
      'title' => 'Node created from code',
      'uid' => \Drupal::currentUser()->id(),
      'status' => NODE_PUBLISHED,
      'promote' => NODE_PROMOTED,
      'field_author' => t('d8devel'),
      'field_description' => t('typical description of book ccreated programmatically. the only difference is that it was created on drupal8'),
      'body' => t('typical description of book ccreated programmatically. the only difference is that it was created on drupal8'),
      'field_time_to_read' => 2525,
    ]);
    $node->save();
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('Cmon! We are almost done, node id is @id', ['@id' => $node->id()]),
    );
  }

}
