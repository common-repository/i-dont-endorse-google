<?php 
/*
	Plugin Name: I don't endorse Google
	Plugin URI: https://andreapernici.com/wordpress/google-plus-comments/
	Description: Add rel="nofollow" to all links going to *.Google.*
	Version: 1.0.3
	Author: Andrea Pernici
	Author URI: https://www.andreapernici.com/
	
	Copyright 2013 Andrea Pernici (andreapernici@gmail.com)
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

	*/

define( 'NOFOLLOWGOOGLE_VERSION', '1.0.3' );

$pluginurl = plugin_dir_url(__FILE__);
if ( preg_match( '/^https/', $pluginurl ) && !preg_match( '/^https/', get_bloginfo('url') ) )
	$pluginurl = preg_replace( '/^https/', 'http', $pluginurl );
define( 'NOFOLLOWGOOGLE_FRONT_URL', $pluginurl );

define( 'NOFOLLOWGOOGLE_URL', plugin_dir_url(__FILE__) );
define( 'NOFOLLOWGOOGLE_PATH', plugin_dir_path(__FILE__) );
define( 'NOFOLLOWGOOGLE_BASENAME', plugin_basename( __FILE__ ) );

if (!class_exists("AndreaNofollowGoogle")) {

	class AndreaNofollowGoogle {
		/**
		 * Class Constructor
		 */
		function AndreaNofollowGoogle(){
		
		}
		
		/**
		 * Enabled the AndreaNofollowGoogle plugin with registering all required hooks
		 */
		function Enable() {

			add_filter("the_content", array("AndreaNofollowGoogle","AutoNofollow"));
			
		}
		
		function AutoNofollow($content) {	
			
			return preg_replace_callback("#(<a[^>]+?)>#is", create_function(
	            '$m',
	            'global $urls; 
	            $urls = array( 
	            		"google" => "\.google\.", 
	            		"googlenowww" => "//google\.", 
	            		"youtube" => "\.youtube\.com", 
	            		"youtubenowww" => "//youtube\.com", 
	            		"blogspot" => "\.blogspot\.com",
	            		"blogspotnowww" => "//blogspot\.com",
	            		"citizentube" => "\.citizentube\.com",
	            		"citizentubenowww" => "//citizentube\.com",
	            		"googlechinawebmaster" => "\.googlechinawebmaster\.com",
	            		"googlechinawebmasternowww" => "//googlechinawebmaster\.com",
	            		"googlechinablog" => "\.googlechinablog\.com",
	            		"googlechinablognowww" => "//googlechinablog\.com",
	            		"googleorg" => "\.google\.org",
	            		"googleorgnowww" => "//google\.org",
	            		"panoramio" => "\.panoramio\.com",
	            		"panoramionowww" => "//panoramio\.com",
	            		"orkut" => "\.orkut\.com", 
	            		"orkutnowww" => "//orkut\.com",
	            		"waze" => "\.waze\.com",
	            		"wazenowww" => "//waze\.com",
						"urchincom" => "\.urchin\.com",
						"urchincomnowww" => "//urchin\.com",
						"googlecommercecom" => "\.googlecommerce\.com",
						"googlecommercecomnowww" => "//googlecommerce\.com",
						"googleusercontentcom" => "\.googleusercontent\.com",
						"googleusercontentcomnowww" => "//googleusercontent\.com",
						"gmailcom" => "\.gmail\.com",
						"gmailcomnowww" => "//gmail\.com",
						"googlesyndicationcom" => "\.googlesyndication\.com",
						"googlesyndicationcomnowww" => "//googlesyndication\.com",
						"googleratingscom" => "\.googleratings\.com",
						"googleratingscomnowww" => "//googleratings\.com",
						"googl" => "\.goo\.gl",
						"googlnowww" => "//goo\.gl",
						"googleapiscom" => "\.googleapis\.com",
						"googleapiscomnowww" => "//googleapis\.com",
						"googleappscom" => "\.googleapps\.com",		
						"googleappscomnowww" => "//googleapps\.com",
						"gstaticcom" => "\.gstatic\.com",
						"gstaticcomnowww" => "//gstatic\.com",
						"gtempaccountcom" => "\.gtempaccount\.com",
						"gtempaccountcomnowww" => "//gtempaccount\.com",
						"ggphtcom" => "\.ggpht\.com",	
						"ggphtcomnowww" => "//ggpht\.com",			
						"gco" => "\.g\.co",
						"gconowww" => "//g\.co",
						"googlrcom" => "\.googlr\.com",
						"googlrcomnowww" => "//googlr\.com",
						"googilcom" => "\.googil\.com",	
						"googilcomnowww" => "//googil\.com",			
						"googelcom" => "\.googel\.com",
						"googelcomnowww" => "//googel\.com",
						"goolgecom" => "\.goolge\.com",
						"goolgecomnowww" => "//goolge\.com",
						"gogolecom" => "\.gogole\.com",
						"gogolecomnowww" => "//gogole\.com",		
						"goglecom" => "\.gogle\.com",
						"goglecomnowww" => "//gogle\.com",
						"goooglecom" => "\.gooogle\.com",
						"goooglecomnowww" => "//gooogle\.com",
						"googlebotcom" => "\.googlebot\.com",
						"googlebotcomnowww" => "//googlebot\.com",
						"1e100net" => "\.1e100\.net",
						"1e100netnowww" => "//1e100\.net",
						"likecom" => "\.like\.com",
						"likecomnowww" => "//like\.com",			
						"chromiumorg" => "\.chromium\.org",
						"chromiumorgnowww" => "//chromium\.org",			
						"bloggercom" => "\.blogger\.com",
						"bloggercomnowww" => "//blogger\.com",
						"keyholecom" => "\.keyhole\.com",
						"keyholecomnowww" => "//keyhole\.com",
						"youtubeeducationcom" => "\.youtubeeducation\.com",
						"youtubeeducationcomnowww" => "//youtubeeducation\.com",
						"youtu-be" => "\.youtu\.be",
						"youtu-benowww" => "//youtu\.be",
						"frooglecom" => "\.froogle\.com",
						"frooglecomnowww" => "//froogle\.com",
						"igoogle" => "\.igoogle\.com",
						"igooglenowww" => "//igoogle\.com",
						"doubleclickcom" => "\.doubleclick\.com",
						"doubleclickcomnowww" => "//doubleclick\.com",
						"feedburnercom" => "\.feedburner\.com",
						"feedburnercomnowww" => "//feedburner\.com",
						"picasa" => "\.picasa\.com",
						"picasanowww" => "//picasa\.com",
						"androidcom" => "\.android\.com",
						"androidcomnowww" => "//android\.com",
						"adsensecom" => "\.adsense\.com",
						"adsensecomnowww" => "//adsense\.com",
						"googleanalyticscom" => "\.google-analytics.com",
						"googleanalyticscomnowww" => "//google-analytics.com",
						"adwordscom" => "\.adwords\.com",
						"adwordscomnowww" => "//adwords\.com"
				); 
				$flag = false; $flagdue = false;  
	             	foreach($urls as $url){
		                if(preg_match("#".$url."#i", $m[1])){ 
		                   $flag = true; 
		                }
		            }
	             if (($flag)) $m[1] .= " rel=\"nofollow\"";
	             return $m[1].">";
	            '
	          ), $content);
		}
		
			
		function DefineArray(){
			$arraygoogleprop = array( 
				"google" => "\.google\.",
				"youtube" => "\.youtube\.com",
				"googleadsdeveloper" => "googleadsdeveloper\.blogspot\.com",
				"adsense-de" => "adsense-de\.blogspot\.com",
				"adsense-es" => "adsense-es\.blogspot\.com",
				"adsense-fr" => "adsense-fr\.blogspot\.com",
				"it-adsense" => "it-adsense\.blogspot\.com",
				"adsense-nl" => "adsense-nl\.blogspot\.com",
				"adsense-pl" => "adsense-pl\.blogspot\.com",
				"adsense-pt" => "adsense-pt\.blogspot\.com",
				"zht-adsense" => "zht-adsense\.blogspot\.com",
				"adsense-tr" => "adsense-tr\.blogspot\.com",
				"adsense-ru" => "adsense-ru\.blogspot\.com",
				"adsense-ko" => "adsense-ko\.blogspot\.com",
				"adsense-ja" => "adsense-ja\.blogspot\.com",
				"adsense-arabia" => "adsense-arabia\.blogspot\.com",
				"adwords-br" => "adwords-br\.blogspot\.com",
				"adwords-bg" => "adwords-bg\.blogspot\.com",
				"adwords-hr" => "adwords-hr\.blogspot\.com",
				"adwords-da" => "adwords-da\.blogspot\.com",
				"adwords-de" => "adwords-de\.blogspot\.com",
				"adwords-ee" => "adwords-ee\.blogspot\.com",
				"adwords-fi" => "adwords-fi\.blogspot\.com",
				"adwords-fr" => "adwords-fr\.blogspot\.com",
				"adwords-greece" => "adwords-greece\.blogspot\.com",
				"adwords-hu" => "adwords-hu\.blogspot\.com",
				"adwords-it" => "adwords-it\.blogspot\.com",
				"adwords-lv" => "adwords-lv\.blogspot\.com",
				"adwords-lt" => "adwords-lt\.blogspot\.com",
				"adwords-mena" => "adwords-mena\.blogspot\.com",
				"adwords-nl" => "adwords-nl\.blogspot\.com",
				"adwords-no" => "adwords-no\.blogspot\.com",
				"adwords-pl" => "adwords-pl\.blogspot\.com",
				"adwords-pt" => "adwords-pt\.blogspot\.com",
				"adwords-romania" => "adwords-romania\.blogspot\.com",
				"adwords-ru" => "adwords-ru\.blogspot\.com",
				"adwords-rs" => "adwords-rs\.blogspot\.com",
				"adwords-sk" => "adwords-sk\.blogspot\.com",
				"adwords-si" => "adwords-si\.blogspot\.com",
				"adwords-se" => "adwords-se\.blogspot\.com",
				"adwords-tr" => "adwords-tr\.blogspot\.com",
				"adwords-ko" => "adwords-ko\.blogspot\.com",
				"adwords-ja" => "adwords-ja\.blogspot\.com",
				"google-africa" => "google-africa\.blogspot\.com",
				"adwordsagency" => "adwordsagency\.blogspot\.com",
				"officialandroid" => "officialandroid\.blogspot\.com",
				"android-developers" => "android-developers\.blogspot\.com",
				"googleappsupdates" => "googleappsupdates\.blogspot\.com",
				"googleappsupdates-ja" => "googleappsupdates-ja\.blogspot\.com",
				"google-arabia" => "google-arabia\.blogspot\.com",
				"google-au" => "google-au\.blogspot\.com",
				"googleespana" => "googleespana\.blogspot\.com",
				"googlebrasilblog" => "googlebrasilblog\.blogspot\.com",
				"codigo-google" => "codigo-google\.blogspot\.com",
				"central-de-conversiones" => "central-de-conversiones\.blogspot\.com",
				"googlechinablog" => "googlechinablog\.blogspot\.com",
				"google-cpg" => "google-cpg\.blogspot\.com",
				"criadoresdoyoutube" => "criadoresdoyoutube\.blogspot\.com",
				"googlecustomsearch" => "googlecustomsearch\.blogspot\.com",
				"google-cz" => "google-cz\.blogspot\.com",
				"dataliberation" => "dataliberation\.blogspot\.com",
				"adwords-al" => "adwords-al\.blogspot\.com",
				"adwords-es" => "adwords-es\.blogspot\.com",
				"doubleclickadvertisers" => "doubleclickadvertisers\.blogspot\.com",
				"doubleclickpublishers" => "doubleclickpublishers\.blogspot\.com",
				"doubleclicksearch" => "doubleclicksearch\.blogspot\.com",
				"googlewebmaster-es" => "googlewebmaster-es\.blogspot\.com",
				"googleenterprisefrance" => "googleenterprisefrance\.blogspot\.com",
				"googleenterprise-ja" => "googleenterprise-ja\.blogspot\.com",
				"eurodev" => "eurodev\.blogspot\.com",
				"googlepolicyeurope" => "googlepolicyeurope\.blogspot\.com",
				"googlegeodevelopers" => "googlegeodevelopers\.blogspot\.com",
				"analytics" => "analytics\.blogspot\.com",
				"analytics-ja" => "analytics-ja\.blogspot\.com",
				"googleandyourbusiness" => "googleandyourbusiness\.blogspot\.com",
				"googleappsdeveloper" => "googleappsdeveloper\.blogspot\.com",
				"googleasiapacific" => "googleasiapacific\.blogspot\.com",
				"googlecanada" => "googlecanada\.blogspot\.com",
				"chrome" => "chrome\.blogspot\.com",
				"googlechromereleases" => "googlechromereleases\.blogspot\.com",
				"googlecloudplatform" => "googlecloudplatform\.blogspot\.com",
				"googlecommerce" => "googlecommerce\.blogspot\.com",
				"googledevelopers" => "googledevelopers\.blogspot\.com",
				"googledrive" => "googledrive\.blogspot\.com",
				"google-engtools" => "google-engtools\.blogspot\.com",
				"googlefiberblog" => "googlefiberblog\.blogspot\.com",
				"googlefipress" => "googlefipress\.blogspot\.com",
				"googlefornonprofits" => "googlefornonprofits\.blogspot\.com",
				"googlefrance" => "googlefrance\.blogspot\.com",
				"google-produkte" => "google-produkte\.blogspot\.com",
				"googleindia" => "googleindia\.blogspot\.com",
				"googleitalia" => "googleitalia\.blogspot\.com",
				"googlejapan" => "googlejapan\.blogspot\.com",
				"googledevjp" => "googledevjp\.blogspot\.com",
				"googlekoreablog" => "googlekoreablog\.blogspot\.com",
				"googleamericalatinablog" => "googleamericalatinablog\.blogspot\.com",
				"tecnologiayproductosgoogle" => "tecnologiayproductosgoogle\.blogspot\.com",
				"google-latlong" => "google-latlong\.blogspot\.com",
				"google-magyarorszag" => "google-magyarorszag\.blogspot\.com",
				"google-newzealand" => "google-newzealand\.blogspot\.com",
				"googlenewsblog" => "googlenewsblog\.blogspot\.com",
				"googlepersianblog" => "googlepersianblog\.blogspot\.com",
				"googlepolska" => "googlepolska\.blogspot\.com",
				"googlerussiablog" => "googlerussiablog\.blogspot\.com",
				"googlescholar" => "googlescholar\.blogspot\.com",
				"googleshopping" => "googleshopping\.blogspot\.com",
				"googlesepress" => "googlesepress\.blogspot\.com",
				"googlethailand" => "googlethailand\.blogspot\.com",
				"googletranslate" => "googletranslate\.blogspot\.com",
				"google-tr" => "google-tr\.blogspot\.com",
				"google-ukraine-blog" => "google-ukraine-blog\.blogspot\.com",
				"googlewebfonts" => "googlewebfonts\.blogspot\.com",
				"googlewebmastercentral" => "googlewebmastercentral\.blogspot\.com",
				"googleplusplatform" => "googleplusplatform\.blogspot\.com",
				"googlegreenblog" => "googlegreenblog\.blogspot\.com",
				"adsense" => "adsense\.blogspot\.com",
				"adwords" => "adwords\.blogspot\.com",
				"insidesearch" => "insidesearch\.blogspot\.com",
				"googleisraelforbusiness" => "googleisraelforbusiness\.blogspot\.com",
				"itasoftware" => "itasoftware\.blogspot\.com",
				"google-productos-es" => "google-productos-es\.blogspot\.com",
				"googlemobileads" => "googlemobileads\.blogspot\.com",
				"googleproducts-nl" => "googleproducts-nl\.blogspot\.com",
				"gmailblog" => "gmailblog\.blogspot\.com",
				"googleblog" => "googleblog\.blogspot\.com",
				"googleenterprise" => "googleenterprise\.blogspot\.com",
				"googlephotos" => "googlephotos\.blogspot\.com",
				"googleonlinesecurity" => "googleonlinesecurity\.blogspot\.com",
				"google-opensource" => "google-opensource\.blogspot\.com",
				"policybythenumbers" => "policybythenumbers\.blogspot\.com",
				"googlepolitics" => "googlepolitics\.blogspot\.com",
				"programa-con-google" => "programa-con-google\.blogspot\.com",
				"googlepublicpolicy" => "googlepublicpolicy\.blogspot\.com",
				"googleresearch" => "googleresearch\.blogspot\.com",
				"googleforstudents" => "googleforstudents\.blogspot\.com",
				"googletesting" => "googletesting\.blogspot\.com",
				"thinkwithgoogle" => "thinkwithgoogle\.blogspot\.com",
				"googleuk-finance" => "googleuk-finance\.blogspot\.com",
				"googleuk-travel" => "googleuk-travel\.blogspot\.com",
				"googlewebtoolkit" => "googlewebtoolkit\.blogspot\.com",
				"googlewebmastercentral-ja" => "googlewebmastercentral-ja\.blogspot\.com",
				"googlewebmastercentral-de" => "googlewebmastercentral-de\.blogspot\.com",
				"youtube-global" => "youtube-global\.blogspot\.com",
				"youtubeaublog" => "youtubeaublog\.blogspot\.com",
				"youtubebrblog" => "youtubebrblog\.blogspot\.com",
				"youtube-espanol" => "youtube-espanol\.blogspot\.com",
				"youtubejpblog" => "youtubejpblog\.blogspot\.com",
				"youtubekrblog" => "youtubekrblog\.blogspot\.com",
				"youtubeukblog" => "youtubeukblog\.blogspot\.com",
				"youtubecreatores" => "youtubecreatores\.blogspot\.com",
				"youtubecreatorfr" => "youtubecreatorfr\.blogspot\.com",
				"youtubecreator" => "youtubecreator\.blogspot\.com",
				"youtubecreatorit" => "youtubecreatorit\.blogspot\.com",
				"youtubecreatorjp" => "youtubecreatorjp\.blogspot\.com",
				"youtubecreatorkr" => "youtubecreatorkr\.blogspot\.com",
				"youtubecreatornl" => "youtubecreatornl\.blogspot\.com",
				"youtubecreatorzhtw" => "youtubecreatorzhtw\.blogspot\.com",
				"youtubecreatorbloguk" => "youtubecreatorbloguk\.blogspot\.com",
				"youtubecreatorpl" => "youtubecreatorpl\.blogspot\.com",
				"youtubecreatorde" => "youtubecreatorde\.blogspot\.com",
				"youtubecreatorru" => "youtubecreatorru\.blogspot\.com",
				"apiblog-youtube" => "apiblog\.youtube\.com",
				"zagat" => "zagat\.blogspot\.com",
				"orkut" => "\.orkut\.com",
				"panoramio" => "\.panoramio\.com",
				"googleorg" => "\.google\.org",
				"googlechinablog" => "\.googlechinablog\.com",
				"googlechinawebmaster" => "\.googlechinawebmaster\.com",
				"citizentube" => "\.citizentube\.com",
				"buzz" => "buzz\.blogger\.com",
				"waze" => "\.waze\.com",
				"urchincom" => "\.urchin\.com",			
				"googlecommercecom" => "\.googlecommerce\.com",			
				"googleusercontentcom" => "\.googleusercontent\.com",
				"gmailcom" => "\.gmail\.com",
				"googlesyndicationcom" => "\.googlesyndication\.com",
				"googleratingscom" => "\.googleratings\.com",
				"googl" => "\.goo\.gl",	
				"googleapiscom" => "\.googleapis\.com",			
				"googleappscom" => "\.googleapps\.com",
				"gstaticcom" => "\.gstatic\.com",			
				"gtempaccountcom" => "\.gtempaccount\.com",
				"ggphtcom" => "\.ggpht\.com",			
				"gco" => "\.g\.co",
				"googlrcom" => "\.googlr\.com",
				"googilcom" => "\.googil\.com",			
				"googelcom" => "\.googel\.com",
				"goolgecom" => "\.goolge\.com",
				"gogolecom" => "\.gogole\.com",			
				"goglecom" => "\.gogle\.com",
				"goooglecom" => "\.gooogle\.com",
				"googlebotcom" => "\.googlebot\.com",			
				"1e100net" => "\.1e100\.net",
				"likecom" => "\.like\.com",			
				"chromiumorg" => "\.chromium\.org",			
				"bloggercom" => "\.blogger\.com",
				"keyholecom" => "\.keyhole\.com",
				"youtubeeducationcom" => "youtubeeducation\.com",
				"youtu-be" => "youtu\.be",
				"frooglecom" => "\.froogle\.com",
				"igoogle" => "\.igoogle\.com",
				"doubleclickcom" => "\.doubleclick\.com",
				"feedburnercom" => "\.feedburner\.com",
				"picasa" => "\.picasa\.com",
				"androidcom" => "\.android\.com",
				"adsensecom" => "\.adsense\.com",
				"googleanalyticscom" => "\.google-analytics.com",
				"adwordscom" => "\.adwords\.com"
			);
		}
	}
}


/*
 * Plugin activation
 */
 
if (class_exists("AndreaNofollowGoogle")) {
	$anfs = new AndreaNofollowGoogle();
}


if (isset($anfs)) {
	add_action("init",array("AndreaNofollowGoogle","Enable"),1000,0);
}

if (!function_exists('andrea_nofollow_google')) {
	function andrea_nofollow_google() {
		$google_nofollow = new AndreaNofollowGoogle();
		return $google_nofollow->AutoNofollow();
	}	
}

?>
