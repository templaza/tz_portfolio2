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
//jimport('joomla.base.adapterinstance');

class com_tz_portfolioInstallerScript{

    function postflight($type, $parent){

        $manifest   = $parent -> get('manifest');
        $params     = new JRegistry();

        $query  = 'SELECT params FROM #__extensions'
                  .' WHERE `type`="component" AND `name`="'.strtolower($manifest -> name).'"';
        $db     = &JFactory::getDbo();
        $db -> setQuery($query);
        $db -> query();

        $params -> loadString($db ->loadResult());
        $paramNames = array();
        if(count($params -> toArray())>0){
            foreach($params -> toArray() as $key => $val){
                $paramNames[]   = $key;
            }
        }
//        if(count($params -> toArray()) == 0){
        $fields     = $manifest -> xPath('config/fields/field');

        foreach($fields as $field){
            if(!in_array($field -> getAttribute('name'),$paramNames)){
                if($field -> getAttribute('multiple') == 'true'){
                    $arr   = array();
                    $options    = $manifest -> xPath('config/fields/field/option');
                    foreach($options as $option){
                        $arr[]  = $option -> getAttribute('value');
                    }

                    $params -> setValue($field -> getAttribute('name'),$arr);

                }
                else
                    $params -> setValue($field -> getAttribute('name'),$field -> getAttribute('default'));
            }
        }

        $params = $params -> toString();

        $query  = 'UPDATE #__extensions SET `params`=\''.$params.'\''
                  .' WHERE `name`="'.strtolower($manifest -> name).'"'
                  .' AND `type`="component"';

        $db -> setQuery($query);
        $db -> query();
        $this -> UpdateSql();
    }

    function UpdateSql(){
        $db     = &JFactory::getDbo();
        $arr    = null;
        $fields = $db -> getTableFields('#__tz_portfolio_xref_content');
        if(!array_key_exists('gallery',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `gallery` TEXT NOT NULL';
        }
        if(!array_key_exists('gallerytitle',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `gallerytitle` TEXT NOT NULL';
        }
        if(!array_key_exists('video',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `video` TEXT NOT NULL';
        }
        if(!array_key_exists('videotitle',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `videotitle` TEXT NOT NULL';
        }
        if(!array_key_exists('type',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `type` VARCHAR(25)';
        }
        if(!array_key_exists('videothumb',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `videothumb` TEXT';
        }
        if(!array_key_exists('`images_blackwhite`',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `images_hover` TEXT NULL';
        }
        if(!array_key_exists('`attachold`',$fields['#__tz_portfolio_xref_content'])){
            $arr[]  = 'ADD `attachold` TEXT NULL';
        }
        if($arr && count($arr)>0){
            $arr    = implode(',',$arr);
            if($arr){
                $query  = 'ALTER TABLE `#__tz_portfolio_xref_content` '.$arr;
                $db -> setQuery($query);
                $db -> query();
            }
        }

        //TZ Categories
        $fields = $db -> getTableFields('#__tz_portfolio_categories');
        if(!array_key_exists('images',$fields['#__tz_portfolio_categories'])){
            $query  = 'ALTER TABLE `#__tz_portfolio_categories` ADD `images` TEXT NOT NULL';
            $db -> setQuery($query);
            $db -> query();
        }

        // extra fields
        $arr    = null;
        $fields = $db -> getTableFields('#__tz_portfolio_fields');
        if(!array_key_exists('default_value',$fields['#__tz_portfolio_fields'])){
            $arr[]  = 'ADD `default_value` TEXT NOT NULL';
        }
        if($arr && count($arr)>0){
            $arr    = implode(',',$arr);
            if($arr){
                $query  = 'ALTER TABLE `#__tz_portfolio_fields` '.$arr;
                $db -> setQuery($query);
                $db -> query();
            }
        }
    }
}