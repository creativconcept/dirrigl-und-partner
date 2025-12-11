<?php
/**
 * Header
 *
 * @package dirrigl
 *
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>




    <!-- ********** PAGE ********** -->

    <div id="page" class="w-full">

        <header id="top-header" class="w-full fixed z-30 opacity-1 transition duration-500 ease-in-out">

            <!-- ********** TOPBAR ********** -->

            <div id="topbar" class="bg-dirrigl">

                <div class="flex justify-between items-center max-w-screen-2xl m-auto px-4 md:px-6 py-3 text-white">

                    <p class="text-sm"><?php echo get_bloginfo( 'description' ); ?></p>

                    <div class="flex items-center space-x-0 sm:space-x-4">
                        <form class="hidden xl:flex" id="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
                            <input type="text" name="s" id="searchinput" value="<?php echo get_search_query(); ?>"
                                    class="block w-full text-sm bg-dirrigl outline-none border-b border-gray-400"
                                    placeholder="<?php pll_e('Suchen'); ?>">
                            <button type="submit" id="searchsubmit"
                                class="-ml-px relative inline-flex items-center space-x-2 px-3 py-1 text-sm font-medium 
                                        text-white bg-dirrigl outline-none focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>

                        <ul id="language_switcher"
                            class="text-sm font-semibold">
                            <?php pll_the_languages(array('hide_current' => 1));?>
                        </ul>
                    </div>

                </div>

            </div>

            <!-- ********** / TOPBAR ********** -->


            <!-- ********** TOP ********** -->

            <div id="top" class="w-full">

                <!-- ********** MAIN MENU ********** -->

                <?php 
                    // Get ID of current page
                    $thePostID = get_the_ID();

                    // Get the menu object
                    $mainMenu = get_dirrigl_menus_by_location( 'hauptmenue' );
                ?>

                <div class="bg-white shadow-md">

                    <div id="menu" class="flex justify-between items-center max-w-screen-2xl m-auto
                            h-20 lg:h-28 px-4 md:px-6">

                        <a href="<?php echo get_home_url(); ?>">
                            <img src="<?php echo get_template_directory_uri().'/img/dirrigl_und_partner.svg'; ?>" class="h-6 lg:h-7">
                        </a>

                        <ul class="hidden xl:flex space-x-8 font-semibold uppercase text-gray-500">
                            <?php
                            $parentItems = []; // array for pages with children
                            foreach( $mainMenu as $item ) {
                                $link = $item->url;
                                $title = $item->title;
                                $objectID = $item->object_id;
                                $children = get_children($objectID);
                                $slug = get_the_title(pll_get_post($objectID,'de'));
                                $slug = get_post_field( 'post_name', pll_get_post($objectID,'de'));

                                if ($thePostID == $objectID) { // if is current page set class
                                    $activeClass = 'text-dirrigl';
                                } else {
                                    $activeClass = '';
                                }

                                if ($children != null) {
                                    array_push($parentItems, $objectID); // save ids of parent pages
                                }

                                ?>

                                <li class="hover:text-dirrigl focus:text-dirrigl">
                                    <a href="<?php echo $link; ?>"
                                    class="<?php echo $activeClass; ?> <?php echo $slug; ?> flex items-center cursor-pointer group transition duration-100 ease-in-out" 
                                    id="<?php echo $slug; ?>">
                                        <span><?php echo $title; ?></span>
                                        <?php if ($children != null) { ?>
                                            <svg id="<?php echo $slug;?>-arrow" class="text-gray-300 group-hover:text-gray-400 w-4 h-4 ml-2 
                                            transition duration-100 ease-in-out" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        <?php } ?>
                                    </a>
                                </li>

                            <?php } ?>
                        </ul>

                        <div id="menu-toggle" class="xl:hidden text-dirrigl cursor-pointer">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </div>

                    </div>

                </div>

                <!-- ********** / MAIN MENU ********** -->


                <!-- ********** MOBILE MENU ********** -->

                <div id="mobile-menu" class="h-0 overflow-hidden bg-white shadow-lg">
                    <nav class="p-4 space-y-1 text-gray-500 uppercase">
                        <?php foreach( $mainMenu as $item ) {
                            $link = $item->url;
                            $title = $item->title;
                            $objectID = $item->object_id;
                            if ($thePostID == $objectID) { // if is current page set class
                                $activeClass = 'bg-dirrigl text-white hover:text-white focus:text-white';
                            } else {
                                $activeClass = 'bg-white hover:bg-gray-100 hover:text-dirrigl focus:text-dirrigl';
                            } ?>
                            <a href="<?php echo $link; ?>" class="p-3 flex items-center <?php echo $activeClass; ?>">
                                <?php echo $title; ?>
                            </a>
                        <?php } ?>
                    </nav>
                    <div class="p-4">
                        <form class="flex w-full max-w-lg p-3" id="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
                            <input type="text" name="s" id="searchinput" value="<?php echo get_search_query(); ?>"
                                    class="block w-full text-sm bg-white outline-none border-b border-gray-300"
                                    placeholder="<?php pll_e('Suchen'); ?>">
                            <button type="submit" id="searchsubmit"
                                class="-ml-px relative inline-flex items-center space-x-2 px-3 py-1 text-sm font-medium 
                                        text-dirrigl bg-white outline-none focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ********** / MOBILE MENU ********** -->


                <!-- ********** MEGA MENU ********** -->

                <?php
                // ÜBER UNS ***********************************
                $ueberunsMenu = get_dirrigl_menus_by_location( 'ueberuns' );
                $ueberunsPageId = 85; ?>

                <div id="ueber-uns-menu" class="absolute w-full block shadow-2xl overflow-hidden z-50" style="height: 0; opacity: 0;">
                    <div class="bg-dirrigl" style="background: linear-gradient(to left, #ffffff 50%,  rgba(42,67,101,1) 50%);">
                        <div class="grid grid-cols-12 max-w-screen-2xl m-auto">
                            <div class="col-span-full lg:col-span-3 px-4 md:px-6 py-6 md:py-8 lg:py-12 text-white">
                                <h5 class="text-xl font-semibold uppercase pb-3"><?php echo get_the_title(pll_get_post($ueberunsPageId)); ?></h5>
                                <p class=" text-gray-300 text-sm lg:text-base font-normal pb-12"><?php echo get_the_excerpt(pll_get_post($ueberunsPageId)); ?></p>
                                <?php
                                    $featured_image = get_the_post_thumbnail( pll_get_post($ueberunsPageId), 'medium' );
                                    if (!empty($featured_image)) {
                                        echo '<div class="max-w-xs mb-4">'.$featured_image.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="col-span-full lg:col-span-9 bg-white grid grid-cols-1 lg:grid-cols-3 font-medium text-gray-500">
                                <div class="col-span-1 px-4 md:px-6 lg:px-12 py-6 md:py-8 lg:py-12">
                                    <?php foreach( $ueberunsMenu as $item ) { ?>
                                        <a class="block hover:text-dirrigl font-normal hover:bg-gray-50 px-3 py-1 
                                            transition duration-100 ease-in-out" 
                                            href="<?php echo $item->url; ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // BRANCHEN ***********************************
                $branchenMenu = get_dirrigl_menus_by_location( 'branchen' );
                $branchenPageId = 11;
                if (count($branchenMenu) > 12) {
                    $branchenChildrenCols = array_chunk($branchenMenu, 12); // split array in each 12 elements
                } ?>

                <div id="branchen-menu" class="absolute w-full block shadow-2xl overflow-hidden z-50" style="height: 0; opacity: 0;">
                    <div class="bg-dirrigl" style="background: linear-gradient(to left, #ffffff 50%,  rgba(42,67,101,1) 50%);">
                        <div class="grid grid-cols-12 max-w-screen-2xl m-auto">
                            <div class="col-span-full lg:col-span-3 px-4 md:px-6 py-6 md:py-8 lg:py-12 text-white">
                                <h5 class="text-xl font-semibold uppercase pb-3"><?php echo get_the_title(pll_get_post($branchenPageId)); ?></h5>
                                <p class=" text-gray-300 text-sm lg:text-base font-normal pb-12"><?php echo get_the_excerpt(pll_get_post($branchenPageId)); ?></p>
                                <?php
                                    $featured_image = get_the_post_thumbnail( pll_get_post($branchenPageId), 'medium' );
                                    if (!empty($featured_image)) {
                                        echo '<div class="max-w-xs mb-4">'.$featured_image.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="col-span-full lg:col-span-9 bg-white grid grid-cols-1 lg:grid-cols-3 font-medium text-gray-500">
                                <?php for($c=0; $c<3; $c++) { // three columns ?>
                                    <div class="col-span-1 px-4 md:px-6 lg:px-12 py-6 md:py-8 lg:py-12">
                                        <?php foreach ($branchenChildrenCols[$c] as $brancheChild) { ?>
                                            <a class="block hover:text-dirrigl font-normal hover:bg-gray-50 px-3 py-1 
                                                transition duration-100 ease-in-out" 
                                                href="<?php echo get_the_permalink($brancheChild->object_id); ?>">
                                                <?php echo $brancheChild->title; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // LEISTUNGEN ***********************************
                $betrieblichMenu = get_dirrigl_menus_by_location( 'betrieblicherisiken' );
                $betrieblichePageId = 165;
                $mitarbeiterMenu = get_dirrigl_menus_by_location( 'mitarbeiterversorgung' );
                $mitarbeiterPageId = 167;
                $privateMenu = get_dirrigl_menus_by_location( 'privaterisiken' );
                $privatePageId = 169;

                $leistungenPageId = 81; ?>

                <div id="leistungen-menu" class="absolute w-full block shadow-2xl overflow-hidden z-50" style="height: 0; opacity: 0;">
                    <div class="bg-dirrigl" style="background: linear-gradient(to left, #ffffff 50%,  rgba(42,67,101,1) 50%);">
                        <div class="grid grid-cols-12 max-w-screen-2xl m-auto">
                            <div class="col-span-full lg:col-span-3 px-4 md:px-6 py-6 md:py-8 lg:py-12 text-white">
                                <h5 class="text-xl font-semibold uppercase pb-3"><?php echo get_the_title(pll_get_post($leistungenPageId)); ?></h5>
                                <p class=" text-gray-300 text-sm lg:text-base font-normal pb-12"><?php echo get_the_excerpt(pll_get_post($leistungenPageId)); ?></p>
                                <?php
                                    $featured_image = get_the_post_thumbnail( pll_get_post($leistungenPageId), 'medium' );
                                    if (!empty($featured_image)) {
                                        echo '<div class="max-w-xs mb-4">'.$featured_image.'</div>';
                                    }
                                ?>
                            </div>
                            <div class="col-span-full lg:col-span-9 bg-white grid grid-cols-1 lg:grid-cols-3 font-medium text-gray-500">
                                <!-- Betriebliche Risiken -->
                                <div class="col-span-1 px-4 md:px-6 lg:px-12 py-6 md:py-8 lg:py-12">
                                    <a class="block uppercase font-semibold hover:text-dirrigl hover:bg-gray-50 px-3 py-1 
                                        transition duration-100 ease-in-out" 
                                        href="<?php echo get_the_permalink(pll_get_post($betrieblichePageId)); ?>">
                                        <?php echo get_the_title(pll_get_post($betrieblichePageId)); ?>
                                    </a>
                                    <div class="w-full h-1 bg-gray-50 mt-2 mb-4"><!-- space --></div>
                                    <?php foreach( $betrieblichMenu as $item ) { ?>
                                        <a class="block hover:text-dirrigl font-normal hover:bg-gray-50 px-3 py-1 
                                            transition duration-100 ease-in-out" 
                                            href="<?php echo $item->url; ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                                <!-- Mitarbeiterversorgung -->
                                <div class="col-span-1 px-4 md:px-6 lg:px-12 py-6 md:py-8 lg:py-12">
                                    <a class="block uppercase font-semibold hover:text-dirrigl hover:bg-gray-50 px-3 py-1 
                                        transition duration-100 ease-in-out" 
                                        href="<?php echo get_the_permalink(pll_get_post($mitarbeiterPageId)); ?>">
                                        <?php echo get_the_title(pll_get_post($mitarbeiterPageId)); ?>
                                    </a>
                                    <div class="w-full h-1 bg-gray-50 mt-2 mb-4"><!-- space --></div>
                                    <?php foreach( $mitarbeiterMenu as $item ) { ?>
                                        <a class="block hover:text-dirrigl font-normal hover:bg-gray-50 px-3 py-1 
                                            transition duration-100 ease-in-out" 
                                            href="<?php echo $item->url; ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                                <!-- Private Risiken -->
                                <div class="col-span-1 px-4 md:px-6 lg:px-12 py-6 md:py-8 lg:py-12">
                                    <a class="block uppercase font-semibold hover:text-dirrigl hover:bg-gray-50 px-3 py-1 
                                        transition duration-100 ease-in-out" 
                                        href="<?php echo get_the_permalink(pll_get_post($privatePageId)); ?>">
                                        <?php echo get_the_title(pll_get_post($privatePageId)); ?>
                                    </a>
                                    <div class="w-full h-1 bg-gray-50 mt-2 mb-4"><!-- space --></div>
                                    <?php foreach( $privateMenu as $item ) { ?>
                                        <a class="block hover:text-dirrigl font-normal hover:bg-gray-50 px-3 py-1 
                                            transition duration-100 ease-in-out" 
                                            href="<?php echo $item->url; ?>">
                                            <?php echo $item->title; ?>
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> <!-- ********** / TOP ********** -->

        </header>

        <!-- CONTENT -->
        <div id="content" class="w-full h-auto relative">