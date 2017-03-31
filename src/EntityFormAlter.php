<?php

namespace Drupal\siteimprove;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class FormAlter.
 */
class EntityFormAlter {

  /**
   * Alter node/taxonomy term edit form.
   */
  static public function siteimprove(array $element, FormStateInterface $form_state) {
    // Get friendly url of node and include all Siteimprove js scripts.
    /** @var \Drupal\Core\Entity\Entity $entity */
    $entity = $form_state->getFormObject()->getEntity();
    $url = $entity->toUrl('canonical', ['absolute' => TRUE])->toString();

    $element['#attached']['drupalSettings']['siteimprove']['token'] = \Drupal::service('siteimprove.utils')->getSiteimproveToken();
    $element['#attached']['drupalSettings']['siteimprove']['input'] = \Drupal::service('siteimprove.utils')->getSiteimproveSettings($url, 'input');
    $element['#attached']['drupalSettings']['siteimprove']['recheck'] = \Drupal::service('siteimprove.utils')->getSiteimproveSettings($url, 'recheck', FALSE);
    $element['#attached']['library'][] = \Drupal::service('siteimprove.utils')->getSiteimproveOverlayLibrary();
    $element['#attached']['library'][] = \Drupal::service('siteimprove.utils')->getSiteimproveLibrary();

    return $element;
  }

}
