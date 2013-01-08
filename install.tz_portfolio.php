<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
 
// No direct access
defined('_JEXEC') or die;

jimport('joomla.installer.installer');
JFactory::getLanguage() -> load('com_tz_portfolio');

$mediaFolder    = 'tz_portfolio';
$mediaFolderPath    = JPATH_SITE.DS.'media'.DS.$mediaFolder;
$article    = 'article';
$cache      = 'cache';
$src        = 'src';

if(!JFolder::exists($mediaFolderPath)){
    JFolder::create($mediaFolderPath);
}
if(!JFile::exists($mediaFolderPath.DS.'index.html')){
    JFile::write($mediaFolderPath.DS.'index.html',htmlspecialchars_decode('<!DOCTYPE html><title></title>'));
}
if(!JFolder::exists($mediaFolderPath.DS.$article)){
    JFolder::create($mediaFolderPath.DS.$article);
}
if(!JFile::exists($mediaFolderPath.DS.$article.DS.'index.html')){
    JFile::write($mediaFolderPath.DS.$article.DS.'index.html',htmlspecialchars_decode('<!DOCTYPE html><title></title>'));
}
if(!JFolder::exists($mediaFolderPath.DS.$article.DS.$cache)){
    JFolder::create($mediaFolderPath.DS.$article.DS.$cache);
}
if(!JFile::exists($mediaFolderPath.DS.$article.DS.$cache.DS.'index.html')){
    JFile::write($mediaFolderPath.DS.$article.DS.$cache.DS.'index.html',htmlspecialchars_decode('<!DOCTYPE html><title></title>'));
}
if(!JFolder::exists($mediaFolderPath.DS.$article.DS.$src)){
    JFolder::create($mediaFolderPath.DS.$article.DS.$src);
}
if(!JFile::exists($mediaFolderPath.DS.$article.DS.$src.DS.'index.html')){
    JFile::write($mediaFolderPath.DS.$article.DS.$src.DS.'index.html',htmlspecialchars_decode('<!DOCTYPE html><title></title>'));
}


//$imageFolderPath    = JPATH_SITE.DS.'images'.DS.$mediaFolder;
//if(!JFolder::exists($imageFolderPath)){
//    JFolder::create($imageFolderPath);
//}
//if(!JFile::exists($imageFolderPath.'/index.html')){
//    JFile::write($imageFolderPath.'/index.html',htmlspecialchars_decode('<!DOCTYPE html><title></title>'));
//}

$db     = &JFactory::getDbo();
$lang   = &JFactory::getLanguage();
$lang ->load('com_tz_portfolio');
$status = new JObject();
$status->modules = array();
$src = $this->parent->getPath('source');

