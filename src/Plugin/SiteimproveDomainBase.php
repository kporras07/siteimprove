<?php

namespace Drupal\siteimprove\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBaseTrait;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Psr\Container\ContainerInterface;
use Drupal\Core\Entity\EntityBase;

/**
 * Base class for Siteimprove domain plugins.
 */
abstract class SiteimproveDomainBase extends PluginBase implements SiteimproveDomainInterface {
  use StringTranslationTrait;
  use ConfigFormBaseTrait;

  /**
   * The config factory.
   *
   * Subclasses should use the self::config() method, which may be overridden to
   * address specific needs when loading config, rather than this property
   * directly. See \Drupal\Core\Form\ConfigFormBase::config() for an example of
   * this.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /** @var \Drupal\Core\Form\FormBuilder */
  protected $formBuilder;

  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = \Drupal::getContainer()->get('config.factory');
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  public function getName() {
    return $this->pluginDefinition['name'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array &$form, FormStateInterface &$form_state, $plugin_definition) {
    $form[$plugin_definition['id']] = [
      '#type' => 'fieldset',
      '#title' => $plugin_definition['label'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * Return urls for active domains for this entity.
   *
   * @param \Drupal\Core\Entity\EntityBase $entity
   *
   * @return array
   */
  public function getUrls(EntityBase $entity) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [];
  }


}
