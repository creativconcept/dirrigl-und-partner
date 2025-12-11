<?php
/**
 *
 * @package dirrigl
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="max-w-screen-md m-auto text-center px-6 py-12 lg:py-24">
			<h2 class="uppercase text-xl lg:text-3xl font-semibold lg:font-normal text-dirrigl mb-6 xl:mb-9">
				<?php pll_e('Suchergebnisse'); ?>
			</h2>
			<form class="flex w-full max-w-md m-auto" id="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
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

		<div class="max-w-screen-2xl m-auto px-6 pb-12 lg:pb-24">
				<?php if ( have_posts() ) : ?>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4 lg:gap-8 w-full bg-white">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post(); ?>
								<a href="<?php echo get_the_permalink(); ?>" class="px-6 xl:px-12 py-8 lg:py-14 border border-gray-200 shadow-xl">
									<h3 class="text-dirrigl text-lg xl:text-xl font-semibold lg:font-normal mb-2 lg:mb-9">
										<?php echo get_the_title(); ?>
									</h3>
									<p class="text-gray-600 text-sm lg:text-base">
										<?php if (get_the_excerpt()) {
											echo get_the_excerpt();
										} else {
											pll_e('Hier klicken um mehr zu erfahren.');;
										} ?>
									</p>
								</a>
						<?php endwhile; ?>
					</div>
				<?php else : ?>
					<div class="w-full max-w-md m-auto text-center">
						<h3 class="text-dirrigl text-lg xl:text-xl font-semibold lg:font-normal mb-2 lg:mb-6">
							<?php pll_e('Leider wurde nichts gefunden'); ?>
						</h3>
						<p class="text-gray-600 text-sm lg:text-base">
							<?php pll_e('Bitte versuchen Sie es mit einem anderen Suchbegriff oder nehmen Sie Kontakt auf.'); ?>
						</p>
					</div>
				<?php endif;
				?>
		</div>

		<script>
			(function ($) {
				var bluetop = document.getElementById('topbar');
				var menu = document.getElementById('menu');
				var headerHeight = bluetop.offsetHeight + menu.offsetHeight;
				var content = document.getElementById('content');
				content.style.paddingTop = headerHeight + 'px';
			}(jQuery));
		</script>

	</main><!-- #main -->

<?php
get_footer();
