<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 */
?>

<div id="content-wrapper" class="row">
  <?php // Content warapper defines the edges of the entire content space with a drop shadow or similar effect. ?>
  <div id="container">
    <?php
    // Render the topbar regions
    $topbar_left  = render($page['topbar_left']);
    $topbar_right = render($page['topbar_right']);
  ?>
    <?php if (!empty($topbar_left) || !empty($topbar_right)): ?>
    <nav class="top-bar fixed">
      <ul class="title-area">
        <!-- Title Area -->
        <?php if ($site_name): ?>
        <li class="name">
          <h1><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"> <?php print $site_name; ?></a> </h1>
        </li>
        <?php endif; ?>
        <!--  Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>
      <section class="top-bar-section">
        <?php if ($topbar_left): ?>
        <?php print $topbar_left; ?>
        <?php endif; ?>
        <?php if ($topbar_right): ?>
        <?php print $topbar_right; ?>
        <?php endif; ?>
      </section>
    </nav>
    <?php endif; ?>
    <header id="header" class="row" role="banner">
      <?php if ($logo): ?>
      <div class="large-2 columns"> <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a> </div>
      <?php endif; ?>
      <?php if ($site_name || $site_slogan): ?>
      <hgroup class="large-10 columns" id="name-and-slogan">
        <?php if ($site_name): ?>
        <h1 id="site-name"> <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a> </h1>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
        <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      </hgroup>
      <!-- /#name-and-slogan -->
      <?php endif; ?>
      <div class="large-12 columns">
        <div id="sticky-links"><?php print render($page['header']); ?></div>
      </div>
    </header>
    <?php $navigation = render($page['navigation']); ?>
    <?php if ($navigation):
    // This menu renders if you place the Main menu (navbar) Block into the Navigation Region. This block is created by
    // the Zoundation Support Module.
    // This menu will allow you to add specific Menu Blocks and provides Zurb Foundation dropdown menus.
  ?>
    <div id="black-navigation" class="row">
      <nav id="button-bar" class="large-12 columns" role="navigation"> <?php print $navigation; ?> </nav>
    </div>
    <!-- /#navigation -->
    <?php endif; ?>
    <?php if ($main_menu):
  // This menu will show up if you have selected  "Main menu" on your sub-theme's settings form.
  // This is the default Main Menu.
  ?>
    <div id="navigation" class="row">
      <nav id="main-menu" class="large-12 columns button-bar"  role="navigation">
        <?php
      print theme('links__system_main_menu', array(
        'links' => $main_menu,
        'attributes' => array(
          'class' => array('button-group'),
        ),
        'heading' => array(
          'text' => t('Main menu'),
          'level' => 'h2',
          'class' => array('element-invisible'),
        ),
      )); ?>
      </nav>
    </div>
    <!-- /#navigation -->
    <?php endif; ?>
    <?php //Insert logo over atmospheric images ?>
    <div class="row">
      <div id="atmosphere-wrppaer" class="large-12 columns">
        <div id="atmosphere-logo"><?php print '<img src="'.base_path() . path_to_theme() .'/images/atmosphere-logo.png" width="100%">';  ?></div>
      </div>
      <?php // Insert page identity and "the tear" ?>
      <div class="large-12 columns">
        <div id="page-deco" class="hide-for-small">
          <object>
            <?php include(path_to_theme()."/images/page-deco-r1.svg");  ?>
          </object>
        </div>
        <div id="page-id-mobile" class="show-for-small">
          <object>
            <?php include(path_to_theme()."/images/mobile/m_page-identity.svg");  ?>
          </object>
        </div>
      </div>
    </div>
    <div id="content" class="row" role="main">
      <div class="<?php print $main_classes; ?>"> <?php print render($page['highlighted']); ?>
        <?php // print $breadcrumb; ?>
        <a id="main-content"></a> <?php print $messages; ?> <?php print render($tabs); ?> <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
        <?php endif; ?>
        <?php print render($page['content']); ?> <?php print $feed_icons; ?> </div>
      <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>
      <?php if ($sidebar_first): ?>
      <aside class="<?php print $sidebar_first_classes; ?> sidebar"> <?php print $sidebar_first; ?> </aside>
      <!-- /.sidebars -->
      <?php endif; ?>
      <?php if ($sidebar_second): ?>
      <aside class="<?php print $sidebar_second_classes; ?> sidebar"> <?php print $sidebar_second; ?> </aside>
      <!-- /.sidebars -->
      <?php endif; ?>
    </div>
    <!-- /#content -->
    
    <div class="row" id="triptych">
      <div class="large-12 columns">
        <?php
      // Render the tryptich regions to see if there's anything in them.
      $triptych_first  = render($page['triptych_first']);
      $triptych_middle  = render($page['triptych_middle']);
      $triptych_last  = render($page['triptych_last']);
    ?>
        <?php if ($triptych_first ): ?>
        <div class="<?php print $triptych_first_classes; ?>" id="triptych-first"> <?php print $triptych_first; ?> </div>
        <?php endif; ?>
        <?php if ($triptych_middle ): ?>
        <div class="<?php print $triptych_middle_classes; ?> inverted" id="triptych-middle">
          <div class="section-container accordion" data-section="accordion">
            <section>
              <p class="title" data-section-title><a href="#">Ministry Menu</a></p>
              <div class="content" data-section-content>
                <ul class="large-block-grid-4 small-block-grid-2">
                  <li class=""> <a href="/ministries/lifegroups" class="exp-menu">LifeGroups</a> </li>
                  <li class=""> <a href="/ministries/men" class="exp-menu">Men</a> </li>
                  <li class=""> <a href="/ministries/women" class="exp-menu">Women</a> </li>
                  <li class=""> <a href="/ministries/young-adults" class="exp-menu">Young Adults</a> </li>
                  <li class=""> <a href="/ministries/senior-ministries" class="exp-menu">Senior Ministries</a> </li>
                  <li class=""> <a href="/ministries/healing-wholeness" class="exp-menu">Healing &amp; Wholeness</a> </li>
                  <li class=""> <a href="/ministries/all-children" class="exp-menu">All Children</a> </li>
                  <li class=""> <a href="/ministries/nursery" class="exp-menu">Nursery</a> </li>
                  <li class=""> <a href="/ministries/early-childhood" class="exp-menu">Early Childhood</a> </li>
                  <li class=""> <a href="/ministries/1st-2nd-grade" class="exp-menu">1st-2nd Grade</a> </li>
                  <li class=""> <a href="/ministries/3rd-5th-grade" class="exp-menu">3rd-5th Grade</a> </li>
                  <li class=""> <a href="/ministries/all-youth" class="exp-menu">All Youth</a> </li>
                  <li class=""> <a href="/ministries/6th-grade" class="exp-menu">6th Grade</a> </li>
                  <li class=""> <a href="/ministries/jr-high" class="exp-menu">Jr. High</a> </li>
                  <li class=""> <a href="/ministries/high-school" class="exp-menu">High School</a> </li>
                  <li class=""> <a href="/ministries/camp" class="exp-menu">Camp</a> </li>
                  <li class=""> <a href="/ministries/local-outreach" class="exp-menu">Local Outreach</a> </li>
                  <li class=""> <a href="/ministries/global-outreach" class="exp-menu">Global Outreach</a> </li>
                  <li class=""> <a href="/ministries/international-ministries" class="exp-menu">International Ministries</a> </li>
                  <li class=""> <a href="/ministries/holidays" class="exp-menu">Holidays</a> </li>
                  <li class=""> <a href="/ministries/new-beaverton-4" class="exp-menu">New To Beaverton 4</a> </li>
                  <li class=""> <a href="/ministries/new-christianity" class="exp-menu">New To Christianity</a> </li>
                </ul>
                <?php // print $triptych_middle; ?>
              </div>
            </section>
            <section>
              <p class="title" data-section-title><a href="#">Close Menu</a></p>
              <div class="content close" data-section-content>
                <p>&nbsp;</p>
              </div>
            </section>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($triptych_last ): ?>
        <div class="<?php print $triptych_last_classes; ?>" id="triptych-last"> <?php print $triptych_last; ?> </div>
        <?php endif; ?>
      </div>
    </div>
    <!-- /#triptych --> 
    
  </div>
  <!-- /#container -->
  
  <footer>
    <div class="row" id="name"> <?php print render($page['footer']); ?> </div>
  </footer>
</div>
<!-- /#content-wrapper --> 
<script>
  document.write('<script src=' +
  ('__proto__' in {} ? '/<?php print $directory; ?>/javascripts/vendor/zepto' : '/<?php print $directory; ?>/javascripts/vendor/jquery') +
  '.js><\/script>')
</script> 