if(version_compare( JVERSION, '1.6.0', 'ge' )) {
    $modules = &$this->manifest->xpath('modules/module');
    foreach($modules as $module){
        $result = null;
        $mname = $module->getAttribute('module');
        $client = $module->getAttribute('client');
        if(is_null($client)) $client = 'site';
        ($client=='administrator')? $path=$src.DS.'administrator'.DS.'modules'.DS.$mname: $path = $src.DS.'modules'.DS.$mname;
        $installer = new JInstaller();
        $result = $installer->install($path);
        $status->modules[] = array('name'=>$mname,'client'=>$client, 'result'=>$result);
    }

    $plugins = &$this->manifest->xpath('plugins/plugin');
    foreach($plugins as $plugin){
        $result = null;
        $folder = null;
        $pname  = $plugin->getAttribute('plugin');
        $group  = $plugin->getAttribute('group');
        $folder = $plugin -> getAttribute('folder');
        if(isset($folder)){
            $folder = $plugin -> getAttribute('folder');
        }
        $path   = $src.DS.'plugins'.DS.$group.DS.$folder;

        $installer = new JInstaller();
        $result = $installer->install($path);
        $status->plugins[] = array('name'=>$pname,'group'=>$group, 'result'=>$result);
    }

    if($languages = &$this->manifest->xpath('languagePackage/language')){
        foreach($languages as $language){
            $result     = null;
            $country    = null;
            $lname      = $language->getAttribute('folder');
            if($language -> getAttribute('language')){
                $country    = $language -> getAttribute('language');
            }

            $path   = $src.DS.'languages'.DS.$lname;
            $installer = new JInstaller();
            $result = $installer->install($path);
            $status-> languages[] = array('language'=>$lname,'country'=>$country, 'result'=>$result);
        }
    }


    $query  = 'UPDATE #__extensions SET `enabled`=1 WHERE `element`="tz_portfolio" AND `folder`="system"';
    $db -> setQuery($query);
    $db -> query();
    
    $query  = 'UPDATE #__extensions SET `enabled`=1 WHERE `element`="tz_portfolio" AND `folder`="user"';
    $db -> setQuery($query);
    $db -> query();

    $query  = 'UPDATE #__extensions SET `enabled`=1 WHERE `element`="tz_portfolio_comment" AND `folder`="content"';
    $db -> setQuery($query);
    $db -> query();

    $query  = 'UPDATE #__extensions SET `enabled`=1 WHERE `element`="tz_portfolio_vote" AND `folder`="content"';
    $db -> setQuery($query);
    $db -> query();

    $query  = 'UPDATE #__extensions SET `enabled`=1 WHERE `element`="tz_portfolio_content" AND `folder`="search"';
    $db -> setQuery($query);
    $db -> query();

    $query  = 'UPDATE #__extensions SET `enabled`=1 WHERE `element`="tz_portfolio_categories" AND `folder`="search"';
    $db -> setQuery($query);
    $db -> query();

    $query  = 'UPDATE #__extensions SET `enabled`=0 WHERE `element`="content" AND `folder`="search"';
    $db -> setQuery($query);
    $db -> query();
    $query  = 'UPDATE #__extensions SET `enabled`=0 WHERE `element`="categories" AND `folder`="search"';
    $db -> setQuery($query);
    $db -> query();
}
?>

<?php $rows = 0; ?>
<h2><?php echo JText::_('COM_TZ_PORTFOLIO_HEADING_INSTALL_STATUS'); ?></h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('COM_TZ_PORTFOLIO_EXTENSION'); ?></th>
			<th width="30%"><?php echo JText::_('COM_TZ_PORTFOLIO_STATUS'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo JText::_('COM_TZ_PORTFOLIO').' '.JText::_('COM_TZ_PORTFOLIO_COMPONENT'); ?></td>
			<td><strong><?php echo JText::_('COM_TZ_PORTFOLIO_INSTALLED'); ?></strong></td>
		</tr>
		<?php if (count($status->modules)): ?>
		<tr>
			<th><?php echo JText::_('COM_TZ_PORTFOLIO_MODULE'); ?></th>
			<th><?php echo JText::_('COM_TZ_PORTFOLIO_CLIENT'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->modules as $module): ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo ($module['result'])?JText::_('COM_TZ_PORTFOLIO_INSTALLED'):JText::_('COM_TZ_PORTFOLIO_NOT_INSTALLED'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>

        <?php if (count($status->plugins)): ?>
		<tr>
			<th><?php echo JText::_('COM_TZ_PORTFOLIO_PLUGIN'); ?></th>
			<th><?php echo JText::_('COM_TZ_PORTFOLIO_GROUP'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->plugins as $plugin): ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo ($plugin['result'])?JText::_('COM_TZ_PORTFOLIO_INSTALLED'):JText::_('COM_TZ_PORTFOLIO_NOT_INSTALLED'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>

        <?php if (count($status->languages)): ?>
		<tr>
			<th><?php echo JText::_('COM_TZ_PORTFOLIO_LANGUAGES'); ?></th>
			<th><?php echo JText::_('COM_TZ_PORTFOLIO_COUNTRY'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->languages as $language): ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($language['language']); ?></td>
			<td class="key"><?php echo ucfirst($language['country']); ?></td>
			<td><strong><?php echo ($language['result'])?JText::_('COM_TZ_PORTFOLIO_INSTALLED'):JText::_('COM_TZ_PORTFOLIO_NOT_INSTALLED'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>

	</tbody>
</table>