<template>
	<div>
		<HeroMain />

		<FullQuote 
			:content='{
				"theme": "light",
				"align": "centre",
				"heading": "Id climb every mountain And swim every ocean Just to be with you And fix what Ive broken Oh, cause I need you to see That ",
				"hightlight": "You are the reason"

			}'
		/>
	</div>
</template>

<script>
	import HeroMain from '~/components/HeroMain.vue';
	import FullQuote from '~/components/FullQuote.vue';

	export default {
		components: {
			HeroMain,
			FullQuote
		}
	};
</script>

<style>
/* Add your styles here */
</style>
