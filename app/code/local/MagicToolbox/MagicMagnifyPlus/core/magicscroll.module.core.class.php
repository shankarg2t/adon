<?php

if(!defined('MagicScrollModuleCoreClassLoaded')) {

    define('MagicScrollModuleCoreClassLoaded', true);

    require_once(dirname(__FILE__) . '/magictoolbox.params.class.php');

    /**
     * MagicScrollModuleCoreClass
     *
     * @see   ____class_see____
     * @since 1.0.0
     */
    class MagicScrollModuleCoreClass {

        /**
         * MagicToolboxParamsClass class
         *
         * @var   MagicToolboxParamsClass
         * @see   ____var_see____
         * @since 1.0.0
         *
         */
        var $params;

        /**
         * Tool type
         *
         * @var   string
         * @see   ____var_see____
         * @since 1.0.0
         *
         */
        var $type = 'category';

        /**
         * Constructor
         *
         * @return void
         * @see    ____func_see____
         * @since  1.0.0
         */
        function MagicScrollModuleCoreClass() {
            $this->params = new MagicToolboxParamsClass();
            $this->loadDefaults();
            $this->params->setMapping(array(
                'width' => array('0' => 'auto'),
                'height' => array('0' => 'auto'),
                'item-width' => array('0' => 'auto'),
                'item-height' => array('0' => 'auto'),
                //NOTE: what is it for?
            ));
        }

        /**
         * Metod to get headers string
         *
         * @param string $jsPath  Path to JS file
         * @param string $cssPath Path to CSS file
         *
         * @return string
         * @see    ____func_see____
         * @since  1.0.0
         */
        function getHeadersTemplate($jsPath = '', $cssPath = null) {
            //to prevent multiple displaying of headers
            if(!defined('MagicScrollModuleHeaders')) {
                define('MagicScrollModuleHeaders', true);
            } else {
                return '';
            }
            if($cssPath == null) $cssPath = $jsPath;
            $headers = array();
            // add module version
            $headers[] = '<!-- Magic Magnify Plus Magento module version v4.6.3 [v1.2.24:v2.3.3] -->';
            // add style link
            $headers[] = '<link type="text/css" href="' . $cssPath . '/magicscroll.css" rel="stylesheet" media="screen" />';
            // add script link
            $headers[] = '<script type="text/javascript" src="' . $jsPath . '/magicscroll.js"></script>';
            // add options
            $headers[] = $this->getOptionsTemplate();
            return "\r\n" . implode("\r\n", $headers) . "\r\n";
        }

        /**
         * Metod to get options string
         *
         * @param mixed $id Extra options ID
         *
         * @return string
         * @see    ____func_see____
         * @since  1.0.0
         */
        function getOptionsTemplate($id = null) {
            $addition = '';
            if($this->params->paramExists('item-tag')) {
                $addition .= "\n\t\t'item-tag':'" . $this->params->getValue('item-tag') . "',";
            }
            //NOTICE: scope == 'MagicScroll'
            return "<script type=\"text/javascript\">\n\tMagicScroll.".($id == null?"options":"extraOptions.".$id)." = {{$addition}\n\t\t".$this->params->serialize(true, ",\n\t\t")."\n\t}\n</script>";
        }

        /**
         * Metod to get MagicScroll HTML
         *
         * @param array $itemsData MagicScroll data
         * @param array $params Additional params
         *
         * @return string
         * @see    ____func_see____
         * @since  1.0.0
         */
        function getMainTemplate($itemsData, $params = array()) {

            $id = '';
            $width = '';
            $height = '';

            $html = array();

            extract($params);

            if(empty($width)) $width = ''; else $width = " width=\"{$width}\"";
            if(empty($height)) $height = ''; else $height = " height=\"{$height}\"";

            if(empty($id)) {
                $id = '';
            } else {
                // add personal options
                //NOTICE: what is it for?
                $html[] = $this->getOptionsTemplate($id);
                $id = ' id="' . addslashes($id) . '"';
            }

            // add div with tool className
            $additionalClasses = array(
                'default' => '',
                'with-borders' => 'msborder'
            );
            $additionalClass = $additionalClasses[$this->params->getValue('scroll-style')];
            if(!empty($additionalClass)) $additionalClass = ' ' . $additionalClass;
            $html[] = '<div' . $id . ' class="MagicScroll' . $additionalClass . '"' . $width . $height . '>';

            // add items
            foreach($itemsData as $item) {

                $img = '';
                $thumb = '';
                $link = '';
                $target = '';
                $alt = '';
                $title = '';
                $description = '';
                $width = '';
                $height = '';

                extract($item);

                // check big image
                if(empty($img)) $img = '';

                //NOTE: remove this?
                if(isset($medium)) $thumb = $medium;

                // check thumbnail
                if(!empty($img) || empty($thumb)) {
                    $thumb = $img;
                }

                // check item link
                if(empty($link)) {
                    $link = '';
                } else {
                    // check target
                    if(empty($target)) {
                        $target = '';
                    } else {
                        $target = ' target="' . $target . '"';
                    }
                    $link = $target . ' href="' . addslashes($link) . '"';
                }

                // check item alt tag
                if(empty($alt)) {
                    $alt = '';
                } else {
                    $alt = htmlspecialchars(htmlspecialchars_decode($alt, ENT_QUOTES));
                }

                // check title
                if(empty($title)) {
                    $title = '';
                } else {
                    $title = htmlspecialchars(htmlspecialchars_decode($title, ENT_QUOTES));
                    if(empty($alt)) {
                        $alt = $title;
                    }
                }

                // check description
                if(empty($description)) {
                    $description = '';
                } else {
                    //$description = preg_replace("/<(\/?)a([^>]*)>/is", "[$1a$2]", $description);
                    $description = "<span>{$description}</span>";
                }

                if(empty($width)) $width = ''; else $width = " width=\"{$width}\"";
                if(empty($height)) $height = ''; else $height = " height=\"{$height}\"";

                // add item
                $html[] = "<a{$link}><img{$width}{$height} src=\"{$thumb}\" alt=\"{$alt}\" />{$title}{$description}</a>";
            }

            // close core div
            $html[] = '</div>';

            // create HTML string
            $html = implode('', $html);

            // return result
            return $html;
        }

        /**
         * Metod to load defaults options
         *
         * @return void
         * @see    ____func_see____
         * @since  1.0.0
         */
        function loadDefaults() {
            $params = array("enable-effect"=>array("id"=>"enable-effect","group"=>"General","order"=>"10","default"=>"Yes","label"=>"Enable Magic Magnify Plus™","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"template"=>array("id"=>"template","group"=>"General","order"=>"20","default"=>"original","label"=>"Thumbnail layout","type"=>"array","subType"=>"select","values"=>array("original","bottom","left","right","top"),"scope"=>"profile"),"magicscroll"=>array("id"=>"magicscroll","group"=>"General","order"=>"22","default"=>"No","label"=>"Scroll thumbnails","description"=>"<br/>Powered by the versatile <a target=\"_blank\" href=\"http://www.magictoolbox.com/magicscroll/examples/\">Magic Scroll</a>™. Normally £29, yours is discounted to only £19. <a target=\"_blank\" href=\"http://www.magictoolbox.com/magicmagnifyplus/magicscroll/\">Buy a license</a> and upload magicscroll.js to your server. <a target=\"_blank\" href=\"http://www.magictoolbox.com/contact/\">Contact us</a> for help.","type"=>"array","subType"=>"select","values"=>array("Yes","No"),"scope"=>"profile"),"thumb-max-width"=>array("id"=>"thumb-max-width","group"=>"Positioning and Geometry","order"=>"10","default"=>"250","label"=>"Maximum width of thumbnail (in pixels)","type"=>"num"),"thumb-max-height"=>array("id"=>"thumb-max-height","group"=>"Positioning and Geometry","order"=>"11","default"=>"250","label"=>"Maximum height of thumbnail (in pixels)","type"=>"num"),"square-images"=>array("id"=>"square-images","group"=>"Positioning and Geometry","order"=>"40","default"=>"No","label"=>"Always create square images","description"=>"","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"image-size"=>array("id"=>"image-size","group"=>"Positioning and Geometry","order"=>"210","default"=>"fit-screen","label"=>"Size of the enlarged image","type"=>"array","subType"=>"select","values"=>array("original","fit-screen"),"scope"=>"tool"),"expand-position"=>array("id"=>"expand-position","group"=>"Positioning and Geometry","order"=>"220","default"=>"center","label"=>"Precise position of enlarged image (px)","type"=>"text","description"=>"The value can be 'center' or coordinates. E.g. 'top:0, left:0' or 'bottom:100, left:100'","scope"=>"tool"),"expand-align"=>array("id"=>"expand-align","group"=>"Positioning and Geometry","order"=>"230","default"=>"screen","label"=>"Align expanded image relative to screen or thumbnail","type"=>"array","subType"=>"select","values"=>array("screen","image"),"scope"=>"tool"),"expand-effect"=>array("id"=>"expand-effect","group"=>"Effects","order"=>"10","default"=>"linear","label"=>"Effect while expanding image","type"=>"array","subType"=>"select","values"=>array("linear","cubic","back","elastic","bounce"),"scope"=>"tool"),"restore-effect"=>array("id"=>"restore-effect","group"=>"Effects","order"=>"20","default"=>"linear","label"=>"Effect while restoring image","type"=>"array","subType"=>"select","values"=>array("linear","cubic","back","elastic","bounce"),"scope"=>"tool"),"expand-speed"=>array("id"=>"expand-speed","group"=>"Effects","order"=>"30","default"=>"500","label"=>"Expand duration (milliseconds: 0-10000)","type"=>"num","scope"=>"tool"),"restore-speed"=>array("id"=>"restore-speed","group"=>"Effects","order"=>"40","default"=>"-1","label"=>"Restore duration (milliseconds: 0-10000, -1: use expand duration value)","type"=>"num","scope"=>"tool"),"restore-trigger"=>array("id"=>"restore-trigger","group"=>"Effects","order"=>"70","default"=>"auto","label"=>"Trigger to restore image to its small state","type"=>"array","subType"=>"select","values"=>array("auto","click","mouseout"),"scope"=>"tool"),"selector-max-width"=>array("id"=>"selector-max-width","group"=>"Multiple images","order"=>"10","default"=>"56","label"=>"Maximum width of additional thumbnails (in pixels)","type"=>"num"),"selector-max-height"=>array("id"=>"selector-max-height","group"=>"Multiple images","order"=>"11","default"=>"56","label"=>"Maximum height of additional thumbnails (in pixels)","type"=>"num"),"show-selectors-on-category-page"=>array("id"=>"show-selectors-on-category-page","group"=>"Multiple images","order"=>"20","default"=>"No","label"=>"Show selectors on category page","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"use-individual-titles"=>array("id"=>"use-individual-titles","group"=>"Multiple images","order"=>"40","default"=>"Yes","label"=>"Use individual image titles for additional images?","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"selectors-margin"=>array("id"=>"selectors-margin","group"=>"Multiple images","order"=>"40","default"=>"5","label"=>"Margin between selectors and main image (in pixels)","type"=>"num"),"thumb-change"=>array("id"=>"thumb-change","group"=>"Multiple images","order"=>"210","default"=>"click","label"=>"Method to switch between multiple images","type"=>"array","subType"=>"select","values"=>array("click","mouseover"),"scope"=>"tool"),"thumb-change-delay"=>array("id"=>"thumb-change-delay","group"=>"Multiple images","order"=>"220","default"=>"200","label"=>"Delay before switching images (in milliseconds)","type"=>"num","scope"=>"tool"),"show-caption"=>array("id"=>"show-caption","group"=>"Title and Caption","order"=>"20","default"=>"Yes","label"=>"Show caption","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"caption-source"=>array("id"=>"caption-source","group"=>"Title and Caption","order"=>"30","default"=>"Title","label"=>"Caption source","type"=>"text","values"=>array("Title","Short description","Description","All")),"caption-width"=>array("id"=>"caption-width","group"=>"Title and Caption","order"=>"40","default"=>"300","label"=>"Max width of bottom caption (pixels: 0 or larger)","type"=>"num","scope"=>"tool"),"caption-height"=>array("id"=>"caption-height","group"=>"Title and Caption","order"=>"50","default"=>"300","label"=>"Max height of bottom caption (pixels: 0 or larger)","type"=>"num","scope"=>"tool"),"caption-position"=>array("id"=>"caption-position","group"=>"Title and Caption","order"=>"60","default"=>"bottom","label"=>"Where to position the caption","type"=>"array","subType"=>"select","values"=>array("bottom","right","left"),"scope"=>"tool"),"caption-speed"=>array("id"=>"caption-speed","group"=>"Title and Caption","order"=>"70","default"=>"250","label"=>"Speed of the caption slide effect (milliseconds: 0 or larger)","type"=>"num","scope"=>"tool"),"include-headers-on-all-pages"=>array("id"=>"include-headers-on-all-pages","group"=>"Miscellaneous","order"=>"21","default"=>"No","label"=>"Include headers on all pages","description"=>"To be able to apply an effect on any page","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"link-to-product-page"=>array("id"=>"link-to-product-page","group"=>"Miscellaneous","order"=>"30","default"=>"Yes","label"=>"Link enlarged image to the product page","type"=>"array","subType"=>"select","values"=>array("Yes","No")),"option-associated-with-images"=>array("id"=>"option-associated-with-images","group"=>"Miscellaneous","order"=>"40","default"=>"color","label"=>"Options names associated with images separated by commas (e.g 'Color,Size')","description"=>"You should named all product images associated with option values. e.g If option values is 'red', 'blue' and 'white' then you should have 3 images with labels 'red', 'blue' and 'white'","type"=>"text"),"show-associated-product-images"=>array("id"=>"show-associated-product-images","group"=>"Miscellaneous","order"=>"41","default"=>"No","label"=>"Show associated product's images","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"load-associated-product-images"=>array("id"=>"load-associated-product-images","group"=>"Miscellaneous","order"=>"42","default"=>"when option is selected","label"=>"Load associated product's images","type"=>"array","subType"=>"radio","values"=>array("when option is selected","within a gallery")),"ignore-magento-css"=>array("id"=>"ignore-magento-css","group"=>"Miscellaneous","order"=>"50","default"=>"No","label"=>"Ignore magento CSS width/height styles for additional images","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"show-message"=>array("id"=>"show-message","group"=>"Miscellaneous","order"=>"170","default"=>"Yes","label"=>"Show message under image?","type"=>"array","subType"=>"radio","values"=>array("Yes","No")),"message"=>array("id"=>"message","group"=>"Miscellaneous","order"=>"180","default"=>"Move your mouse over image or click to enlarge","label"=>"Message under images","type"=>"text"),"disable-expand"=>array("id"=>"disable-expand","group"=>"Miscellaneous","order"=>"190","default"=>"No","label"=>"Disable expand effect","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"background-opacity"=>array("id"=>"background-opacity","group"=>"Background","order"=>"10","default"=>"0","label"=>"Opacity of the background effect (0-100)","type"=>"num","scope"=>"tool"),"background-color"=>array("id"=>"background-color","group"=>"Background","order"=>"20","default"=>"#000000","label"=>"Fade background color (RGB)","type"=>"text","scope"=>"tool"),"background-speed"=>array("id"=>"background-speed","group"=>"Background","order"=>"30","default"=>"200","label"=>"Speed of the fade effect (milliseconds: 0 or larger)","type"=>"num","scope"=>"tool"),"buttons"=>array("id"=>"buttons","group"=>"Buttons","order"=>"10","default"=>"show","label"=>"Whether to show navigation buttons","type"=>"array","subType"=>"select","values"=>array("show","hide","autohide"),"scope"=>"tool"),"buttons-display"=>array("id"=>"buttons-display","group"=>"Buttons","order"=>"20","default"=>"previous, next, close","label"=>"Display button","type"=>"text","description"=>"Show all three buttons or just one or two. E.g. 'previous, next' or 'close, next'","scope"=>"tool"),"buttons-position"=>array("id"=>"buttons-position","group"=>"Buttons","order"=>"30","default"=>"auto","label"=>"Location of navigation buttons","type"=>"array","subType"=>"select","values"=>array("auto","top left","top right","bottom left","bottom right"),"scope"=>"tool"),"slideshow-effect"=>array("id"=>"slideshow-effect","group"=>"Expand mode","order"=>"10","default"=>"dissolve","label"=>"Visual effect for switching images","type"=>"array","subType"=>"select","values"=>array("dissolve","fade","expand"),"scope"=>"tool"),"slideshow-loop"=>array("id"=>"slideshow-loop","group"=>"Expand mode","order"=>"20","default"=>"Yes","label"=>"Restart slideshow after last image","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"slideshow-speed"=>array("id"=>"slideshow-speed","group"=>"Expand mode","order"=>"30","default"=>"800","label"=>"Speed of slideshow effect (milliseconds: 0 or larger)","type"=>"num","scope"=>"tool"),"z-index"=>array("id"=>"z-index","group"=>"Expand mode","order"=>"40","default"=>"10001","label"=>"The z-index for the enlarged image","type"=>"num","scope"=>"tool"),"keyboard"=>array("id"=>"keyboard","group"=>"Expand mode","order"=>"50","default"=>"Yes","label"=>"Ability to use keyboard shortcuts","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"keyboard-ctrl"=>array("id"=>"keyboard-ctrl","group"=>"Expand mode","order"=>"60","default"=>"No","label"=>"Require Ctrl key to permit shortcuts","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"magnifier"=>array("id"=>"magnifier","group"=>"Magnifier","order"=>"10","default"=>"circle","label"=>"Magnifier shape","type"=>"text","values"=>array("circle","square","inner","custom(x1,y1,x2,y2,...)"),"scope"=>"tool"),"magnifier-size"=>array("id"=>"magnifier-size","group"=>"Magnifier","order"=>"20","default"=>"66%","label"=>"Magnifier size: % of small image width or fixed size in px","type"=>"text","scope"=>"tool"),"magnifier-size-x"=>array("id"=>"magnifier-size-x","group"=>"Magnifier","order"=>"30","default"=>"","label"=>"Magnifier width: % of small image width or fixed size in px","type"=>"text","scope"=>"tool"),"magnifier-size-y"=>array("id"=>"magnifier-size-y","group"=>"Magnifier","order"=>"40","default"=>"","label"=>"Magnifier height: % of small image width or fixed size in px","type"=>"text","scope"=>"tool"),"magnifier-effect"=>array("id"=>"magnifier-effect","group"=>"Magnifier","order"=>"50","default"=>"fade","label"=>"Magnifier appearing effect","type"=>"array","subType"=>"select","values"=>array("none","pulse","fade"),"scope"=>"tool"),"magnifier-filter"=>array("id"=>"magnifier-filter","group"=>"Magnifier","order"=>"60","default"=>"glow","label"=>"Magnifier effect","type"=>"array","subType"=>"select","values"=>array("glow","shadow"),"scope"=>"tool"),"magnifier-time"=>array("id"=>"magnifier-time","group"=>"Magnifier","order"=>"70","default"=>"30","label"=>"Time for magnifier effect (in milliseconds)","type"=>"num","scope"=>"tool"),"magnifier-border-color"=>array("id"=>"magnifier-border-color","group"=>"Magnifier","order"=>"80","default"=>"#CCCCCC","label"=>"Magnifier border color (RGB)","type"=>"text","scope"=>"tool"),"magnifier-border-width"=>array("id"=>"magnifier-border-width","group"=>"Magnifier","order"=>"90","default"=>"1","label"=>"Magnifier border thickness (in pixels)","type"=>"num","scope"=>"tool"),"border-color"=>array("id"=>"border-color","group"=>"Magnifier","order"=>"100","default"=>"#CCCCCC","label"=>"Outside border color (RGB)","type"=>"text","scope"=>"tool"),"border-width"=>array("id"=>"border-width","group"=>"Magnifier","order"=>"110","default"=>"0","label"=>"Outside border width (in pixels)","type"=>"num","scope"=>"tool"),"progress-color"=>array("id"=>"progress-color","group"=>"Magnifier","order"=>"120","default"=>"#CCCCCC","label"=>"Color of the loading bar (RGB)","type"=>"text","scope"=>"tool"),"progress-height"=>array("id"=>"progress-height","group"=>"Magnifier","order"=>"130","default"=>"0","label"=>"Height of the loading bar (in pixels)","type"=>"num","scope"=>"tool"),"lense-position"=>array("id"=>"lense-position","group"=>"Magnifier","order"=>"140","default"=>"top","label"=>"Custom image position","type"=>"array","subType"=>"select","values"=>array("top","bottom"),"description"=>"top - above magnifier, bottom - under magnifier","scope"=>"tool"),"lense-offset-x"=>array("id"=>"lense-offset-x","group"=>"Magnifier","order"=>"150","default"=>"0","label"=>"Custom image x-offset (in pixels)","type"=>"num","scope"=>"tool"),"lense-offset-y"=>array("id"=>"lense-offset-y","group"=>"Magnifier","order"=>"160","default"=>"0","label"=>"Custom image y-offset (in pixels)","type"=>"num","scope"=>"tool"),"lense-url"=>array("id"=>"lense-url","group"=>"Magnifier","order"=>"170","default"=>"","label"=>"Relative/Absolute url of the custom image","description"=>"Leave empty to disable this option","type"=>"text","scope"=>"tool"),"disable-auto-start"=>array("id"=>"disable-auto-start","group"=>"Magnifier","order"=>"190","default"=>"No","label"=>"Disable magnify effect until clicked","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"thumb-change-time"=>array("id"=>"thumb-change-time","group"=>"Magnifier","order"=>"220","default"=>"500","label"=>"Speed of changing size of multiple images (in milliseconds)","type"=>"num","scope"=>"tool"),"change-time"=>array("id"=>"change-time","group"=>"Magnifier","order"=>"230","default"=>"500","label"=>"Speed of changing opacity of multiple images (in milliseconds)","type"=>"num","scope"=>"tool"),"hide-cursor"=>array("id"=>"hide-cursor","group"=>"Magnifier","order"=>"260","default"=>"No","label"=>"Hide mouse pointer","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"tool"),"magnifier-simulate"=>array("id"=>"magnifier-simulate","group"=>"Magnifier","order"=>"270","default"=>"","label"=>"Create enlarged images from small ones with specified scale (in %)","description"=>"Leave empty to disable this option","type"=>"text","scope"=>"tool"),"blur"=>array("id"=>"blur","group"=>"Magnifier","order"=>"280","default"=>"0","label"=>"Blur effect of the main image when magnifier is shown (in pixels)","type"=>"num","scope"=>"tool"),"transparency"=>array("id"=>"transparency","group"=>"Magnifier","order"=>"290","default"=>"100%","label"=>"Transparency of the main image when magnifier is shown (0-100%)","type"=>"text","scope"=>"tool"),"wheel-effect"=>array("id"=>"wheel-effect","group"=>"Magnifier","order"=>"300","default"=>"20%","label"=>"Wheel effect for changing magnifier size (0-100%)","type"=>"text","scope"=>"tool"),"scroll-style"=>array("id"=>"scroll-style","group"=>"Scroll","order"=>"5","default"=>"default","label"=>"Style","type"=>"array","subType"=>"select","values"=>array("default","with-borders"),"scope"=>"profile"),"loop"=>array("id"=>"loop","group"=>"Scroll","order"=>"10","default"=>"continue","label"=>"Restart scroll after last image","description"=>"Continue to next image or scroll all the way back","type"=>"array","subType"=>"radio","values"=>array("continue","restart"),"scope"=>"MagicScroll"),"speed"=>array("id"=>"speed","group"=>"Scroll","order"=>"20","default"=>"5000","label"=>"Scroll speed","description"=>"Change the scroll speed in miliseconds (0 = manual)","type"=>"num","scope"=>"MagicScroll"),"width"=>array("id"=>"width","group"=>"Scroll","order"=>"30","default"=>"0","label"=>"Scroll width (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"height"=>array("id"=>"height","group"=>"Scroll","order"=>"40","default"=>"0","label"=>"Scroll height (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"item-width"=>array("id"=>"item-width","group"=>"Scroll","order"=>"50","default"=>"0","label"=>"Scroll item width (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"item-height"=>array("id"=>"item-height","group"=>"Scroll","order"=>"60","default"=>"0","label"=>"Scroll item height (pixels)","description"=>"0 - auto","type"=>"num","scope"=>"MagicScroll"),"step"=>array("id"=>"step","group"=>"Scroll","order"=>"70","default"=>"3","label"=>"Scroll step","type"=>"num","scope"=>"MagicScroll"),"items"=>array("id"=>"items","group"=>"Scroll","order"=>"80","default"=>"3","label"=>"Items to show","description"=>"0 - manual","type"=>"num","scope"=>"MagicScroll"),"arrows"=>array("id"=>"arrows","group"=>"Scroll Arrows","order"=>"10","default"=>"outside","label"=>"Show arrows","label"=>"Where arrows should be placed","type"=>"array","subType"=>"radio","values"=>array("outside","inside","false"),"scope"=>"MagicScroll"),"arrows-opacity"=>array("id"=>"arrows-opacity","group"=>"Scroll Arrows","order"=>"20","default"=>"60","label"=>"Opacity of arrows (0-100)","type"=>"num","scope"=>"MagicScroll"),"arrows-hover-opacity"=>array("id"=>"arrows-hover-opacity","group"=>"Scroll Arrows","order"=>"30","default"=>"100","label"=>"Opacity of arrows on mouse over (0-100)","type"=>"num","scope"=>"MagicScroll"),"slider-size"=>array("id"=>"slider-size","group"=>"Scroll Slider","order"=>"10","default"=>"10%","label"=>"Slider size (numeric or percent)","type"=>"text","scope"=>"MagicScroll"),"slider"=>array("id"=>"slider","group"=>"Scroll Slider","order"=>"20","default"=>"false","label"=>"Slider postion","type"=>"array","subType"=>"select","values"=>array("top","right","bottom","left","false"),"scope"=>"MagicScroll"),"direction"=>array("id"=>"direction","group"=>"Scroll effect","order"=>"10","default"=>"right","value"=>"bottom","label"=>"Direction of scroll","type"=>"array","subType"=>"select","values"=>array("top","right","bottom","left"),"scope"=>"MagicScroll"),"duration"=>array("id"=>"duration","group"=>"Scroll effect","order"=>"20","default"=>"1000","label"=>"Duration of effect (miliseconds)","type"=>"num","scope"=>"MagicScroll"));
            $this->params->appendParams($params);
        }

    }

}

?>