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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');


// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space

?>
<div class="blog-featured<?php echo $this->pageclass_sfx;?>">
<?php if ( $this->params->get('show_page_heading')!=0) : ?>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
<?php endif; ?>

<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="items-leading">
	<?php foreach ($this->lead_items as &$item) : ?>
		<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php
				$this->item = &$item;
//                $media          = &JModel::getInstance('Media','TZ_PortfolioModel');
//                $media -> setParams($this -> mediaParams);
//                $listMedia      = $media -> getMedia($this -> item -> id);
//                $this -> assign('listMedia',$listMedia);
//                require(JPATH_COMPONENT.DS.'views'.DS.'article'.DS.'tmpl'.DS.'default_media.php');
                    
                $mediaParams    = $this -> mediaParams;

                if($mediaParams -> get('article_leading_image_size','L')){
                    $mediaParams -> set('article_leading_image_resize',$mediaParams -> get('article_leading_image_size','L'));
                }
                if($mediaParams -> get('article_leading_image_gallery_size','L')){
                    $mediaParams -> set('article_leading_image_gallery_resize',strtolower($mediaParams -> get('article_leading_image_gallery_size','L')));
                }
                $this -> assign('mediaParams',$mediaParams);
                    
				echo $this->loadTemplate('item');
			?>
		</div>
		<?php
			$leadingcount++;
		?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>
	<?php foreach ($this->intro_items as $key => &$item) : ?>

	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) : ?>

			<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
		<?php endif; ?>
		<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>">
			<?php
					$this->item = &$item;
//                    $media2          = &JModel::getInstance('Media','TZ_PortfolioModel');
//                    $media2 -> setParams($this -> mediaParams);
//                    $listMedia2      = $media2 -> getMedia($this -> item -> id);
//                    $this -> assign('listMedia',$listMedia2);
//                    require(JPATH_COMPONENT.DS.'views'.DS.'article'.DS.'tmpl'.DS.'default_media.php');
                    $mediaParams    = $this -> mediaParams;
                    if($mediaParams -> get('article_leading_image_size')){
                        $mediaParams -> set('article_leading_image_resize','');
                    }
                    if($mediaParams -> get('article_leading_image_gallery_size')){
                        $mediaParams -> set('article_leading_image_gallery_resize','');
                    }
                    if($mediaParams -> get('article_secondary_image_size','M')){
                        $mediaParams -> set('article_secondary_image_resize',$mediaParams -> get('article_secondary_image_size','M'));
                    }
                    if($mediaParams -> get('article_secondary_image_gallery_size','M')){
                        $mediaParams -> set('article_secondary_image_gallery_resize',$mediaParams -> get('article_secondary_image_gallery_size','M'));
                    }
                    $this -> assign('mediaParams',$mediaParams);
					echo $this->loadTemplate('item');
			?>
		</div>
		<?php $counter++; ?>
			<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
				<span class="row-separator"></span>
				</div>

			<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
	<div class="items-more">
	<?php echo $this->loadTemplate('links'); ?>
	</div>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php  endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>

</div>
