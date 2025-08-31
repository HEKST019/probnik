<?php
session_start();
require_once '../../shop/configDB.php'; // Подключаем БД если нужно что-то дополнительно проверять
?>

<!DOCTYPE html>
<!--[if IE 9 ]>   <html class="no-js oldie ie9 ie" lang="ru-RU" > <![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" lang="ru-RU"> <!--<![endif]-->
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- devices setting -->
        <meta name="viewport" content="initial-scale=1,user-scalable=no,width=device-width">

<!-- outputs by wp_head -->
<title>мясо &#8212; Столовая</title>
<meta name="robots" content="max-image-preview:large">
	<style>img:is([sizes="auto" i], [sizes^="auto," i]) { contain-intrinsic-size: 3000px 1500px }</style>
	<link rel="alternate" type="application/rss+xml" title="Столовая &raquo; Лента" href="/feed/">
<link rel="alternate" type="application/rss+xml" title="Столовая &raquo; Лента комментариев" href="/comments/feed/">
<link rel="alternate" type="application/rss+xml" title="Столовая &raquo; Лента элемента мясо таксономии Метка" href="/product-tag/%d0%bc%d1%8f%d1%81%d0%be/feed/">
<style id="wp-emoji-styles-inline-css">img.wp-smiley, img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 0.07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}</style>
<link rel="stylesheet" id="wp-block-library-css" href="/wp-includes/css/dist/block-library/style.min.css?ver=6.8.2" media="all">
<style id="classic-theme-styles-inline-css">/*! This file is auto-generated */
.wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}</style>
<style id="global-styles-inline-css">:root{--wp--preset--aspect-ratio--square: 1;--wp--preset--aspect-ratio--4-3: 4/3;--wp--preset--aspect-ratio--3-4: 3/4;--wp--preset--aspect-ratio--3-2: 3/2;--wp--preset--aspect-ratio--2-3: 2/3;--wp--preset--aspect-ratio--16-9: 16/9;--wp--preset--aspect-ratio--9-16: 9/16;--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);--wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);}:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flex{display: flex;}.is-layout-flex{flex-wrap: wrap;align-items: center;}.is-layout-flex > :is(*, div){margin: 0;}body .is-layout-grid{display: grid;}.is-layout-grid > :is(*, div){margin: 0;}:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
:where(.wp-block-post-template.is-layout-flex){gap: 1.25em;}:where(.wp-block-post-template.is-layout-grid){gap: 1.25em;}
:where(.wp-block-columns.is-layout-flex){gap: 2em;}:where(.wp-block-columns.is-layout-grid){gap: 2em;}
:root :where(.wp-block-pullquote){font-size: 1.5em;line-height: 1.6;}</style>
<link rel="stylesheet" id="woocommerce-layout-css" href="/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css?ver=10.1.2" media="all">
<link rel="stylesheet" id="woocommerce-smallscreen-css" href="/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=10.1.2" media="only screen and (max-width: 768px)">
<link rel="stylesheet" id="woocommerce-general-css" href="/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=10.1.2" media="all">
<style id="woocommerce-inline-inline-css">.woocommerce form .form-row .required { visibility: visible; }</style>
<link rel="stylesheet" id="brands-styles-css" href="/wp-content/plugins/woocommerce/assets/css/brands.css?ver=10.1.2" media="all">
<link rel="stylesheet" id="auxin-base-css" href="/wp-content/themes/phlox/css/base.css?ver=2.17.0" media="all">
<link rel="stylesheet" id="auxin-front-icon-css" href="/wp-content/themes/phlox/css/auxin-icon.css?ver=2.17.0" media="all">
<link rel="stylesheet" id="auxin-main-css" href="/wp-content/themes/phlox/css/main.css?ver=2.17.0" media="all">
<link rel="stylesheet" id="auxin-custom-css" href="/wp-content/uploads/phlox/custom.css?ver=4" media="all">
<link rel="stylesheet" id="auxin-elementor-base-css" href="/wp-content/themes/phlox/css/other/elementor.css?ver=2.17.0" media="all">
<link rel="stylesheet" id="elementor-frontend-css" href="/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.31.3" media="all">
<link rel="stylesheet" id="elementor-post-246-css" href="/wp-content/uploads/elementor/css/post-246.css?ver=1756577718" media="all">
<link rel="stylesheet" id="elementor-post-247-css" href="/wp-content/uploads/elementor/css/post-247.css?ver=1756577718" media="all">
<link rel="stylesheet" id="bvi-styles-css" href="/wp-content/plugins/button-visually-impaired/assets/css/bvi.min.css?ver=2.3.0" media="all">
<style id="bvi-styles-inline-css">.bvi-widget,
			.bvi-shortcode a,
			.bvi-widget a,
			.bvi-shortcode {
				color: #ffffff;
				background-color: #0aaa09;
			}
			.bvi-widget .bvi-svg-eye,
			.bvi-shortcode .bvi-svg-eye {
			    display: inline-block;
                overflow: visible;
                width: 1.125em;
                height: 1em;
                font-size: 2em;
                vertical-align: middle;
			}
			.bvi-widget,
			.bvi-shortcode {
			    -webkit-transition: background-color .2s ease-out;
			    transition: background-color .2s ease-out;
			    cursor: pointer;
			    border-radius: 2px;
			    display: inline-block;
			    padding: 5px 10px;
			    vertical-align: middle;
			    text-decoration: none;
			}</style>
