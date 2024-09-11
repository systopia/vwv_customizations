<?php

require_once 'vwv_customizations.civix.php';

use CRM_VwvCustomizations_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function vwv_customizations_civicrm_config(&$config): void {
  _vwv_customizations_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function vwv_customizations_civicrm_install(): void {
  _vwv_customizations_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function vwv_customizations_civicrm_enable(): void {
  _vwv_customizations_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_pre().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_pre/
 */
function vwv_customizations_civicrm_pre($op, $objectName, $id, &$params) {
  if ($op == 'delete' || ($op == 'edit' && array_key_exists('is_deleted', $params) && $params['is_deleted'] == 1)) {
    CRM_VwvCustomizations_CheckContactOnDelete::validate($op, $objectName, $id, $params);
  }

}
