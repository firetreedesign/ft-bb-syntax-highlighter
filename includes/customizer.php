<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * FT Syntax Highlighter Customizer class
 *
 * @since 1.0.0
 */
class FT_BB_Syntax_Highlighter_Customizer {

	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Register sections and fields with the customizer
	 *
	 * @since 1.0.0
	 *
	 * @param  object $wp_customize The customizer object
	 */
	public function customize_register( $wp_customize ) {

		$wp_customize->add_section( 'ft_bb_syntax_highlighter', array(
			'title'			=> __('Syntax Highlighter', 'ft-bb-syntax-highlighter'),
			'priority'		=> 160,
		) );

		$wp_customize->add_setting( 'ft_bb_syntax_hilighter_theme', array(
			'type'		=> 'theme_mod',
			'transport'	=> 'refresh',
			'default'	=> 'default',
		) );

		$wp_customize->add_control( 'ft_bb_syntax_hilighter_theme', array(
			'label'		=> __('Theme', 'ft-bb-syntax-highlighter'),
			'type'		=> 'radio',
			'section'	=> 'ft_bb_syntax_highlighter',
			'choices'	=> array(
				'default'        => __('Default', 'ft-bb-syntax-highlighter'),
				'coy'            => __('Coy', 'ft-bb-syntax-highlighter'),
				'dark'           => __('Dark', 'ft-bb-syntax-highlighter'),
				'funky'          => __('Funky', 'ft-bb-syntax-highlighter'),
				'okaidia'        => __('Okaidia', 'ft-bb-syntax-highlighter'),
				'solarizedlight' => __('Solarized Light', 'ft-bb-syntax-highlighter'),
				'twilight'       => __('Twilight', 'ft-bb-syntax-highlighter'),
			),
			'priority'	=> 20,
		) );

	}

}
new FT_BB_Syntax_Highlighter_Customizer();
