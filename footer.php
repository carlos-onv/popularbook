<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
	<div class="container">
	<?php 
	if(is_singular('post')){
		echo '<div style="text-align: center" class="vc_custom_heading best-selling-heading"><div>';_e('BESTSELLING PRODUCTS', 'book-junky');echo'</div></div>';
		echo do_shortcode('[vc_row full_width="stretch_row" row_visible="" row_border="" css=".vc_custom_1572897506024{background-color: #f9fafc !important;}" el_id="best-sell"][vc_column][products columns="6" orderby="title" order="ASC" ids="1682, 1467, 2978, 14092, 20184, 20162"][/vc_column][/vc_row]');
	}
	?>
	</div>
    </div><!-- .site-content -->

    <?php 
    if( is_front_page() || is_singular( 'post' ) ){
        ?>
        <style type="text/css">
            .mailchimp-form-wrapper{
                margin: 30px 0;
            }
            .mailchimp-form-wrapper input[type="email"]{
                padding-left: 12px !important;
            }
            .mailchimp-form-wrapper .select-field:before{
                content: '\f0d7';
                font-family: 'FontAwesome';
                font-size: 14px;
                color: #383b3f;
                top: 25%;
                z-index: 0;
                right: 4%;
                position: absolute;
                font-style: normal;
            }
            .mailchimp-form-wrapper .select-field select{
                -webkit-appearance: none;
                -moz-appearance: none;
                -ms-appearance: none;
                -o-appearance: none;
                appearance: none;
                width: 100%;
                max-width: 100%;
                min-width: 130px;
                padding: 0 10px;
                height: 36px;
                color: rgba(136, 138, 146, 0.48);
                font-size: 15px !important;
                font-family: "averta-bold";
                border: 1px solid #e5e6ea;
                border-radius: 5px;
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                color: #555;
                font-weight: normal;
            }
            .mailchimp-form-wrapper input[type="submit"]{
                font-family: "averta-regular";
                font-size: 15px;
                border-radius: 6px;
                background-color: #af0128;
                height: 36px;
                display: inline-block;
                padding: 0 38px !important;
                line-height: 32px;
                color: #fff;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25);
                border: 2px solid #af0128;
                transition: all 0.3s ease 0s;
            }
            .mailchimp-form-wrapper input[type="submit"]:hover{
                background-color: #fff;
                color: #af0128;
            }
        </style>
        <?php 
        echo '<div style="background-color: #f9fafc">';
            echo '<div class="container">';
                echo '<div class="row mailchimp-form-wrapper">';
                    //echo '<div class="col-xs-3 mailchimp-form-wrapper"></div>';
                    //echo '<div class="col-xs-6 mailchimp-form-wrapper">';
                        echo do_shortcode('[mc4wp_form id="973"]');
                    //echo '</div>';
                    //echo '<div class="col-xs-3 mailchimp-form-wrapper"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

    }
    ?>

    <footer class="site-footer">

        
		<div id="footer-middle">
            <div class="container">
                <div class="col-xs-12">
                    <?php
                        echo do_shortcode('[vc_row row_visible="" row_border="" el_id="footer-middle-header"][vc_column][vc_column_text]</p><p style="text-align: center;">Popular Book Company (Canada) Ltd.</p><p>[/vc_column_text][/vc_column][/vc_row][vc_row el_id="footer-icons"][vc_column width="1/2"][vc_column_text]<a href="tel:905-731-9827"><img class="alignnone size-full wp-image-94262" src="/wp-content/uploads/phone.svg" alt="phone" /><b>(905) 731-9827</b></a>[/vc_column_text][/vc_column][vc_column width="1/2"][vc_column_text]<a href="mailto:ca-info@popularworld.com"><img class="alignnone size-full wp-image-94262" src="/wp-content/uploads/mail.svg" alt="mail" /><b>ca-info@popularworld.com</b></a>[/vc_column_text][/vc_column][/vc_row]
            ');
                    ?>
                </div>
            </div>
        </div>
		<?php book_junky_footer_top(); ?>
        <div id="footer-bottom">
            <div class="container">
                <div class="row">
                <div class="col-xs-12">
					<div class="copyright">
						<?php _e('Copyright','book-junky'); ?> © <?php echo do_shortcode('[year]'); ?>
					</div> &nbsp;<?php book_junky_footer_bottom(); ?>
                </div>
                </div>
            </div>
        </div><!-- #footer-bottom -->

    </footer><!-- .site-footer -->

</div><!-- .site -->
</div><!-- .bj-container -->

<?php book_junky_end_boxed(); ?>
<?php book_junky_back_to_top(); ?>
<?php wp_footer(); ?>

<!-- AdLuge visitor tracking code starts here -->  
<!-- <script type="text/javascript">  
var _aaq = _aaq || [];  
_aaq.push(['trackPageView']);  
_aaq.push(['enableLinkTracking']);  
(function() {
  var u="//track.adluge.com/";
  _aaq.push(['setTrackerUrl', u+'t/']);
  _aaq.push(['setSiteId', 'AL_2158']);
  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'javascripts/tracker.js'; s.parentNode.insertBefore(g,s);  
})();  
</script>  
<noscript><p><img src="//track.adluge.com/noscript/?idsite=AL_2158" style="border:0;" alt="" /></p></noscript>  
-->
<!-- AdLuge visitor tracking code ends here -->

<?php if(is_page(88276)){ ?>
    <script type="text/javascript">
    jQuery(document).ready(function($){
        jQuery("form.register .button").attr('onclick','checkErr()');
        function getCookie(name) {
                    var value = "; " + document.cookie;
                    var parts = value.split("; " + name + "=");
                    if (parts.length == 2) return parts.pop().split(";").shift();
                }
        if(document.getElementsByClassName("woocommerce-error").length != 0){
            sessionStorage.removeItem('submitted_data');
            sessionStorage.removeItem('submitted_other_data');
        }
        var session_data=sessionStorage.getItem('submitted_data');
        var session_other_data=sessionStorage.getItem('submitted_other_data');
        if(session_data){
            var obj = JSON.parse(session_data);
                    var ad_fname=obj.fname;
                 var ad_lname=obj.lname;
                    var ad_email=obj.email;
                    var ad_other_field=obj.other_field;
                    if(ad_fname !="" && ad_email != "") {
                jQuery.ajax({
                    url: 'https://www.adluge.com/clientcenter/api/addlead-callback.php',
                    jsonp: "callback",
                    dataType: "jsonp",
                    data:{
                        fname          : ad_fname,
                        lname          : ad_lname,
                        client_code    : "flmztem1vx8b8z7",
                        email          : ad_email,
                        referer        : window.location.href,
                        lead_sessionid : getCookie("_adl_id.AL_2158"),
                        gclid          : getCookie("gclid"),
                        other_fields   : session_other_data
                        },
                        success: function (data){
                            sessionStorage.removeItem('submitted_data');
                            sessionStorage.removeItem('submitted_other_data');
                        },
                });
                }
            sessionStorage.removeItem('submitted_data');    
            sessionStorage.removeItem('submitted_other_data');
        }
        
    });
        function checkErr(){
            setTimeout(checkError, 500);
        }
        function checkError(){
            let error = document.getElementsByClassName("error-msg").length;
            if(error<1){
                jQuery("form.register .button").attr('disabled','disabled');
                // Affiliate Registration Form AdLuge Tracking Starts
                var fname       = jQuery('#profile_first_name').val();
                var lname       = jQuery('#profile_last_name').val();
                var email       = jQuery('#profile_email').val();
                var platform    = jQuery('#profile_platform_used').val();
                var why_promote    = jQuery('#profile_why_promote').val();
                var how_promote    = jQuery('#profile_how_promote').val();
                var otherfield  = {"Platform Used" : platform,"Why Promote Us" : why_promote,"How Promote Us" : how_promote};
                var other_field = JSON.stringify(otherfield);
                // var otherfield  = '{"Platform Used" : "'+platform+'","Why Promote Us" : "'+why_promote+'","How Promote Us" : "'+how_promote+'"}';
                var result='{"fname":"'+fname+'","lname":"'+lname+'", "email":"'+email+'"}';
                sessionStorage.setItem('submitted_data', result);
                sessionStorage.setItem('submitted_other_data', other_field);
                
                
                
            // AdLuge Tracking Ends
            }
        }   
    </script>
<?php } ?>
<?php if(is_page(4160)){ ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            function getCookie(name) {
                    var value = "; " + document.cookie;
                    var parts = value.split("; " + name + "=");
                    if (parts.length == 2) return parts.pop().split(";").shift();
                }
            var url = window.location.href;
			const string = url;
			const substring = "?created=success";
			var urlsub = string.includes(substring);
            var session_data=sessionStorage.getItem('submitted_data2');
            if(session_data && urlsub == true){
                var obj = JSON.parse(session_data);
                var ad_fname=obj.fname;
                var ad_email=obj.email;
                
                    if(ad_fname !="" && ad_email != "") {
                        jQuery.ajax({
                            url: 'https://www.adluge.com/clientcenter/api/addlead-callback.php',
                            jsonp: "callback",
                            dataType: "jsonp",
                            data:{
                                fname          : ad_fname,
                                client_code    : "flmztem1vx8b8z7",
                                email          : ad_email,
                                referer        : window.location.href,
                                lead_sessionid : getCookie("_adl_id.AL_2158"),
                                gclid          : getCookie("gclid")
                                },
                                success: function (data){
                                    sessionStorage.removeItem('submitted_data2');
                                },
                        });
                        sessionStorage.removeItem('submitted_data2');
                    }    
                }
            jQuery(".cleanlogin-form input[type='submit']").click(function(){
                var fname = jQuery(this).closest('form').find('.cleanlogin-field-username').val();
                var email = jQuery(this).closest('form').find('.cleanlogin-field-email').val();
                if(fname !="" && email != "") {
                    var result='{"fname":"'+fname+'", "email":"'+email+'"}';
                    sessionStorage.setItem('submitted_data2', result);
                }
            });
        });       
    </script>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        jQuery(".ur-submit-button").click(function(){
            var fname = jQuery(this).closest('form').find('#user_login').val();
            var email = jQuery(this).closest('form').find('#user_email').val();
            var no_children = jQuery(this).closest('form').find('#number_of_children').val();
            let grade_level = "";
            let i = 0;
            jQuery(this).closest('form').find("input[name='grade_level[]'][type='checkbox']:checked").each(function(i){
                i++;
                grade_level+=i+"."+($(this).val())+" ";
            });
            var otherfield  = {"Child Grade Level" : grade_level,"No Of Children" : no_children};
            var other_field = JSON.stringify(otherfield);    
            if(fname !="" && email != "" && grade_level != "") {
                var result='{"fname":"'+fname+'", "email":"'+email+'"}';
                sessionStorage.setItem('submitted_data1', result);
                sessionStorage.setItem('submitted_other_data1', other_field);
            }
        });
    });
   
