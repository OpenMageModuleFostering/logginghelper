<?php
/**
 * MageDeveloper Logging Module
 * ----------------------------
 *
 * @category    Mage
 * @package     MageDeveloper_Logging
 * @copyright   Magento Developers / magedeveloper.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
$installer->startSetup();
 
$template =
'
<div style="font:11px/1.35em Verdana, Arial, Helvetica, sans-serif;">
  <table cellspacing="0" cellpadding="0" border="0" width="98%" style="margin-top:10px; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; margin-bottom:10px;">
    <tr>
      <td align="center" valign="top">
          <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
              <td valign="top">
                <p>
                    {{var type_html}}
                    <br />
                    <strong>Log Event Information:</strong>
                    <br /><br />
                    <br />
                    Id: {{var log.entity_id}}
                    <br />
                    Timestamp: {{var timestamp}}
                    <br />
                    Method: {{var log.method}}
                    <br />
                    Class: {{var log.class}}
                    <hr />
                    Data:
                    <pre>
                    <div style="border:1px solid #c0c0c0;margin-top:5px;padding:5px;width:100%;font-family:Courier, Courier New;font-size:11px; background-color:#ffffff">{{var log.output}}</div>
                    </pre>
                    <hr />
                    Backtrace:
                    <pre>
                    <div style="border:1px solid #c0c0c0;margin-top:5px;padding:5px;width:100%;font-family:Courier, Courier New;font-size:11px; background-color:#ffffff">{{var log.trace}}</div>
                    </pre>					
                </p>
              </td>
            </tr>
          </table>
      </td>
    </tr>
  </table>
</div>
';

$installer->run("
    INSERT IGNORE INTO {$this->getTable('core_email_template')}
    (
        `template_code`,
        `template_text`,
        `template_type`,
        `template_subject`,
        `template_sender_name`,
        `template_sender_email`,
        `added_at`,
        `modified_at`
    )
    VALUES
    (
        'Log Event Mail Template (html)',
        '".$template."',
        ".Mage_Core_Model_Template::TYPE_HTML.",
        '".Mage::helper('logging')->__('Log Event Information')."',
        NULL,
        NULL,
        NOW(),
        NOW()
    );
");

$installer->run("
ALTER TABLE {$installer->getTable('log_entity')} ADD `trace` LONGTEXT NOT NULL AFTER `output` 
");
