/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function(){
    // if firefox 3.5+, hide content till load (or 3 seconds) to prevent FOUT
    var d = document, e = d.documentElement, s = d.createElement('style');
    if (e.style.MozTransform === ''){ // gecko 1.9.1 inference
        s.textContent = '#slidesHome img{visibility:hidden}';
        var r = document.getElementsByTagName('script')[0];
        r.parentNode.insertBefore(s, r);
        function f(){
            s.parentNode && s.parentNode.removeChild(s);
        }
        addEventListener('load',f,false);
        setTimeout(f,2000); 
    }
})();

var $j = jQuery.noConflict();
$j(document).ready(function(){
    $j('#pantoneval').hide();
    $j('#slidesHome').cycle({
        fx: 'scrollHorz',
        timeout: 6000,
        delay: -2000 ,
        speed: 500,
        prev: '#prev',
        next: '#next',
        pager: '#navPager',
        pagerAnchorBuilder: pagerFactory
    });
    function pagerFactory(idx, slide) {
        var s = idx > 2 ? ' style="display:none"' : '';
        return '<li'+s+'><a href="#">'+(idx+1)+'</a></li>';
    }
   
    /* Animate Product Items in Listview (show cart button and compare link on hover */
    $j(function() {
        $j('.products-grid li.item').hover( function(){
            $j(this).addClass('itemHover');
            $j(this).children(".actions").show();
        },
        function(){
            $j(this).removeClass('itemHover');
            $j(this).children(".actions").hide();
        });
    });
    $j('#easyCustomOptionsTabs').easytabs({
        animate: false,
        defaultTab: "#tab0"
    });   
    /* custom option radio button delete function */
    $j('.product-custom-option:radio').live('click', function(e) { 
        $j(this).parent().parent().parent().find('.disable-product-custom-option').remove();
        $j(this).parent().append('<span class="disable-product-custom-option">x</span>');
    });
    $j('.disable-product-custom-option').live('click', function(e) { 
        $j(this).parent().find('input:radio').prop('checked', false);
        opConfig.reloadPrice();
        $j(this).remove();
    });
    /* custom option show pantone value text field if Pantone color option super-attribute is selected */
    $j('#attribute143').change(function() { 
        if ($j("#attribute92 option:selected").text().indexOf("Pantone") >= 0) {
            
            $j('.product-options .swatchesContainer').css('margin-bottom','85px');
            $j('#pantoneval').show();
        }
        else {
            $j('#pantoneval').hide();
            $j('.product-options .swatchesContainer').css('margin-bottom','0');
        }
    }); 
    $j('.swatchContainer div').bind('click', function(e) { 
        $j('.product-options .swatchesContainer').css('margin-bottom','0');
        $j(this).parent().parent().parent().parent().parent().parent().parent().find('#pantoneval').hide();
    });
});