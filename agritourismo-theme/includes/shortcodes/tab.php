<?php

class OT_Tabs {

	static $shortcodeCount;
	static $shortcodeData;
	static $currentTab;

	/**
	 * init function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	static function init() {

		add_shortcode( 'tab', array(__CLASS__, 'tab_shortcode' ) );
		add_shortcode( 'tabs', array(__CLASS__, 'tabs_shortcode' ) );

		self::$shortcodeCount = 0;
		
	}
	
	/**
	 * tab_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static  function tab_shortcode( $atts, $content ) {
		extract(shortcode_atts(array('title' => null,), $atts) );
	
		self::$shortcodeData[  self::$currentTab ][] = array( 'title' => $title);
		self::$shortcodeCount++;

		return '<div>'.$content.'</div>';
		
	}
	
	
	/**
	 * tabs_shortcode function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param mixed $content
	 * @return void
	 */
	public static function tabs_shortcode( $atts, $content ) {
		$tabContent = do_shortcode( $content );

		$return='<div class="tabs">';
			$return.='<ul>';
				$counter = 0;
				foreach( self::$shortcodeData[self::$currentTab] as $val ):
					$return.='<li><a href="#">'.$val['title'].'</a></li>'; 
				$counter++;
				endforeach;
				
			$return.='</ul>';
			$return.=do_shortcode($tabContent);
		$return.='</div>';
		return $return;
	}
	

}
// lets play
OT_Tabs::init();
?>