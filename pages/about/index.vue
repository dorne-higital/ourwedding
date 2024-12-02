<template>
	<div>
		<PageHero
			:content='{
				"theme": "dark",
				"align": "centre",
				"label": "Who we are",
				"heading": "Get to know the Bride & Groom",
				"image": {
					"src": imageSrc,
					"alt": "Header image of some of our work"
				}
			}'
		/>
	</div>
</template>

<script>
	import PageHero from '~/components/PageHero.vue';
	import imageSrc from '~/assets/images/emma_dan_walk_close.webp';

	export default {
		components: {
			PageHero
		},
		data() {
			return {
				imageSrc
			}
		}
	};
</script>
