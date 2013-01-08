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
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$blogItemParams = $params;
$blogItemParams -> merge(new JRegistry($this -> item -> attribs));
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();
$tmpl   = null;
if($params -> get('tz_use_lightbox',1) == 1){
    $tmpl   = '&tmpl=component';
}
?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>


<?php if ($params->get('show_print_icon',1) || $params->get('show_email_icon',1) || $canEdit) : ?>
	<ul class="Tzactions">
		<?php if ($params->get('show_print_icon',1)) : ?>
		<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($params->get('show_email_icon',1)) : ?>
		<li class="email-icon">
			<?php echo JHtml::_('icon.email', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($canEdit) : ?>
		<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
		</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>

<?php
 if($params -> get('show_image',1) == 1 OR $params -> get('show_image_gallery',1) == 1
         OR $params -> get('show_video',1) == 1):
?>
    <?php

        $media          = &JModel::getInstance('Media','TZ_PortfolioModel');
        $media -> setParams($this -> mediaParams);
        $listMedia      = $media -> getMedia($this -> item -> id);
        $this -> assign('listMedia',$listMedia);
        if($blogItemParams -> get('tz_portfolio_redirect') == 'p_article'){
            $this -> assign('itemLink',JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid).$tmpl));
        }
        else{
            $this -> assign('itemLink',JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid).$tmpl));
        }
        echo $this -> loadTemplate('media');
    ?>
<?php endif;?>

<?php if ($params->get('show_title',1)) : ?>
	<h3 class="TzBlogTitle">
		<?php if ($params->get('link_titles',1) && $params->get('access-view')) : ?>
            <?php
                if(strtolower($blogItemParams -> get('tz_portfolio_redirect')) == 'p_article'){
                    $href   = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid).$tmpl);
                    $_href   = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid));
                }
                else{
                    $href   = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid).$tmpl);
                    $_href   = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
                }
            ?>
			<a<?php if($params -> get('tz_use_lightbox') == 1) echo ' class="fancybox fancybox.iframe"';?> href="<?php echo $href; ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h3>
<?php endif; ?>
<?php if (!$params->get('show_intro',1)) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php if (($params->get('show_author',1)) or ($params->get('show_category',1)) or ($params->get('show_create_date',1)) or ($params->get('show_modify_date',1)) or ($params->get('show_publish_date',1)) or ($params->get('show_parent_category',1)) or ($params->get('show_hits',1))) : ?>
 <div class="TzArticleBlogInfo">
<?php endif; ?>
  <?php if ($params->get('show_hits')) : ?>
      <span class="TzBlogHits">
        <label class="numbers"><?php echo  $this->item->hits; ?></label>
        <label class="hits"><?php echo JText::_('ARTICLE_HITS'); ?></label>
      </span>
  <?php endif; ?>

<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
		<span class="TzParentCategoryName">
			<?php $title = $this->escape($this->item->parent_title);
				$url = '<a href="' . JRoute::_(TZ_PortfolioHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_parent_category')) : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</span>
<?php endif; ?>

<?php if ($params->get('show_category',1)) : ?>
		<span class="TzBlogCategory">
			<?php $title = $this->escape($this->item->category_title);
					$url = '<a href="' . JRoute::_(TZ_PortfolioHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_category',1)) : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</span>
<?php endif; ?>

<?php if ($params->get('show_modify_date',1)) : ?>
    <span class="TzBlogModified">
    <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
    </span>
  <?php endif; ?>
<?php if ($params->get('show_publish_date',1)) : ?>
		<span class="TzBlogPublished">
		<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
		</span>
<?php endif; ?>
<?php if ($params->get('show_author',1) && !empty($this->item->author )) : ?>
	<span class="TzBlogCreatedby">
		<?php $author =  $this->item->author; ?>
		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

			<?php if ($params->get('link_author') == true):?>
				<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
				 JHtml::_('link', JRoute::_('index.php?option=com_tz_portfolio&amp;view=users&amp;created_by='.$this -> item -> created_by), $author)); ?>

			<?php else :?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
	</span>
<?php endif; ?>

<?php if($params -> get('tz_show_count_comment',1) == 1):?>
    <span class="TzPortfolioCommentCount">
        <?php echo JText::_('COM_TZ_PORTFOLIO_COMMENT_COUNT');?>
        <?php if($params -> get('tz_comment_type') == 'facebook'): ?>
            <?php if(isset($this -> item -> commentCount)):?>
                <?php echo $this -> item -> commentCount;?>
            <?php endif;?>
        <?php endif;?>

        <?php if($params -> get('tz_comment_type') == 'jcomment'): ?>
            <?php
                $comments = JPATH_SITE.'/components/com_jcomments/jcomments.php';
                if (file_exists($comments)){
                    require_once($comments);
                    if(class_exists('JComments')){
                         echo JComments::getCommentsCount((int) $this -> item -> id,'com_tz_portfolio');
                    }
                }
            ?>
        <?php endif;?>
        <?php if($params -> get('tz_comment_type') == 'disqus'):?>
            <?php if(isset($this -> item -> commentCount)):?>
                <?php echo $this -> item -> commentCount;?>
            <?php endif;?>
        <?php endif;?>
    </span>
<?php endif;?>

<?php
    $extraFields    = &JModel::getInstance('ExtraFields','TZ_PortfolioModel',array('ignore_request' => true));
    $extraFields -> setState('article.id',$this -> item -> id);
    $extraFields -> setState('category.id',$this -> item -> catid);
    $extraFields -> setState('orderby',$params -> get('fields_order'));

    $extraParams    = $extraFields -> getParams();
    $itemParams     = new JRegistry($this -> item -> attribs);

    if($itemParams -> get('tz_fieldsid'))
        $extraParams -> set('tz_fieldsid',$itemParams -> get('tz_fieldsid'));

    $extraFields -> setState('params',$extraParams);
    $this -> item -> params = $extraParams;
    $this -> assign('listFields',$extraFields -> getExtraFields());
?>
<?php echo $this -> loadTemplate('extrafields');?>

<?php if (($params->get('show_author',1)) or ($params->get('show_category',1)) or ($params->get('show_create_date',1)) or ($params->get('show_modify_date',1)) or ($params->get('show_publish_date',1)) or ($params->get('show_parent_category',1)) or ($params->get('show_hits',1))) :?>
 	</div>
  <div class="TzDate">
    <?php if ($params->get('show_create_date')) : ?>
		<span class="TzBlogCreate">
		  <span class="date"> <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?></span>
		</span>
  <?php endif; ?>
  </div>
<?php endif; ?>

<div class="TzDescription">
<?php echo $this->item->introtext; ?>
</div>

<?php if ($params->get('show_readmore',1) && $this->item->readmore) :
	if ($params->get('access-view')) :
        if($blogItemParams -> get('tz_portfolio_redirect') == 'p_article'){
		    $link = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid));
        }
        else{
		    $link = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
        }
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&amp;view=login&amp;Itemid='.$itemId);
        if($blogItemParams -> get('tz_portfolio_redirect') == 'p_article'){
		    $returnURL = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid));
        }
        else{
		    $returnURL = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
        }
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
    <a class="TzReadmore<?php if($params -> get('tz_use_lightbox') == 1) echo ' fancybox fancybox.iframe';?>" href="<?php echo $link; ?>">
        <?php echo JText::_('TZ_READMORE'); ?>
    </a>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>