</script>      
<script>
jQuery('.wg-ft-title').each(function(){
    jQuery(this).replaceWith(function () {
        return jQuery("<div>", {
            "class": this.className,
            html: jQuery(this).html()
        });
    });
});

</script>
<?php if( function_exists('is_product_category') &&  is_product_category(array('401','131'))){ ?>
<script>
jQuery('.vc_tta-panel-title').each(function(){
    jQuery(this).replaceWith(function () {
        return jQuery("<h3>", {
            "class": this.className,
            html: jQuery(this).html()
        });
    });
});
jQuery('.wrap-heading p').each(function(){
    jQuery(this).replaceWith(function () {
        return jQuery("<h2>", {
            "class": this.className,
			"style":'font-size: 15px;',
            html: jQuery(this).html()
        });
    });
});
</script>
<?php } ?>

 <script type="application/ld+json">
              { 
              "@context": "https://schema.org", 
              "@type": "BookStore", 
              "name": "Popular Book Company2",
               "description": "Unlock a world of knowledge at our WorkBook Store, your ultimate destination for student-focused books. ",
               "image": "https://www.popularbook.ca/wp-content/uploads/pbccanada.png",
               "logo": "https://www.popularbook.ca/wp-content/uploads/pbccanada.png", 
              "parentOrganization": { 
              "@type": "OnlineBusiness", 
              "name": "Popular Book Company",
               "url": "https://www.popularbook.ca/",
            "sameAs":["https://www.facebook.com/PopularBookCanada/","https://www.instagram.com/popularbookcanada/"]
            
               }, 
              "address": 
              { 
                    "telephone": "(905) 731-9827",
                       "email":"info@popularworld.com"
               },
              "areaserved":{
              "@type": "Place",
              "name": "Canada"
              },
        "hasMap": "https://www.google.com/maps/place/Popular+Book+Co+(Canada)+Ltd/@43.855298,-79.369366,15z/data=!4m6!3m5!1s0x882b2b4bced154cf:0xd8cfc6a58a8dd62e!8m2!3d43.8552982!4d-79.369366!16s%2Fg%2F1tgn5c4k?hl=en&entry=ttu",
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 43.855298,
            "longitude": -79.369366
        }
              }
            </script>

