<?php

namespace Drupal\siteimprove\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines an interface for Siteimprove domain plugins.
 */
interface SiteimproveDomainInterface extends PluginInspectionInterface {

  public function buildForm(array &$form, FormStateInterface &$form_state, $id);

  public function validateForm(array &$form, FormStateInterface $form_state);

  public function submitForm(array &$form, FormStateInterface $form_state);


}
