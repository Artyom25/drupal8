<?php

namespace Drupal\d8dev\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Class D8devTests
 * @package Drupal\d8dev\Tests
 *
 * Tests the d8dev module functionality.
 *
 * @group d8dev
 */
class D8devTest extends WebTestBase {

  /**
   * Tests that the 'mypage/page' path returns the right content.
   */
  public function testCustomPageExists() {
    $this->drupalGet('mypage/page');
    $this->assertResponse(200);
  }

}
