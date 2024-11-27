<template>
	<div>
		<PageHero
			:content='{
				"theme": "dark",
				"align": "centre",
				"label": "Grab your phone",
				"heading": "Upload for us all to see",
				"image": {
					"src": imageSrc,
					"alt": "Header image of some of our work"
				}
			}'
		/>

		<ImageUploader />
	</div>
</template>

<script>
	import ImageUploader from '~/components/ImageUploader.vue';
	import PageHero from '~/components/PageHero.vue';
	import imageSrc from '~/assets/images/emma_dan_walk_close.jpg';

	export default {
		components: {
			ImageUploader,
			PageHero,
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
