<?php


# Site language
$GAL_LANG = (isset($_GET["lang"]) && $_GET["lang"] == "fr") ? "fr" : "en" ;

# Different pages. They are located to : <lang>/file.md
$GAL_CONTENT_MAIN_PAGE = $GAL_LANG . "/content.md"         ; 
$GAL_MENU_LEFT_PAGE    = $GAL_LANG . "/contentLeft.md"     ; 
$GAL_HEADLINE_PAGE     = $GAL_LANG . "/contentHeadLine.md" ; 
$GAL_FOOTER_PAGE       = $GAL_LANG . "/contentFooter.md"   ; 

# Some labels
$GAL_LABELS = array(
				"DOWNLOAD_SOURCE_CODE" => array("fr" => "T&eacute;l&eacute;chargez le code ci-dessous",	
												"en" => "Download the source code below"
												)
				) ;
				
define("GAL_LABEL_DOWNLOAD_CODE", $GAL_LABELS["DOWNLOAD_SOURCE_CODE"][$GAL_LANG] );

?>