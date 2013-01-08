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

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
$listImage  = $this -> listImage;
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'category.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
    window.addEvent('domready',function(){
        var jSonRequest  = new Request.JSON({url:"index.php?option=com_tz_portfolio&task=category.extrafields",
           onComplete:function(item){
               $('tz_fieldsid_content').set('html',item);
               $('tz_fieldsid_content').getParent('li').set('style','');
               if(!$('groupid').value.length)
                    $('tz_fieldsid_content').getParent('li').setStyle('display','none');
           },
           data: {
                json: JSON.encode({
                    'id':<?php echo JRequest::getInt('id');?>,
                    'groupid':$('groupid').value
                })
            }
       }).send();
        $('groupid').addEvent('change',function(e){
            e.stop();
            $('tz_fieldsid_content').getParent('li').setStyle('display','none');
           var jSonRequest  = new Request.JSON({url:"index.php?option=com_tz_portfolio&task=category.extrafields",
               onComplete:function(item){
                   $('tz_fieldsid_content').set('html',item);
                   $('tz_fieldsid_content').getParent('li').set('style','');
                   if(!$('groupid').value.length){
                        $('tz_fieldsid_content').getParent('li').setStyle('display','none');
                   }
               },
               data: {
                    json: JSON.encode({
                        'id':<?php echo JRequest::getInt('id');?>,
                        'groupid':$('groupid').value
                    })
                }
           }).send();
            
        });

        var tz_e = location.href.match(/^(.+)administrator\/index\.php.*/i)[1];

        var tz_a = new Element('input',{
            type:"text",
            class:"inputbox image-select",
            name:"tz_category_image_server",
            id:"image-select",
            readonly:'true',
            style:"width:200px;"
        });
        tz_a.inject($('tz_category_image_server'));
        var tz_d = "image-select",
            tz_b = (new Element("button", {
                type: "button",
                "id": "tz_img_button"
            })).set('text', "<?php echo JText::_('COM_TZ_PORTFOLIO_BROWSE_SERVER');?>").injectAfter(tz_a),
            tz_f = (new Element("button", {
                "name": "tz_img_cancel",
                html:'<?php echo JText::_('COM_TZ_PORTFOLIO_RESET');?>'
            })).injectAfter(tz_b),
            tz_g = (new Element("div", {
                "class": "tz-image-preview",
                "style": "clear:both;"
            })).inject(tz_f,'after');

        tz_a.setProperty("id", tz_d);
//        if(value){

//        }



        tz_f.addEvent("click", function (e) {
            e.stop();
            $('tz_category_image').value='';
            tz_a.setProperty("value", "");
        });

        tz_b.addEvent("click", function (h) { (new Event(h)).stop();
            SqueezeBox.fromElement(this, {
                handler: "iframe",
                url: "index.php?option=com_media&view=images&tmpl=component&e_name=" + tz_d,
                size: {
                    x: 800,
                    y: 500
                }
            });

            window.jInsertEditorText = function (text, editor) {
                if (editor.match(/^image-select/)) {

                    var d = $(editor);
                    var src = text.match(/src=\".*?\"/i);
                    src = String.from(src);
                    src = src.replace(/^src=\"/g,'');
                    src = src.replace(/\"$/g,'');
                    d.setProperty("value", src);
                } else tinyMCE.execInstanceCommand(editor, 'mceInsertContent',false,text);
            };
        });

        var tz_label = new Element('label',{
            html: '<?php echo JText::_('COM_TZ_PORTFOLIO_FORM_URL_IMAGE');?>'
        }).inject($('tz_category_image_server'));
        var tz_input = new Element('input',{
            name: 'tz_image_url',
            size: 40
        }).inject(tz_label,'after');
        <?php if($listImage AND !empty($listImage -> images)):?>
            var tz_label2 = new Element('label').inject($('tz_category_image_server'));
            var tz_hidden = new Element('input',{
                type: 'hidden',
                name: 'tz_category_hidden',
                value: '<?php echo $listImage -> images;?>'
            }).inject(tz_label2,'after');
    
             var tz_h = (new Element("img", {
                src: '<?php echo JURI::root().$listImage -> images;?>',
                style:'max-width:300px; cursor:pointer;'
            })).inject(tz_hidden,'after');
            tz_h.addEvent('click',function(){
               SqueezeBox.fromElement(this, {
                    handler: "image",
                    url: '<?php echo JURI::root().$listImage -> images;?>'
                });
            });
            var tz_label3 = new Element('label').inject(tz_h,'after');
            var tz_checkbox = new Element('input',{
                type: 'checkbox',
                name: 'tz_category_del_image',
                id: 'tz_category_del_image',
                value: 1
            }).inject(tz_label3,'after');
            var tz_label4 = new Element('label',{
                html:'<?php echo JText::_('COM_TZ_PORTFOLIO_CURRENT_IMAGE_DESC');?>',
                'for': 'tz_category_del_image',
                style: 'clear:none;'
            }).inject(tz_checkbox,'after');

        <?php endif;?>
    });
</script>

<form action="<?php echo JRoute::_('index.php?option=com_tz_portfolio&extension='.JRequest::getCmd('extension', 'com_content').'&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_CATEGORIES_FIELDSET_DETAILS');?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>

				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>

				<li><?php echo $this->form->getLabel('extension'); ?>
				<?php echo $this->form->getInput('extension'); ?></li>

				<li><?php echo $this->form->getLabel('parent_id'); ?>
				<?php echo $this->form->getInput('parent_id'); ?></li>

				<li><?php echo $this->form->getLabel('published'); ?>
				<?php echo $this->form->getInput('published'); ?></li>
                <li><label><?php echo JText::_('COM_TZ_PORTFOLIO_FIELDS_GROUP_REQUIRED');?></label>
                   <?php echo $this -> fieldsgroup;?>
                </li>

				<li><?php echo $this->form->getLabel('access'); ?>
				<?php echo $this->form->getInput('access'); ?></li>

				<?php if ($this->canDo->get('core.admin')): ?>
					<li><span class="faux-label"><?php echo JText::_('JGLOBAL_ACTION_PERMISSIONS_LABEL'); ?></span>
					<div class="button2-left"><div class="blank">
		      			<button type="button" onclick="document.location.href='#access-rules';">
		      			<?php echo JText::_('JGLOBAL_PERMISSIONS_ANCHOR'); ?></button>
		      		</div></div>
		    		</li>
				<?php endif; ?>

				<li><?php echo $this->form->getLabel('language'); ?>
				<?php echo $this->form->getInput('language'); ?></li>

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
                <li id="tz_category_image_server">
                    <label for="image-select"><?php echo JText::_('COM_TZ_PORTFOLIO_FORM_IMAGE');?></label>
                </li>
			</ul>
			<div class="clr"></div>
			<?php echo $this->form->getLabel('description'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('description'); ?>
		</fieldset>
	</div>

	<div class="width-40 fltrt">

		<?php echo JHtml::_('sliders.start', 'categories-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
			<?php echo $this->loadTemplate('options'); ?>
			<div class="clr"></div>

			<?php echo JHtml::_('sliders.panel', JText::_('JGLOBAL_FIELDSET_METADATA_OPTIONS'), 'meta-options'); ?>
			<fieldset class="panelform">
				<?php echo $this->loadTemplate('metadata'); ?>
			</fieldset>
		<?php echo JHtml::_('sliders.end'); ?>


	</div>
	<div class="clr"></div>

	<?php if ($this->canDo->get('core.admin')): ?>
		<div  class="width-100 fltlft">

			<?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

			<?php echo JHtml::_('sliders.panel', JText::_('COM_CATEGORIES_FIELDSET_RULES'), 'access-rules'); ?>
			<fieldset class="panelform">
				<?php echo $this->form->getLabel('rules'); ?>
				<?php echo $this->form->getInput('rules'); ?>
			</fieldset>

			<?php echo JHtml::_('sliders.end'); ?>
		</div>
	<?php endif; ?>
	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
