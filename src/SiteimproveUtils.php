<?php

namespace Drupal\siteimprove;

/**
 * Class SiteimproveUtils.
 */
class SiteimproveUtils {

  const TOKEN_REQUEST_URL = 'https://my2.siteimprove.com/auth/token';

  /**
   * Return Siteimprove token.
   */
  public function requestToken() {

    try {
      // Request new token.
      $response = \Drupal::httpClient()->get(self::TOKEN_REQUEST_URL,
        ['headers' => ['Accept' => 'application/json']]);

      $data = (string) $response->getBody();
      if (!empty($data)) {
        $json = json_decode($data);
        if (!empty($json->token)) {
          return $json->token;
        }
        else {
          throw new \Exception();
        }
      }
      else {
        throw new \Exception();
      }
    }
    catch (\Exception $e) {
      watchdog_exception('siteimprove', $e, t('There was an error requesting a new token.'));
    }

    return FALSE;
  }

  /**
   * Return Siteimprove js library.
   *
   * @return string
   *   Siteimprove js library.
   */
  public function getSiteimproveOverlayLibrary() {
    return 'siteimprove/siteimprove.overlay';
  }

  /**
   * Return siteimprove js library.
   */
  public function getSiteimproveLibrary() {
    return 'siteimprove/siteimprove';
  }

  /**
   * Return siteimprove js settings.
   *
   * @param string $url
   *   Url to input or recheck.
   * @param string $type
   *   Action: recheck_url|input_url.
   * @param bool $auto
   *   Automatic calling to the defined method.
   *
   * @return array
   *   JS settings.
   */
  public function getSiteimproveSettings($url, $type, $auto = TRUE) {
    return [
      'url' => $url,
      'auto' => $auto,
    ];
  }

  /**
   * Return siteimprove token.
   *
   * @return array|mixed|null
   *   Siteimprove Token.
   */
  public function getSiteimproveToken() {
    return \Drupal::config('siteimprove.settings')->get('token');
  }

  /**
   * Save URL in session.
   *
   * @param object $object
   *   Node or taxonomy term entity object.
   */
  public function setSessionUrl($object) {
    // Check if user has access.
    if (\Drupal::currentUser()->hasPermission('use siteimprove')) {
      // Save friendly url in SESSION.
      $_SESSION['siteimprove_url'][] = $object->toUrl('canonical', ['absolute' => TRUE])->toString();
    }
  }

}
