<?php
/*-------------------------------------------------------+
| VWV Customizations                                     |
| Copyright (C) 2024 SYSTOPIA                            |
| Author: P. Batroff (batroff@systopia.de)               |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/


use CRM_VwvCustomizations_ExtensionUtil as E;

class CRM_VwvCustomizations_CheckContactOnDelete {

  public function __construct($op, $objectName, $id, &$params) {

  }

  /**
   * @param $params
   * @return void
   * @throws CRM_VwvCustomizations_Exceptions_LinkedContactException
   */
  public static function validate($op, $objectName, $id, &$params) {
    $results = [];
    $civi_query = CRM_Core_DAO::executeQuery("
      SELECT contact_id FROM civicrm_uf_match WHERE contact_id = {$id};
    ");
    while ($civi_query->fetch()) {
      $results[] = $civi_query->toArray();
    }
    if (!empty($results)) {
      throw new CRM_VwvCustomizations_Exceptions_LinkedContactException("Contact is Linked and cannot be deleted");
    }
  }
}
