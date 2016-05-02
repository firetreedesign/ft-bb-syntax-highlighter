<?php

/**
 * @class FLExampleModule
 */
class FTSyntaxHighlighter extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Syntax Highlighter', 'ft-bb-syntax-highlighter'),
            'description'   => __('Display code with syntax highlighting.', 'ft-bb-syntax-highlighter'),
            'category'		=> __('Advanced Modules', 'ft-bb-syntax-highlighter'),
            'dir'           => FT_BB_SYNTAX_HIGHLIGHTER_DIR . 'ft-syntax-highlighter/',
            'url'           => FT_BB_SYNTAX_HIGHLIGHTER_URL . 'ft-syntax-highlighter/',
        ));

        $this->add_js('prism', $this->url . 'js/prism/prism.js', array(), '', true);

    }

    public function enqueue_scripts() {

        if ( ! $this->settings ) {
            return;
        }

        $theme = get_theme_mod( 'ft_bb_syntax_hilighter_theme', 'default' );

        switch( $theme ) {
            case 'coy':
                $this->add_css('prism-coy', $this->url . 'js/prism/themes/prism-coy.css');
                break;
            case 'dark':
                $this->add_css('prism-dark', $this->url . 'js/prism/themes/prism-dark.css');
                break;
            case 'funky':
                $this->add_css('prism-funky', $this->url . 'js/prism/themes/prism-funky.css');
                break;
            case 'okaidia':
                $this->add_css('prism-okaidia', $this->url . 'js/prism/themes/prism-okaidia.css');
                break;
            case 'solarizedlight':
                $this->add_css('prism-solarizedlight', $this->url . 'js/prism/themes/prism-solarizedlight.css');
                break;
            case 'twilight':
                $this->add_css('prism-twilight', $this->url . 'js/prism/themes/prism-twilight.css');
                break;
            default:
                $this->add_css('prism', $this->url . 'js/prism/themes/prism.css');
                break;
        }

        // Load the language
        $this->add_js('prism-' . $this->settings->code_language . '-language', $this->url . 'js/prism/languages/' . $this->settings->code_language . '.js', array('prism'), '', true);

        // Show language
        $this->add_css('prism-show-language-plugin', $this->url . 'js/prism/plugins/show-language/show-language.css');
        $this->add_js('prism-show-language-plugin', $this->url . 'js/prism/plugins/show-language/show-language.js', array(), '', true);

    }

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FTSyntaxHighlighter', array(
    'code'       => array(
		'title'         => __('Code', 'ft-bb-syntax-highlighter'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'code'          => array(
						'type'          => 'ft-syntax-highlighter',
						'label'         => '',
						'rows'          => '19',
                        'preview'       => array(
							'type'     => 'text',
							'selector' => '.ft-bb-syntax-highlighter'
						)
					)
				)
			)
		)
	),
    'settings' => array(
		'title'    => __('Code Settings', 'ft-bb-syntax-highlighter'),
		'sections' => array(
			'general' => array(
				'title'  => '',
				'fields' => array(
                    'code_language' => array(
                        'type'    => 'select',
                        'label'   => __('Language', 'ft-bb-syntax-highlighter'),
                        'default' => 'php',
                        'preview' => array(
							'type' => 'none',
						),
                        'options' => array(
                            'php'        => __('PHP', 'ft-bb-syntax-highlighter'),
                            'markup'     => __('HTML', 'ft-bb-syntax-highlighter'),
                            'css'        => __('CSS', 'ft-bb-syntax-highlighter'),
                            'javascript' => __('JavaScript', 'ft-bb-syntax-highlighter'),
                            'json'       => __('JSON', 'ft-bb-syntax-highlighter'),
                            'markdown'   => __('Markdown', 'ft-bb-syntax-highlighter'),
                        )
                    ),
				)
			)
		)
	)
));

function ft_syntax_highlighter_field( $name, $value, $field, $settings ) {
    ?>
    <div class="ft-syntax-highlighter-field">
    	<?php $editor_id = 'ftsyntaxhighlighter' . time() . '_' . $name; ?>
    	<textarea id="<?php echo $editor_id; ?>" name="<?php echo $name; ?>" data-editor="<?php echo $field['editor']; ?>" <?php if(isset($field['class'])) echo ' class="'. $field['class'] .'"'; if(isset($field['rows'])) echo ' rows="'. $field['rows'] .'"'; ?>><?php echo htmlspecialchars($value); ?></textarea>
    	<script>

    	jQuery(function(){

    		var textarea = jQuery('#<?php echo $editor_id; ?>'),
    			mode     = '<?php echo $settings->code_language; ?>',
    			editDiv  = jQuery('<div>', {
    				position:   'absolute',
    				height:     parseInt(textarea.attr('rows'), 10) * 20
    			}),
    			editor = null;

    		editDiv.insertBefore(textarea);
    		textarea.css('display', 'none');
    		ace.require('ace/ext/language_tools');
    		editor = ace.edit(editDiv[0]);
    		editor.$blockScrolling = Infinity;
    		editor.getSession().setValue(textarea.val());
    		// editor.getSession().setMode('ace/mode/' + mode);

    		editor.setOptions({
    	        enableBasicAutocompletion: true,
    	        enableLiveAutocompletion: true,
    	        enableSnippets: false
    	    });

    		editor.getSession().on('change', function(e) {
    			textarea.val(editor.getSession().getValue()).trigger('change');
    		});
    	});

    	</script>
    </div>
    <?php
}
add_action('fl_builder_control_ft-syntax-highlighter', 'ft_syntax_highlighter_field', 1, 4);
