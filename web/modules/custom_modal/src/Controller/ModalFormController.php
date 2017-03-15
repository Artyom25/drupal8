<?php
/**
 * @file
 * Contains \Drupal\custom_modal\Controller\ModalFormController.
 */

namespace Drupal\custom_modal\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ModalFormController extends ControllerBase {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilder
   */
  protected $formBuilder;

  /**
   * The ModalFOrmController constructor.
   *
   * @param \Drupal\Core\Form|FormBuilder $formBuilder
   * The form builder.
   */
  public function __construct(FormBuilder $formBuilder) {
    $this->formBuilder = $formBuilder;
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *  The Drupal service container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('form_builder')
    );
  }

  /**
   * Callback for opening the modal form.
   */
  public function openModalForm() {
    $response = new AjaxResponse();

    // Get the modal form using fom builder.
    $modal_form = $this->formBuilder->getForm('Drupal\custom_modal\Form\ModalFormModal');

    // Add an AJAX command to open a modal dialog with the form as the content.
    $response->addCommand(
      new OpenModalDialogCommand('Modal Form', $modal_form, ['width' => '800'])
    );

    return $response;
  }

}
