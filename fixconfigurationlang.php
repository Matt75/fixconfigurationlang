<?php
/**
 * 2007-2019 PrestaShop.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class fixconfigurationlang extends Module
{
    private $checkedLangKeys = [];

    public function __construct()
    {
        $this->name = 'fixconfigurationlang';
        $this->version = '1.0.0';
        $this->author = 'Matt75';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Fix configuration_lang');
        $this->description = $this->l('Adds missing configuration multi language keys');
        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_
        ];
    }

    /**
     * Retrieve content for module configuration page
     *
     * @return string
     * @throws SmartyException
     * @throws PrestaShopException
     */
    public function getContent()
    {
        $this->checkLangKeys();

        return $this->postProcess()
            . $this->displayContent();
    }

    /**
     * Handle form submit and display results
     *
     * @return string
     */
    private function postProcess()
    {
        $output = '';

        if (Tools::isSubmit('submit'.$this->name)) {
            $fixedLangKeys = $this->addMissingLangValues();
            if (!empty($fixedLangKeys)) {
                foreach ($fixedLangKeys as $langKey => $isFixed) {
                    $output .= $isFixed
                        ? $this->displayConfirmation(sprintf(
                            $this->l('%s has been fixed'),
                            $langKey
                        ))
                        : $this->displayError(sprintf(
                            $this->l('%s cannot be fixed'),
                            $langKey
                        ));
                }
                Configuration::loadConfiguration();
                $this->checkLangKeys();
            } else {
                $output .= $this->displayInformation($this->l('No need to fix configuration keys'));
            }
        }

        return $output;
    }

    /**
     * Display content for module configuration page
     *
     * @return string
     * @throws SmartyException
     * @throws PrestaShopException
     */
    private function displayContent()
    {
        $this->context->smarty->assign([
            'technicalName' => $this->name,
            'displayName' => $this->displayName,
            'modulePath' => $this->getPathUri(),
            'langKeys' => $this->checkedLangKeys,
            'moduleLink' => $this->context->link->getAdminLink('AdminModules')
                . '&configure=' . $this->name,
        ]);

        return $this->context->smarty->fetch($this->local_path . 'views/templates/admin/configure.tpl');
    }

    /**
     * Get keys must have values exist in configuration_lang
     *
     * @return array
     */
    private function getLangKeys()
    {
        $langKeys = [
            'PS_INVOICE_PREFIX', // Used in src/Adapter/Invoice/InvoiceOptionsConfiguration.php
            'PS_INVOICE_LEGAL_FREE_TEXT', // Used in src/Adapter/Invoice/InvoiceOptionsConfiguration.php
            'PS_INVOICE_FREE_TEXT', // Used in src/Adapter/Invoice/InvoiceOptionsConfiguration.php
            'PS_DELIVERY_PREFIX', // Used in src/Adapter/Order/Delivery/SlipOptionsConfiguration.php
            'PS_RETURN_PREFIX', // Used in controllers/admin/AdminReturnController.php
            'PS_SEARCH_BLACKLIST', // Used in controllers/admin/AdminSearchConfController.php
            'PS_CUSTOMER_SERVICE_SIGNATURE', // Used in controllers/admin/AdminCustomerThreadsController.php
            'PS_MAINTENANCE_TEXT', // Used in src/Adapter/Shop/MaintenanceConfiguration.php
            'PS_LABEL_IN_STOCK_PRODUCTS', // Used in src/Adapter/Product/StockConfiguration.php
            'PS_LABEL_OOS_PRODUCTS_BOA', // Used in src/Adapter/Product/StockConfiguration.php
            'PS_LABEL_OOS_PRODUCTS_BOD', // Used in src/Adapter/Product/StockConfiguration.php
        ];

        return $langKeys;
    }

    /**
     * Check if values in configuration_lang exist for each keys
     */
    private function checkLangKeys()
    {
        $this->checkedLangKeys = [];

        foreach ($this->getLangKeys() as $langKey) {
            $this->checkedLangKeys[$langKey] = Configuration::isLangKey($langKey);
        }
    }

    /**
     * Adds values in configuration_lang if needed for each keys
     *
     * @return array
     */
    private function addMissingLangValues()
    {
        $fixedLangKeys = [];

        foreach ($this->checkedLangKeys as $langKey => $isLangKey) {
            if (!$isLangKey) {
                $values = [];
                foreach (Language::getIDs() as $idLang) {
                    $value = Configuration::get($langKey, $idLang);
                    $values[$idLang] = empty($value) ? ' ' : $value;
                }
                $fixedLangKeys[$langKey] = Configuration::updateValue($langKey, $values);
            }
        }

        return $fixedLangKeys;
    }
}
