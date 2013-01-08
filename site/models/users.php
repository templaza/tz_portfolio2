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

// no direct access
defined('_JEXEC') or die();
jimport('joomla.application.component.model');
jimport('joomla.html.pagination');
 
class TZ_PortfolioModelUsers extends JModel
{
    protected $pagNav   = null;

    function populateState(){
        $pk = JRequest::getInt('created_by');
        $this -> setState('users.id',$pk);
        $offset = JRequest::getUInt('limitstart',0);
		$this->setState('offset', $offset);
        $app    = &JFactory::getApplication('site');
        $params = $app -> getParams();
        $limit  = $app->getUserStateFromRequest('com_tz_portfolio.users.limit','limit',10);
        $this -> setState('params',$params);
        $this -> setState('limit',$limit);

    }

    function getUsers(){
        $params = $this -> getState('params');
        $limit  = $this -> getState('limit');

        if($params -> get('tz_article_limit')){
            $limit  = $params -> get('tz_article_limit');
        }

        $params -> set('access-view',true);

        $this->setState('params', $params);

        $query  = 'SELECT COUNT(*) FROM #__content'
                  .' WHERE created_by='.$this -> getState('users.id');
        $db     = &JFactory::getDbo();
        $db -> setQuery($query);
        $total  = $db -> loadResult();

        $this -> pagNav = new JPagination($total,$this -> getState('offset'),$limit);

        switch ($params -> get('orderby_sec')){
            default:
                $orderby    = 'id DESC';
                break;
            case 'rdate':
                $orderby    = 'created DESC';
                break;
            case 'date':
                $orderby    = 'created ASC';
                break;
            case 'alpha':
                $orderby    = 'title ASC';
                break;
            case 'ralpha':
                $orderby    = 'title DESC';
                break;
            case 'author':
                $orderby    = 'create_by ASC';
                break;
            case 'rauthor':
                $orderby    = 'create_by DESC';
                break;
            case 'hits':
                $orderby    = 'hits DESC';
                break;
            case 'rhits':
                $orderby    = 'hits ASC';
                break;
            case 'order':
                $orderby    = 'ordering ASC';
                break;
        }

        $query  = 'SELECT c.*,cc.title AS category_title,cc.parent_id,'
            .' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(":", c.id, c.alias) ELSE c.id END as slug,'
            .' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug,'
            .' CASE WHEN CHAR_LENGTH(c.fulltext) THEN c.fulltext ELSE null END as readmore'
            .' FROM #__content AS c'
            .' LEFT JOIN #__categories AS cc ON cc.id = c.catid'
//            .' LEFT JOIN #__tz_portfolio_tags_xref AS x ON c.id=x.contentid'
//            .' LEFT JOIN #__tz_portfolio_tags AS t ON t.id=x.tagsid'
            .' WHERE c.state=1 AND c.created_by='.$this -> getState('users.id')
            .' ORDER BY '.$orderby;


        $db -> setQuery($query,$this -> pagNav -> limitstart,$this -> pagNav -> limit);

        if(!$db -> query()){
            var_dump($db -> getErrorMsg());
            return false;
        }



        if($rows   = $db -> loadObjectList()){
            return $rows;
        }

        return '';
    }

    function getPagination(){
        if($this -> pagNav)
            return $this -> pagNav;
        return '';
    }
}