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

		<TextImageSplit 
			:content='{
				"theme": "light",
				"order": "image-text",
				"label": "",
				"heading": "A match made in heaven",
				"subheading": "",
				"description": "All it took was a match on everyones favourite dating app, Tinder, for our story to begin. Once matched, a story about how Dan was a TV star from Sun, Sea and A&E peaked Emmas interest enough for her to accept a date.",
				"button": {
					"text": "",
					"url": ""
				},
				"image": {
					"src": imageSrc,
					"alt": ""
				}
			}'
		/>

		<Text1Col 
			:content='{
				"theme": "color-2",
				"align": "centre",
				"heading": "Our first date",
				"description": "Meeting during covid, our dating was limited to where we could go. We decided to share our passion for walking, and take Dans over excitable dog, for a walk to Rivington Pike.",
			}'
		/>

		<TextImageSplit 
			:content='{
				"theme": "light",
				"order": "text-image",
				"label": "",
				"heading": "Officially official",
				"subheading": "",
				"description": "After a brief 6 months of dating, Dan decided to step up and ask the ultimate question, and asked Emma to be his girlfriend. Which, with a massive sigh of relief, she replied with `finally`. One Christmas, Emma left Dan a small surprise in his stocking, which was a happy sight to be seen. Emma decided that she was ready to give him a key to her house. After a few months, Thomas (the cat), gave the green light to allow Dan to stay full time. By the summer of 2022, Dan sold everything he owned, packed his clothes and moved in with Emma and Thomas, with Odin following not too far behind.",
				"button": {
					"text": "",
					"url": ""
				},
				"image": {
					"src": imageSrc,
					"alt": ""
				}
			}'
		/>

		<Text1Col 
			:content='{
				"theme": "color-1",
				"align": "centre",
				"heading": "Time to take a knee",
				"description": "By Winter, Dan began his hunt for the perfect ring. Luckily, he had plenty of inspiration to what Emma liked, based off the million hints she had sent him. After asking and receiving her fathers blessing, Dan began to think how he would go about asking Emma. Dan took Emma back to where they first walked, driving up to Rivington on a clear night to `see the stars`. He put some music on in the car and asked Emma to join him outside. He then proceeded to nervously ask the question which, in his head, he already knew the answer too. Thankfully, Dan read the hints correctly, and Emma joyously said yes.",
			}'
		/>
	</div>
</template>

<script>
	import PageHero from '~/components/PageHero.vue';
	import TextImageSplit from '~/components/TextImageSplit.vue';
	import imageSrc from '~/assets/images/emma_dan_walk_close.webp';

	export default {
		components: {
			PageHero,
			TextImageSplit
		},
		data() {
			return {
				imageSrc
			}
		}
	};
</script>
