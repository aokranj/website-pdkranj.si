<?php
/** no direct access **/
defined('MECEXEC') or die();

$current_month_divider = $this->request->getVar('current_month_divider', 0);

// Get layout path
$render_path = $this->get_render_path();
$styling = $this->main->get_styling();

$dark_mode = (isset($styling['dark_mode'])) ? $styling['dark_mode'] : '';
if($dark_mode == 1) $set_dark = 'mec-dark-mode';
else $set_dark = '';

ob_start();
include $render_path;
$items_html = ob_get_clean();

if(isset($this->atts['return_items']) and $this->atts['return_items'])
{
    echo json_encode(array('html'=>$items_html, 'end_date'=>$this->end_date, 'offset'=>$this->next_offset, 'count'=>$this->found, 'current_month_divider'=>$current_month_divider));
    exit;
}

$sed_method = $this->sed_method;
if ($sed_method == 'new') $sed_method = '0';

// Generating javascript code tpl
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery("#mec_skin_'.$this->id.'").mecListView(
    {
        id: "'.$this->id.'",
        start_date: "'.$this->start_date.'",
        end_date: "'.$this->end_date.'",
		offset: "'.$this->next_offset.'",
		limit: "'.$this->limit.'",
        current_month_divider: "'.$current_month_divider.'",
        toggle_month_divider: "'.$this->toggle_month_divider.'",
        style: "'.(isset($this->skin_options['style']) ? $this->skin_options['style'] : NULL).'",
        atts: "'.http_build_query(array('atts'=>$this->atts), '', '&').'",
        ajax_url: "'.admin_url('admin-ajax.php', NULL).'",
        sed_method: "'.$sed_method.'",
        image_popup: "'.$this->image_popup.'",
        sf:
        {
            container: "'.($this->sf_status ? '#mec_search_form_'.$this->id : '').'",
        },
    });
});
</script>';

// Include javascript code into the page
if($this->main->is_ajax()) echo $javascript;
else $this->factory->params('footer', $javascript);

do_action('mec_start_skin', $this->id);
do_action('mec_list_skin_head');
?>
<div class="mec-wrap mec-skin-list-container <?php echo $this->html_class . ' ' . $set_dark; ?>" id="mec_skin_<?php echo $this->id; ?>">
    
    <?php if($this->sf_status) echo $this->sf_search_form(); ?>

    <?php if($this->found): ?>
    <?php if($this->map_on_top == '1'): ?>
        <div class="mec-wrap mec-skin-map-container <?php echo $this->html_class; ?>" id="mec_skin_<?php echo $this->id; ?>">
            <div class="mec-googlemap-skin" id="mec_googlemap_canvas<?php echo $this->id; ?>" style="height: 500px;">
            <?php 
                $map = isset($this->settings['default_maps_view']) ? $this->settings['default_maps_view'] : 'google';
                do_action('mec_map_inner_element_tools', array('map'=>$map));
            ?>
            </div>
            <input type="hidden" id="gmap-data" value="">
        </div>
    <?php endif; ?>
    <div class="mec-skin-list-events-container<?php if($this->style == 'accordion' and $this->toggle_month_divider and $this->month_divider) echo ' mec-toggle-month-divider'; ?>" id="mec_skin_events_<?php echo $this->id; ?>">
        <?php echo $items_html; ?>
    </div>
    <div class="mec-skin-list-no-events-container mec-util-hidden" id="mec_skin_no_events_<?php echo $this->id; ?>">
        <?php _e('No event found!', 'modern-events-calendar-lite'); ?>
    </div>
    <?php else: ?>
    <div class="mec-skin-list-events-container<?php if($this->style == 'accordion' and $this->toggle_month_divider and $this->month_divider) echo ' mec-toggle-month-divider'; ?>" id="mec_skin_events_<?php echo $this->id; ?>">
        <?php _e('No event found!', 'modern-events-calendar-lite'); ?>
    </div>
    <?php endif; ?>
    
    <?php if($this->load_more_button and $this->found >= $this->limit): ?>
    <div class="mec-load-more-wrap"><div class="mec-load-more-button" onclick=""><?php echo __('Load More', 'modern-events-calendar-lite'); ?></div></div>
    <?php endif; ?>
    
</div>