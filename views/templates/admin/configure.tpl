{*
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<form action="{$moduleLink|escape:'htmlall':'UTF-8'}" method="post">
  <div class="panel">
    <div class="panel-heading">
      {$displayName|escape:'htmlall':'UTF-8'}
    </div>
    <div class="panel-body">
      <table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>{l s='Configuration keys' mod='fixconfigurationlang'}</th>
            <th>{l s='Status' mod='fixconfigurationlang'}</th>
          </tr>
        </thead>
        <tbody>
        {foreach $langKeys as $langKey => $isLangKey}
          <tr>
            <td>{$langKey|escape:'htmlall':'UTF-8'}</td>
            <td>{if $isLangKey}<img src="../img/admin/enabled.gif" alt="ok">{else}<img src="../img/admin/disabled.gif" alt="nok">{/if}</td>
          </tr>
        {/foreach}
        </tbody>
      </table>
    </div>
    <div class="panel-footer text-center">
      <button type="submit" class="btn btn-default" value="{l s='Repare' mod='fixconfigurationlang'}" name="submit{$technicalName|escape:'htmlall':'UTF-8'}">
        <img src="{$modulePath|escape:'htmlall':'UTF-8'}logo.png" width="36" height="36" alt="{l s='Repare' mod='fixconfigurationlang'}"> {l s='Repare' mod='fixconfigurationlang'}
      </button>
    </div>
  </div>
</form>