<?php if(!is_blog() && !is_page(5323)){ ?>

<script type="application/ld+json">
{
"@context": "https://schema.org/", 
"@type": "Product", 
"name": "Popular Book Company",
"image": "https://www.popularbook.ca/wp-content/uploads/pbccanada.png",
"description": "Popular Book Company (Canada) Ltd. is a leading Canadian educational publisher dedicated to developing high-quality curriculum-based learning materials for students from preschool to Grade 12. With a strong focus on the Canadian educational framework, Popular Book offers a wide range of books and resources designed to support classroom instruction and at-home learning.",
"brand": {
"@type": "Brand",
"name": "Popular Book Company"
},  
 "aggregateRating": {
            "@type": "AggregateRating",
           "ratingValue": "4.0",
   	"reviewCount": "34",
    	"ratingCount": "34"

},
"review": {
"@type": "Review",
"name": "Liliana Milcheva",
"reviewBody": "Very happy with my purchase of French textbooks. Arrived quickly, very good price, excellent quality. Thank you!",
"reviewRating": {
"@type": "Rating",
"ratingValue": "5"
},
"datePublished": "2021-06-1",
"author": {"@type": "Person", "name": "Liliana Milcheva"}
}
}
</script>


<?php } ?>






<script>
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    function eraseCookie(name) {   
        document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
    //eraseCookie("modalBox");
    if(!getCookie("modalBox"))
    {
        setCookie("modalBox","open",1);
    }
    var modalBoxgookie = getCookie("modalBox");
        
    var modalBox = '' +
        '<div class="cookie-banner" style="display:none;">' +
        '<div class="gift_popup_container">' +
        '<p class="big_text_center_popup" style="display: block;">Sign up for Parents Club and Get 50% off our Complete Canadian Curriculum series and 30% off other books!</p>' +
        '<a href="/parents-club#parent-club-registration" class="popup_button">Register Now</a>' +
        '<p class="disclaimer_popup_text">*Cannot be combined with other offers or discounts</p>' +
        '<button class="xclose">×</button>' +
        '</div>' +
        '</div>' +
        '<style> .cookie-banner { position: fixed;bottom: 0;left: 0;right: 0;width: 100%;padding: 5px 14px;justify-content: space-between;background-color: #0000007a;border-radius: 5px;box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);top: 0;z-index: 999999999; } .cookie-banner > div { margin-top: 20%;background-color: #fff;background-color: #ffffff;position: relative;width: 90%;max-width: 500px;margin-left: auto;margin-right: auto;padding: 20px; } .xclose { background-color: #000;border: none;color: white;cursor: pointer;right: -20px;float: right;position: absolute;top: -20px;font-size: 20px;z-index: 9999;border-radius: 50%;width: 40px;height: 40px; } </style>' +
        '';
	
    jQuery( document ).ready(function() {
        if(!bCheck())
        {
            if(modalBoxgookie!="close")
            {
                jQuery(document.body).append(modalBox);
                  setTimeout(function() {
                    jQuery(".cookie-banner").show();
                  },2000);
            }
        }
        jQuery( ".xclose" ).on( "click", function() {
            setCookie("modalBox","close",1);
            jQuery( ".cookie-banner" ).hide();
        });
    });
</script>


<script>
    
jQuery(document).ready(function($) {
  // Select all header tags (h1, h2, h3, h4, h5, h6)
  $('h1, h2, h3, h4, h5, h6').each(function() {
    // Find any <a> tag inside the header and remove the <a> tag, leaving the text content intact
    if(!$(this).hasClass('vc_tta-panel-title')){
    	$(this).find('a').each(function() {
      		$(this).replaceWith($(this).text()); // Replace the link with its text
    	});
	}
  });
});

</script>


<!-- Elfsight AI Chatbot | PopularBook.ca -->
<script src="https://elfsightcdn.com/platform.js" async></script>
<div class="elfsight-app-6a1c675e-720c-4345-94f2-b49b809f7217" data-elfsight-app-lazy></div>




</body>
</html>