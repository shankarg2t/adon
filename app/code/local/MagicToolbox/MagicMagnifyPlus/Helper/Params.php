<?php

class MagicToolbox_MagicMagnifyPlus_Helper_Params extends Mage_Core_Helper_Abstract {

    public function __construct() {


    }

    public function getBlocks() {
		return array(
			'default' => 'General settings',
			'product' => 'Product page',
			'category' => 'Category page',
			'newproductsblock' => 'New Products block',
			'recentlyviewedproductsblock' => 'Recently Viewed Products block'
		);
	}

	public function getDefaultValues() {
		return array(
			'category' => array(
				'enable-effect' => 'No',
				'thumb-max-width' => '135',
				'thumb-max-height' => '135',
				'show-message' => 'No',
			),
			'newproductsblock' => array(
				'enable-effect' => 'No',
				'thumb-max-width' => '135',
				'thumb-max-height' => '135',
				'show-message' => 'No',
			),
			'recentlyviewedproductsblock' => array(
				'enable-effect' => 'No',
				'thumb-max-width' => '76',
				'thumb-max-height' => '76',
				'show-message' => 'No',
			)
		);
	}

	public function getParamsMap($block) {
		$blocks = array(
			'default' => array(
				'Miscellaneous' => array(
					'include-headers-on-all-pages'
				),
			),
			'product' => array(
				'General' => array(
					'enable-effect',
					'template',
					'magicscroll'
				),
				'Positioning and Geometry' => array(
					'thumb-max-width',
					'thumb-max-height',
					'square-images',
					'image-size',
					'expand-position',
					'expand-align'
				),
				'Effects' => array(
					'expand-effect',
					'restore-effect',
					'expand-speed',
					'restore-speed',
					'restore-trigger'
				),
				'Multiple images' => array(
					'selector-max-width',
					'selector-max-height',
					'use-individual-titles',
					'selectors-margin',
					'thumb-change',
					'thumb-change-delay'
				),
				'Title and Caption' => array(
					'show-caption',
					'caption-source',
					'caption-width',
					'caption-height',
					'caption-position',
					'caption-speed'
				),
				'Miscellaneous' => array(
					'option-associated-with-images',
					'show-associated-product-images',
					'load-associated-product-images',
					'ignore-magento-css',
					'show-message',
					'message',
					'disable-expand'
				),
				'Background' => array(
					'background-opacity',
					'background-color',
					'background-speed'
				),
				'Buttons' => array(
					'buttons',
					'buttons-display',
					'buttons-position'
				),
				'Expand mode' => array(
					'slideshow-effect',
					'slideshow-loop',
					'slideshow-speed',
					'z-index',
					'keyboard',
					'keyboard-ctrl'
				),
				'Magnifier' => array(
					'magnifier',
					'magnifier-size',
					'magnifier-size-x',
					'magnifier-size-y',
					'magnifier-effect',
					'magnifier-filter',
					'magnifier-time',
					'magnifier-border-color',
					'magnifier-border-width',
					'border-color',
					'border-width',
					'progress-color',
					'progress-height',
					'lense-position',
					'lense-offset-x',
					'lense-offset-y',
					'lense-url',
					'disable-auto-start',
					'thumb-change-time',
					'change-time',
					'hide-cursor',
					'magnifier-simulate',
					'blur',
					'transparency',
					'wheel-effect'
				),
				'Scroll' => array(
					'scroll-style',
					'loop',
					'speed',
					'width',
					'height',
					'item-width',
					'item-height',
					'step',
					'items'
				),
				'Scroll Arrows' => array(
					'arrows',
					'arrows-opacity',
					'arrows-hover-opacity'
				),
				'Scroll Slider' => array(
					'slider-size',
					'slider'
				),
				'Scroll effect' => array(
					'duration'
				)
			),
			'category' => array(
				'General' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'thumb-max-width',
					'thumb-max-height',
					'square-images',
					'image-size',
					'expand-position',
					'expand-align'
				),
				'Effects' => array(
					'expand-effect',
					'restore-effect',
					'expand-speed',
					'restore-speed',
					'restore-trigger'
				),
				'Multiple images' => array(
					'selector-max-width',
					'selector-max-height',
					'show-selectors-on-category-page',
					'selectors-margin',
					'thumb-change',
					'thumb-change-delay'
				),
				'Title and Caption' => array(
					'show-caption',
					'caption-source',
					'caption-width',
					'caption-height',
					'caption-position',
					'caption-speed'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'disable-expand'
				),
				'Background' => array(
					'background-opacity',
					'background-color',
					'background-speed'
				),
				'Buttons' => array(
					'buttons',
					'buttons-display',
					'buttons-position'
				),
				'Expand mode' => array(
					'slideshow-effect',
					'slideshow-loop',
					'slideshow-speed',
					'z-index',
					'keyboard',
					'keyboard-ctrl'
				),
				'Magnifier' => array(
					'magnifier',
					'magnifier-size',
					'magnifier-size-x',
					'magnifier-size-y',
					'magnifier-effect',
					'magnifier-filter',
					'magnifier-time',
					'magnifier-border-color',
					'magnifier-border-width',
					'border-color',
					'border-width',
					'progress-color',
					'progress-height',
					'lense-position',
					'lense-offset-x',
					'lense-offset-y',
					'lense-url',
					'disable-auto-start',
					'thumb-change-time',
					'change-time',
					'hide-cursor',
					'magnifier-simulate',
					'blur',
					'transparency',
					'wheel-effect'
				)
			),
			'newproductsblock' => array(
				'General' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'thumb-max-width',
					'thumb-max-height',
					'square-images',
					'image-size',
					'expand-position',
					'expand-align'
				),
				'Effects' => array(
					'expand-effect',
					'restore-effect',
					'expand-speed',
					'restore-speed',
					'restore-trigger'
				),
				'Title and Caption' => array(
					'show-caption',
					'caption-source',
					'caption-width',
					'caption-height',
					'caption-position',
					'caption-speed'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'disable-expand'
				),
				'Background' => array(
					'background-opacity',
					'background-color',
					'background-speed'
				),
				'Buttons' => array(
					'buttons',
					'buttons-display',
					'buttons-position'
				),
				'Expand mode' => array(
					'slideshow-effect',
					'slideshow-loop',
					'slideshow-speed',
					'z-index',
					'keyboard',
					'keyboard-ctrl'
				),
				'Magnifier' => array(
					'magnifier',
					'magnifier-size',
					'magnifier-size-x',
					'magnifier-size-y',
					'magnifier-effect',
					'magnifier-filter',
					'magnifier-time',
					'magnifier-border-color',
					'magnifier-border-width',
					'border-color',
					'border-width',
					'progress-color',
					'progress-height',
					'lense-position',
					'lense-offset-x',
					'lense-offset-y',
					'lense-url',
					'disable-auto-start',
					'thumb-change-time',
					'change-time',
					'hide-cursor',
					'magnifier-simulate',
					'blur',
					'transparency',
					'wheel-effect'
				)
			),
			'recentlyviewedproductsblock' => array(
				'General' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'thumb-max-width',
					'thumb-max-height',
					'square-images',
					'image-size',
					'expand-position',
					'expand-align'
				),
				'Effects' => array(
					'expand-effect',
					'restore-effect',
					'expand-speed',
					'restore-speed',
					'restore-trigger'
				),
				'Title and Caption' => array(
					'show-caption',
					'caption-source',
					'caption-width',
					'caption-height',
					'caption-position',
					'caption-speed'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'disable-expand'
				),
				'Background' => array(
					'background-opacity',
					'background-color',
					'background-speed'
				),
				'Buttons' => array(
					'buttons',
					'buttons-display',
					'buttons-position'
				),
				'Expand mode' => array(
					'slideshow-effect',
					'slideshow-loop',
					'slideshow-speed',
					'z-index',
					'keyboard',
					'keyboard-ctrl'
				),
				'Magnifier' => array(
					'magnifier',
					'magnifier-size',
					'magnifier-size-x',
					'magnifier-size-y',
					'magnifier-effect',
					'magnifier-filter',
					'magnifier-time',
					'magnifier-border-color',
					'magnifier-border-width',
					'border-color',
					'border-width',
					'progress-color',
					'progress-height',
					'lense-position',
					'lense-offset-x',
					'lense-offset-y',
					'lense-url',
					'disable-auto-start',
					'thumb-change-time',
					'change-time',
					'hide-cursor',
					'magnifier-simulate',
					'blur',
					'transparency',
					'wheel-effect'
				)
			)
		);
		return $blocks[$block];
	}

}
