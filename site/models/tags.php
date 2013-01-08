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

class TZ_PortfolioModelTags extends JModel
{
    protected $pagNav   = null;

    function populateState(){
        $app    = &JFactory::getApplication('site');
        $params = $app -> getParams();
        $this -> setState('params',$params);
        $pk = JRequest::getInt('id');
        $this -> setState('tags.id',$pk);
        $offset = JRequest::getUInt('limitstart',0);
        $this -> setState('offset', $offset);
        $this -> setState('tags.catid',null);


    }
    
    function getTags(){
        $app    = &JFactory::getApplication('site');
         $params = $this -> getState('params');
        $limit  = $app->getUserStateFromRequest('com_tz_portfolio.tags.limit','limit',10);


        if($params -> get('tz_article_limit')){
            $limit  = $params -> get('tz_article_limit');
        }
//        $menuParams = new JRegistry;
//
//        if ($menu = $app->getMenu()->getActive()) {
//            $menuParams->loadString($menu->params);
//        }
//
//        $mergedParams = clone $menuParams;
//        $mergedParams->merge($params);

        $params -> set('access-view',true);

        $this->setState('params', $params);

        $query  = 'SELECT COUNT(*) FROM #__content AS c'
            .' LEFT JOIN #__tz_portfolio_tags_xref AS x ON c.id=x.contentid'
            .' WHERE x.tagsid='.$this -> getState('tags.id');
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
            .' LEFT JOIN #__tz_portfolio_tags_xref AS x ON c.id=x.contentid'
            .' LEFT JOIN #__tz_portfolio_tags AS t ON t.id=x.tagsid'
            .' WHERE c.state=1 AND t.published=1 AND x.tagsid='.$this -> getState('tags.id')
            .' ORDER BY '.$orderby;
        
        $db     = &JFactory::getDbo();
        $db -> setQuery($query,$this -> pagNav -> limitstart,$this -> pagNav -> limit);

        if(!$db -> query()){
            var_dump($db -> getErrorMsg());
            return false;
        }
        
        $rows   = $db -> loadObjectList();


        if(count($rows)>0){
            require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'libraries'.DS.'HTTPFetcher.php');
            require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'libraries'.DS.'readfile.php');
            $i=0;
            foreach($rows as $row){

                if($params -> get('tz_comment_type','disqus') == 'facebook'){
                    if($params -> get('tz_show_count_comment',1) == 1){
                        $tzRedirect = $params -> get('tz_portfolio_redirect','p_article'); //Set params for $tzRedirect
                        $itemParams = new JRegistry($row -> attribs); //Get Article's Params
                        //Check redirect to view article
                        if($itemParams -> get('tz_portfolio_redirect')){
                            $tzRedirect = $itemParams -> get('tz_portfolio_redirect');
                        }
                        if($tzRedirect == 'p_article'){
                            $contentUrl = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($row -> slug, $row -> catid),true,-1);
                        }
                        else{
                            $contentUrl = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($row -> slug, $row -> catid),true,-1);
                        }
                        $url    = 'http://graph.facebook.com/?ids='.$contentUrl;
                        $face       = new Services_Yadis_PlainHTTPFetcher();
                        $content    = $face -> get($url);
                        if($content)
                            $content    = json_decode($content -> body);

                        if(isset($content -> $contentUrl -> comments))
                            $row -> commentCount   = $content -> $contentUrl  -> comments;
                        else
                            $row -> commentCount   = 0;
                    }
                }

                if ($params->get('show_intro', '1')=='1') {
                    $rows[$i] -> text = $row -> introtext;
                }


                
                $i++;
            }
            return $rows;
        }
        return '';
    }

    function getPagination(){
        if($this -> pagNav)
            return $this -> pagNav;
        return '';
    }

    function getFindType($_cid=null)
	{
        $cid    = $this -> getState('tags.catid');
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
        $cid        =   intval($cid);
        if($_cid){
            $cid    = intval($_cid);
        }

        $component	= JComponentHelper::getComponent('com_tz_portfolio');
		$items		= $menus->getItems('component_id', $component->id);

        foreach ($items as $item)
        {

            if (isset($item->query) && isset($item->query['view'])) {
                $view = $item->query['view'];

                if (isset($item->query['id'])) {
                    if ($item->query['id'] == $cid) {
                        return 0;
                    }
                } else {

                    $catids = $item->params->get('tz_catid');
                    if ($view == 'portfolio' && $catids) {
                        if (is_array($catids)) {
                            for ($i = 0; $i < count($catids); $i++) {
                                if ($catids[$i] == 0 || $catids[$i] == $cid) {
                                    return 1;
                                }
                            }
                        } else {
                            if ($catids == $cid) {
                                return 1;
                            }
                        }
                    }
                }
            }
        }

		return 0;
	}
}