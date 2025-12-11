<?php
/**
 * Footer
 *
 * @package kreativwirtschaft
 *
 */
?>

    </div> <!-- / CONTENT -->

    <!-- ********** BOTTOMBAR ********** -->

    <?php
        $footerMenu = get_dirrigl_menus_by_location( 'footer' );
    ?>

    <div id="bottombar" class="bg-white">

        <div class="flex justify-between items-center max-w-screen-2xl m-auto px-4 md:px-6 py-3 text-dirrigl">

            <div class="text-sm font-semibold flex space-x-4 md:space-x-6">
                <?php foreach( $footerMenu as $footerItem ) { ?>
                    <?php
                        $link = $footerItem->url;
                        $title = $footerItem->title;
                    ?>
                    <a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                <?php } ?>
            </div>

            <div class="flex items-center">
                <ul id="language_switcher"
                    class="text-sm font-semibold">
                    <?php pll_the_languages(array('hide_current' => 1));?>
                </ul>
            </div>

        </div>

    </div>

    <!-- ********** / TOPBAR ********** -->

</div> <!-- ********** / PAGE ********** -->

<?php wp_footer(); ?>

</body>
</html>