<link rel="stylesheet" id="elementor-gf-local-poppins-css" href="/wp-content/uploads/elementor/google-fonts/css/poppins.css?ver=1744458886" media="all">
<script src="/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script>
<script src="/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.10.1.2" id="jquery-blockui-js" defer data-wp-strategy="defer"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=10.1.2" id="wc-add-to-cart-js" defer data-wp-strategy="defer"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4-wc.10.1.2" id="js-cookie-js" defer data-wp-strategy="defer"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=10.1.2" id="woocommerce-js" defer data-wp-strategy="defer"></script>
<script src="/wp-content/themes/phlox/js/solo/modernizr-custom.min.js?ver=2.17.0" id="auxin-modernizr-js"></script>
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#1bb0ce">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#1bb0ce">
<!-- iOS Safari -->
			<style>.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
					background-image: none !important;
				}
				@media screen and (max-height: 1024px) {
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
				@media screen and (max-height: 640px) {
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}</style>
			<!-- end wp_head -->
</head>


<body class="archive tax-product_tag term-31 wp-theme-phlox theme-phlox woocommerce woocommerce-page woocommerce-no-js elementor-default elementor-kit-31 phlox aux-dom-unready aux-full-width aux-resp aux-s-fhd aux-top-sticky  aux-page-animation-off _auxels" data-framed="">


<div id="inner-body">

    <header class="aux-elementor-header" id="site-elementor-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader" data-sticky-height="80">
        <div class="aux-wrapper">
            <div class="aux-header aux-header-elements-wrapper">
            		<div data-elementor-type="header" data-elementor-id="246" class="elementor elementor-246">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-54a26d6 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="54a26d6" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="aux-parallax-section elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-99ffd65" data-id="99ffd65" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-c49eb21 elementor-widget__width-auto elementor-widget-tablet__width-inherit elementor-widget-mobile__width-auto elementor-widget elementor-widget-aux_logo" data-id="c49eb21" data-element_type="widget" data-widget_type="aux_logo.default">
				<div class="elementor-widget-container">
					<div class="aux-widget-logo"><section class="aux-logo-text"><h3 class="site-title"><a href="/" title="Столовая">Столовая</a></h3></section></div>				</div>
				</div>
				<div class="elementor-element elementor-element-d052931 elementor-widget__width-auto elementor-widget-tablet__width-auto elementor-widget-mobile__width-auto elementor-widget elementor-widget-aux_menu_box" data-id="d052931" data-element_type="widget" data-widget_type="aux_menu_box.default">
				<div class="elementor-widget-container">
					<div class="aux-elementor-header-menu aux-nav-menu-element aux-nav-menu-element-d052931">
<div class="aux-burger-box" data-target-panel="overlay" data-target-content=".elementor-element-d052931 .aux-master-menu"><div class="aux-burger aux-lite-small"><span class="mid-line"></span></div></div>
<!-- start master menu -->
<nav id="master-menu-elementor-d052931" class="menu-header-menu-container">

	<ul id="menu-header-menu" class="aux-master-menu aux-no-js aux-skin-classic aux-with-indicator aux-horizontal" data-type="horizontal" data-switch-type="toggle" data-switch-parent=".elementor-element-d052931 .aux-fs-popup .aux-fs-menu" data-switch-width="768">
		<!-- start single menu -->
		<li id="menu-item-289" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-289 aux-menu-depth-0 aux-menu-root-1 aux-menu-item">
			<a href="/shop/" class="aux-item-content">
				<span class="aux-menu-label">Магазин</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-290" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-290 aux-menu-depth-0 aux-menu-root-2 aux-menu-item">
			<a href="/%d0%bd%d0%be%d0%b2%d0%be%d1%81%d1%82%d0%b8-%d0%b8-%d0%b0%d0%ba%d1%86%d0%b8%d0%b8/" class="aux-item-content">
				<span class="aux-menu-label">Новости</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-291" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-291 aux-menu-depth-0 aux-menu-root-3 aux-menu-item">
			<a href="/%d0%b0%d0%ba%d1%86%d0%b8%d0%b8/" class="aux-item-content">
				<span class="aux-menu-label">Акции</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-292" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-292 aux-menu-depth-0 aux-menu-root-4 aux-menu-item">
			<a href="/%d0%b4%d0%be%d1%81%d1%82%d0%b0%d0%b2%d0%ba%d0%b0/" class="aux-item-content">
				<span class="aux-menu-label">Доставка</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-293" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-293 aux-menu-depth-0 aux-menu-root-5 aux-menu-item">
			<a href="/%d0%ba%d0%be%d0%bd%d1%82%d0%b0%d0%ba%d1%82%d1%8b/" class="aux-item-content">
				<span class="aux-menu-label">Контакты</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-294" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-294 aux-menu-depth-0 aux-menu-root-6 aux-menu-item">
			<a href="/%d0%be-%d0%ba%d0%be%d0%bc%d0%bf%d0%b0%d0%bd%d0%b8%d0%b8/" class="aux-item-content">
				<span class="aux-menu-label">О компании</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-295" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-295 aux-menu-depth-0 aux-menu-root-7 aux-menu-item">
			<a href="/my-account/" class="aux-item-content">
				<span class="aux-menu-label">Мой аккаунт</span>
			</a>
		</li>
		<!-- end single menu -->
		<!-- start single menu -->
		<li id="menu-item-296" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-296 aux-menu-depth-0 aux-menu-root-8 aux-menu-item">
			<a href="/cart/" class="aux-item-content">
				<span class="aux-menu-label">Корзина</span>
			</a>
		</li>
		<!-- end single menu -->
	</ul>

</nav>
<!-- end master menu -->
<section class="aux-fs-popup aux-fs-menu-layout-center aux-indicator"><div class="aux-panel-close"><div class="aux-close aux-cross-symbol aux-thick-medium"></div></div>
<div class="aux-fs-menu" data-menu-title=""></div></section>
</div>
<style>@media only screen and (min-width: 769px) { .elementor-element-d052931 .aux-burger-box { display: none } }</style>				</div>
				</div>
				<div class="elementor-element elementor-element-fa0e386 elementor-widget__width-auto elementor-widget elementor-widget-shortcode" data-id="fa0e386" data-element_type="widget" data-widget_type="shortcode.default">
				<div class="elementor-widget-container">
							<div class="elementor-shortcode"><div class="bvi-shortcode"><a href="#" class="bvi-open"><svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512" class="bvi-svg-eye"><path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" class="bvi-svg-eye"></path></svg>&ensp;</a></div></div>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
		            </div>
<!-- end of header-elements -->
        </div>
<!-- end of wrapper -->
    </header><!-- end header -->
        <header id="site-title" class="page-title-section">

            <div class="page-header aux-wrapper aux-boxed-container aux-top aux-dark" style="display:block;">


                <div class="aux-container">

                    <p class="aux-breadcrumbs"><span class="aux-breadcrumb-sep breadcrumb-icon auxicon-chevron-right-1"></span><span><a title="Главная">Главная</a></span><span class="aux-breadcrumb-sep breadcrumb-icon auxicon-chevron-right-1"></span><span><a href="/shop/" title="Товары">Товары</a></span><span class="aux-breadcrumb-sep breadcrumb-icon auxicon-chevron-right-1"></span><span> мясо</span></p>

                                        <div class="aux-page-title-entry">
                                            <div class="aux-page-title-box">
                                                <section class="page-title-group">
                                                                <h1 class="page-title">мясо</h1>
                                                            </section>

                                                    </div>
                    </div>
<!-- end title entry -->
                                    </div>


            </div>
<!-- end page header -->
        </header> <!-- end page header -->
            <main id="main" class="aux-main aux-territory aux-template-type-default aux-archive aux-tax aux-shop-archive list-product aux-content-top-margin right-sidebar aux-has-sidebar aux-sidebar-style-border aux-user-entry">
        <div class="aux-wrapper">
            <div class="aux-container aux-fold">
                <div id="primary" class="aux-primary">
                    <div class="content" role="main">
    <header class="woocommerce-products-header">
			<h1 class="woocommerce-products-header__title page-title">мясо</h1>

	</header>
<div class="woocommerce-notices-wrapper"></div>
<p class="woocommerce-result-count" role="alert" aria-relevant="all">
	Отображение единственного товара</p>
<form class="woocommerce-ordering" method="get">
		<select name="orderby" class="orderby" aria-label="Заказ в магазине">
					<option value="menu_order" selected>Исходная сортировка</option>
					<option value="popularity">По популярности</option>
					<option value="rating">По рейтингу</option>
					<option value="date">По новизне</option>
					<option value="price">По возрастанию цены</option>
					<option value="price-desc">По убыванию цены</option>
			</select>
	<input type="hidden" name="paged" value="1">
	<input type="hidden" name="simply_static_page" value="6161">
</form>
<ul class="products columns-4">
<li class="product type-product post-65 status-publish first instock product_cat-19 product_cat-18 product_tag-31 product_tag-30 has-post-thumbnail sale taxable shipping-taxable purchasable product-type-simple aux-remove-view-cart">
	<a href="/product/pirogsmyas/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
	<span class="onsale">Распродажа!</span>
	<img fetchpriority="high" width="300" height="457" src="/wp-content/uploads/2025/06/пирожок-с-мясом-300x457.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Пирожок с мясом" decoding="async"></a><a href="/product/pirogsmyas/"><h2 class="woocommerce-loop-product__title">Пирожок с мясом</h2></a>
	<span class="price"><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>500,00&nbsp;<span class="woocommerce-Price-currencySymbol">&#8381;</span></bdi></span></del> <span class="screen-reader-text">Первоначальная цена составляла 500,00&nbsp;&#8381;.</span><ins aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>150,00&nbsp;<span class="woocommerce-Price-currencySymbol">&#8381;</span></bdi></span></ins><span class="screen-reader-text">Текущая цена: 150,00&nbsp;&#8381;.</span></span>

  <div class="wp-block-button wc-block-grid__product-add-to-cart">
    <a href="/shop/?add-to-cart=65" aria-label="Добавить в корзину &ldquo;Пирожок с мясом&rdquo;" data-quantity="1" data-product_id="65" data-product_sku="а102" data-price="150" rel="nofollow" class="wp-block-button__link ">В корзину</a>
  </div>

</li>
</ul>
                    </div>
                </div>

            <aside class="aux-sidebar aux-sidebar-primary">
                <div class="sidebar-inner">
                    <div class="sidebar-content">
<div class="aux-widget-area"><section id="woocommerce_widget_cart-2" class=" aux-open widget-container woocommerce widget_shopping_cart"><h3 class="widget-title">Корзина</h3>
<div class="hide_cart_widget_if_empty"><div class="widget_shopping_cart_content"></div></div></section></div>                    </div>
<!-- end sidebar-content -->
                </div>
<!-- end sidebar-inner -->
            </aside><!-- end primary siderbar -->
            </div>
        </div>
    </main>
        <footer class="aux-elementor-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter" role="contentinfo">
        <div class="aux-wrapper">
        		<div data-elementor-type="footer" data-elementor-id="247" class="elementor elementor-247">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-333a101 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="333a101" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="aux-parallax-section elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-1f2d8af4" data-id="1f2d8af4" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-5f40f80f elementor-widget__width-auto elementor-hidden-phone elementor-widget elementor-widget-aux_logo" data-id="5f40f80f" data-element_type="widget" data-widget_type="aux_logo.default">
				<div class="elementor-widget-container">
					<div class="aux-widget-logo"><section class="aux-logo-text"><h3 class="site-title"><a href="/" title="Столовая">Столовая</a></h3></section></div>				</div>
				</div>
				<div class="elementor-element elementor-element-3d79eb07 elementor-widget__width-auto elementor-widget elementor-widget-text-editor" data-id="3d79eb07" data-element_type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
									<p>© 2025 Столовая. Дёмин Александр Николаевич. Все права защищены.  </p>								</div>
				</div>
					</div>
		</div>
				<div class="aux-parallax-section elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-698f8207 elementor-hidden-phone" data-id="698f8207" data-element_type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				</div>
		        </div>
<!-- end of wrapper -->
    </footer><!-- end footer -->

</div>
<!--! end of #inner-body -->

    <div class="aux-hidden-blocks">

        <section id="offmenu" class="aux-offcanvas-menu aux-pin-left">
            <div class="aux-panel-close">
                <div class="aux-close aux-cross-symbol aux-thick-medium"></div>
            </div>
            <div class="offcanvas-header">
            </div>
            <div class="offcanvas-content">
            </div>
            <div class="offcanvas-footer">
            </div>
        </section>
        <!-- offcanvas section -->

        <section id="offcart" class="aux-offcanvas-menu aux-offcanvas-cart aux-pin-left">
            <div class="aux-panel-close">
                <div class="aux-close aux-cross-symbol aux-thick-medium"></div>
            </div>
            <div class="offcanvas-header">
                Корзина            </div>
            <div class="aux-cart-wrapper aux-elegant-cart aux-offcart-content">
            </div>
        </section>
        <!-- cartcanvas section -->

                <section id="fs-menu-search" class="aux-fs-popup  aux-fs-menu-layout-center aux-indicator">
            <div class="aux-panel-close">
                <div class="aux-close aux-cross-symbol aux-thick-medium"></div>
            </div>
            <div class="aux-fs-menu">
                        </div>
            <div class="aux-fs-search">
                <div class="aux-search-section ">
                <div class="aux-search-form ">
            <form action="/" method="get">
            <div class="aux-search-input-form">
                            <input type="text" class="aux-search-field" placeholder="Введите здесь..." name="s" autocomplete="off">
                                    </div>
                            <input type="submit" class="aux-black aux-search-submit aux-uppercase" value="Поиск">
                        </form>
        </div>
<!-- end searchform -->
                </div>

            </div>
        </section>
        <!-- fullscreen search and menu -->
                <section id="fs-search" class="aux-fs-popup aux-search-overlay  has-ajax-form">
            <div class="aux-panel-close">
                <div class="aux-close aux-cross-symbol aux-thick-medium"></div>
            </div>
            <div class="aux-search-field">

            <div class="aux-search-section aux-404-search">
                <div class="aux-search-form aux-iconic-search">
            <form action="/" method="get">
            <div class="aux-search-input-form">
                            <input type="text" class="aux-search-field" placeholder="Поиск…" name="s" autocomplete="off">
                                    </div>
                            <div class="aux-submit-icon-container auxicon-search-4 ">
                    <input type="submit" class="aux-iconic-search-submit" value="Поиск">
                </div>
                        </form>
        </div>
<!-- end searchform -->
                </div>

            </div>
        </section>
        <!-- fullscreen search-->

        <div class="aux-scroll-top"></div>
    </div>

    <div class="aux-goto-top-btn aux-align-btn-right"><div class="aux-hover-slide aux-arrow-nav aux-round aux-outline">    <span class="aux-overlay"></span>    <span class="aux-svg-arrow aux-h-small-up"></span>    <span class="aux-hover-arrow aux-svg-arrow aux-h-small-up aux-white"></span>
</div></div>
<!-- outputs by wp_footer -->
<script type="speculationrules">{"prefetch":[{"source":"document","where":{"and":[{"href_matches":"\/wordpress\/*"},{"not":{"href_matches":["\/wordpress\/wp-*.php","\/wordpress\/wp-admin\/*","\/wordpress\/wp-content\/uploads\/*","\/wordpress\/wp-content\/*","\/wordpress\/wp-content\/plugins\/*","\/wordpress\/wp-content\/themes\/phlox\/*","\/wordpress\/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}</script>
			<script>const lazyloadRunObserver = () => {
					const lazyloadBackgrounds = document.querySelectorAll( `.e-con.e-parent:not(.e-lazyloaded)` );
					const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
						entries.forEach( ( entry ) => {
							if ( entry.isIntersecting ) {
								let lazyloadBackground = entry.target;
								if( lazyloadBackground ) {
									lazyloadBackground.classList.add( 'e-lazyloaded' );
								}
								lazyloadBackgroundObserver.unobserve( entry.target );
							}
						});
					}, { rootMargin: '200px 0px 200px 0px' } );
					lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
						lazyloadBackgroundObserver.observe( lazyloadBackground );
					} );
				};
				const events = [
					'DOMContentLoaded',
					'elementor/lazyload/observe',
				];
				events.forEach( ( event ) => {
					document.addEventListener( event, lazyloadRunObserver );
				} );</script>
				<script>(function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();</script>
	<link rel="stylesheet" id="wc-blocks-style-css" href="/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks.css?ver=wc-10.1.2" media="all">
<link rel="stylesheet" id="elementor-post-31-css" href="/wp-content/uploads/elementor/css/post-31.css?ver=1756577718" media="all">
<link rel="stylesheet" id="auxin-elementor-widgets-css" href="/wp-content/plugins/auxin-elements/admin/assets/css/elementor-widgets.css?ver=2.17.9" media="all">
<link rel="stylesheet" id="mediaelement-css" href="/wp-includes/js/mediaelement/mediaelementplayer-legacy.min.css?ver=4.2.17" media="all">
<link rel="stylesheet" id="wp-mediaelement-css" href="/wp-includes/js/mediaelement/wp-mediaelement.min.css?ver=6.8.2" media="all">
<link rel="stylesheet" id="elementor-gf-local-roboto-css" href="/wp-content/uploads/elementor/google-fonts/css/roboto.css?ver=1744459036" media="all">
<link rel="stylesheet" id="elementor-gf-local-robotoslab-css" href="/wp-content/uploads/elementor/google-fonts/css/robotoslab.css?ver=1744459080" media="all">
<script src="/wp-includes/js/imagesloaded.min.js?ver=5.0.0" id="imagesloaded-js"></script>
<script src="/wp-includes/js/masonry.min.js?ver=4.2.2" id="masonry-js"></script>
<script src="/wp-content/themes/phlox/js/plugins.min.js?ver=2.17.0" id="auxin-plugins-js"></script>
<script src="/wp-content/themes/phlox/js/scripts.min.js?ver=2.17.0" id="auxin-scripts-js"></script>
<script src="/wp-content/plugins/auxin-elements/admin/assets/js/elementor/widgets.js?ver=2.17.9" id="auxin-elementor-widgets-js"></script>
<script src="/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=4.2.17" id="mediaelement-core-js"></script>
<script src="/wp-includes/js/mediaelement/mediaelement-migrate.min.js?ver=6.8.2" id="mediaelement-migrate-js"></script>
<script src="/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=6.8.2" id="wp-mediaelement-js"></script>
<script src="/wp-content/plugins/auxin-elements/public/assets/js/plugins.min.js?ver=2.17.9" id="auxin-elements-plugins-js"></script>
<script src="/wp-content/plugins/auxin-elements/public/assets/js/scripts.js?ver=2.17.9" id="auxin-elements-scripts-js"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/sourcebuster/sourcebuster.min.js?ver=10.1.2" id="sourcebuster-js-js"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution.min.js?ver=10.1.2" id="wc-order-attribution-js"></script>
<script src="/wp-content/uploads/phlox/custom.js?ver=5.6" id="auxin-custom-js-js"></script>
<script id="bvi-script-js-extra">var wp_bvi = {"option":{"theme":"white","font":"arial","fontSize":16,"letterSpacing":"normal","lineHeight":"normal","images":true,"reload":false,"speech":true,"builtElements":true,"panelHide":false,"panelFixed":true,"lang":"ru-RU"}};</script>
<script src="/wp-content/plugins/button-visually-impaired/assets/js/bvi.min.js?ver=2.3.0" id="bvi-script-js"></script>
<script id="bvi-script-js-after">var Bvi = new isvek.Bvi(wp_bvi.option);</script>
<script src="/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.31.3" id="elementor-webpack-runtime-js"></script>
<script src="/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.31.3" id="elementor-frontend-modules-js"></script>
<script src="/wp-includes/js/jquery/ui/core.min.js?ver=1.13.3" id="jquery-ui-core-js"></script>
<script src="/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.31.3" id="elementor-frontend-js"></script>
<script src="/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=10.1.2" id="wc-cart-fragments-js" defer data-wp-strategy="defer"></script>
<!-- end wp_footer -->
</body>
</html>
