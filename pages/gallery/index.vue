<template>
	<div>
		<PageHero
			:content='{
				"theme": "dark",
				"align": "centre",
				"label": "Look at us",
				"heading": "Gallery",
				"image": {
					"src": imageSrc,
					"alt": "Header image of some of our work"
				}
			}'
		/>

		<ImageGallery />
	</div>
</template>

<script>
	import ImageGallery from '~/components/ImageGallery.vue';
	import PageHero from '~/components/PageHero.vue';
	import imageSrc from '~/assets/images/emma_dan_walk_close.jpg';

	export default {
		components: {
			ImageGallery,
			PageHero
		},
		data() {
			return {
				imageSrc
			}
		}
	};
</script>

<style>
/* Add your styles here */
</style>
