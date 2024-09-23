<section class='<?php echo $is_sticky ? '' : esc_attr($module_classes); ?>' data-class='<?php echo esc_attr($module_classes); ?>' id="<?php echo esc_attr($this->module_id(false)); ?>" data-type='et_pb_wpt_gravityform' data-is-sticky='<?php echo $is_sticky ? 'yes' : 'no'; ?>'>
	<?php echo do_shortcode($gravityform_shortcode); ?>
</section>
