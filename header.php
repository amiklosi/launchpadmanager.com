<?php defined( 'WEBPAGE' ) or header("Location: /"); ?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Launchpad Manager - Keep your Launchpad organised!</title>

<style type="text/css">
<!--
body {
	margin-top: 0px;
	background-image: url(images/bg.jpg);
	background-repeat: repeat-x;
	background-position: top;
	background-color: #000000;
}
-->
</style>
<link href="css/xom.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
a:link {
	color: #D2D2D2;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FCFCFC;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
	color: #E9E9E9;
}

-->
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27219725-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script>
  console.log('barackos');
    !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.crossOrigin="anonymous",p.async=!0,p.src=s.api_host.replace(".i.posthog.com","-assets.i.posthog.com")+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],u.toString=function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e},u.people.toString=function(){return u.toString(1)+".people (stub)"},o="init Ee Ps Rs xe ks Is capture We calculateEventProperties Cs register register_once register_for_session unregister unregister_for_session Ds getFeatureFlag getFeatureFlagPayload isFeatureEnabled reloadFeatureFlags updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures on onFeatureFlags onSurveysLoaded onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey canRenderSurveyAsync identify setPersonProperties group resetGroups setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags reset get_distinct_id getGroups get_session_id get_session_replay_url alias set_config startSessionRecording stopSessionRecording sessionRecordingStarted captureException loadToolbar get_property getSessionProperty Fs Ms createPersonProfile As Es opt_in_capturing opt_out_capturing has_opted_in_capturing has_opted_out_capturing clear_opt_in_out_capturing Ts debug Os getPageViewId captureTraceFeedback captureTraceMetric".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
    posthog.init('phc_a8QNe1B5aYDXPaUcWDvx0eiDdXKoElPJDB1nTmnJ7ha', {
        api_host: 'https://ph.launchpadmanager.com',
        defaults: '2025-05-24',
        person_profiles: 'identified_only', // or 'always' to create profiles for anonymous users as well
    })
</script>

</head>
<body>
<!--Start wrapper -->
<div class="containerWrap">
 <!--start header -->
 
  <div class="header">
  
      <!--start logo -->
      <div class="logo">
        <h1><img src="images/headerlogo.png" alt="Launchpad Manager">
        &nbsp;Launchpad Manager</h1>
        
               
        
    </div><!--end logo -->
    <!--start navigation -->
    <div id="nav">  
    	<li class="<?php echo (WEBPAGE=='home')?'current':''; ?>"><a href="home.php">Home</a></li>
      	<li class="<?php echo (WEBPAGE=='features')?'current':''; ?>"><a href="features.php">Features</a></li>
      	<li class="<?php echo (WEBPAGE=='buy')?'current':''; ?>"><a href="buy.php">Buy</a></li>
        <li class="<?php echo (WEBPAGE=='help')?'current':''; ?>"><a href="help.php">Help & Support</a></li>
        <li class="<?php echo (WEBPAGE=='faq')?'current':''; ?>"><a href="faq.php">FAQ</a></li>
        <li class="<?php echo (WEBPAGE=='contact')?'current':''; ?>"><a href="contact.php">Contact</a></li>
	</div> 
    <!--end navigation -->
