<?php
class TC_Custom_CSS_Textarea_Control extends WP_Customize_Control {

	public $type = 'tc_custom_css';

	/**
	 * Creates a longer textarea
	 */
	public function render_content() {
		?>
		<lable>
			<span class="customize-control-title"><?php echo $this->label ?></span>
			<span class="description customize-control-description"><?php echo $this->description ?></span>
			<textarea rows="20" style="width:100%;padding:5px 8px;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</lable>
		<?php
	}

	public function enqueue() {
		wp_enqueue_script( 'tc-motif-codemirror-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom-controls/libs/codemirror/motif-codemirror.js', array(), '2.25' );
		wp_enqueue_style( 'tc-motif-codemirror-style', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom-controls/libs/codemirror/lib/codemirror.css', array(), '2.25' );

		wp_enqueue_script( 'tc-motif-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom-controls/js/motif.js', array( 'jquery','tc-motif-codemirror-js' ), '20150301', true );
		wp_enqueue_style( 'tc-motif-style', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/custom-controls/css/motif.css', array( 'tc-motif-codemirror-style' ), '20150301' );
	}
}

