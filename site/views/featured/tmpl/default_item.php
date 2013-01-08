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

$tmpl   = null;
if($params -> get('tz_use_lightbox',1) == 1){
    $tmpl   = '&tmpl=component';
}

?>
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

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h2>
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
            <?php
                if(strtolower($blogItemParams -> get('tz_portfolio_redirect')) == 'p_article'){
                    $href   = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid).$tmpl);
                }
                else{
                    $href   = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid).$tmpl);
                }
            ?>
			<a<?php if($params -> get('tz_use_lightbox') == 1) echo ' class="fancybox fancybox.iframe"';?> href="<?php echo $href; ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
	<ul class="actions">
		<?php if ($params->get('show_print_icon')) : ?>
		<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($params->get('show_email_icon')) : ?>
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

<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
 <dl class="article-info">
 <dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
		<dd class="parent-category-name">
			<?php $title = $this->escape($this->item->parent_title);
				$url = '<a href="' . JRoute::_(TZ_PortfolioHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
		<dd class="category-name">
			<?php $title = $this->escape($this->item->category_title);
				$url = '<a href="'.JRoute::_(TZ_PortfolioHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_category') and $this->item->catslug) : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
		<dd class="create">
		<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
		<dd class="modified">
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published">
		<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
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

<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<dd class="createdby">
		<?php $author =  $this->item->author; ?>
		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

			<?php if ($params->get('link_author') == true):?>
				<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
				 JHtml::_('link', JRoute::_('index.php?option=com_tz_portfolio&view=users&created_by='.$this -> item -> created_by), $author)); ?>

			<?php else :?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
		</dd>
<?php endif; ?>
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
 </dl>
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

<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>

	<div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
	<img
		<?php if ($images->image_intro_caption):
			echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</div>
<?php endif; ?>

<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		if($blogItemParams -> get('tz_portfolio_redirect') == 'p_article'){
		    $link = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid).$tmpl);
        }
        else{
		    $link = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid).$tmpl);
        }
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid='.$itemId.$tmpl);
		if($blogItemParams -> get('tz_portfolio_redirect') == 'p_article'){
		    $returnURL = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($this->item->slug, $this->item->catid).$tmpl);
        }
        else{
		    $returnURL = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($this->item->slug, $this->item->catid).$tmpl);
        }
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
			<p class="readmore">
				<a<?php if($params -> get('tz_use_lightbox') == 1) echo ' class="fancybox fancybox.iframe"';?>
                        href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
						    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>
