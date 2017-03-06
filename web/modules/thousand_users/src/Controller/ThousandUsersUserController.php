<?php
/**
 * @file
 * Contains \Drupal\thousand_users\Controller\ThousandUsersUserController;
 */

namespace Drupal\thousand_users\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;

/**
 * Class ThousandUsersUserController
 * @package Drupal\thousand_users\Controller
 *
 * Creates user when someone goes to page 'thousand_users_user'.
 */
class ThousandUsersUserController extends ControllerBase {

  const USER_ACTIVE = 1;

  /**
   * {@inheritdoc}
   */
  public function content() {
    $new_user = User::create([
      'name' => 'Bot',
      'mail' => 'bot@mail.com',
      'pass' => 'bot',
      'status' => 1,
    ]);
    $new_user->save();

    return array(
      '#type' => 'markup',
      '#markup' => $this->t(
        'User successfully created. he have id - @id and name - @name',
        ['@id' => $new_user->id(), '@name' => $new_user->getAccountName()]
      ),
    );
  }

  /**
   * Function to create user.
   *
   * @param $name - string, provides username.
   * @param $email - string, provides email.
   * @param $pass - string, provides password
   *
   * @return int - id of created user.
   */
  public function createUser($name, $email, $pass) {
    $new_user = User::create([
      'name' => $name,
      'mail' => $email,
      'status' => self::USER_ACTIVE,
    ]);
    $new_user->setPassword($pass);
    $new_user->save();

    return $new_user->id();
  }

  /**
   * Function to parse file and
   * @return array - contains array with user info.
   */
  public function fileParse($file_uri) {
    $handle = fopen($file_uri, 'r');
    $lines = array();
    while (($data = fgetcsv($handle)) != FALSE) {
      $lines[] = $data;
    }
    return $lines;
  }

  /**
   * Function to check if username exists.
   * If TRUE, then add underscore and number and then check again.
   * If FALSE, returns unique name.
   *
   * @param $name - string. User name from csv file.
   *
   * @return string - unique user name.
   */
  public function checkUserName($name) {
    $accnum = 1;
    $new_name = $name;
    while (user_load_by_name($new_name)) {
      $new_name = $name . '_' . $accnum;
      $accnum++;
    }

    return $new_name;
  }

}
