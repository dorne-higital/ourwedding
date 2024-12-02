<template>
	<div>
		<PageHero
			:content='{
				"theme": "dark",
				"align": "centre",
				"label": "Let us know either way",
				"heading": "RSVP",
				"image": {
					"src": imageSrc,
					"alt": "Header image of some of our work"
				}
			}'
		/>

		<Text1Col 
			:content='{
				"theme": "light",
				"align": "centre",
				"label": "Uh oh",
				"heading": "RSVP has ended",
				"description": "As the date to RSVP has now passed, we can no longer accept any more online responses. However, if you do have an invite and would still like to attend, please speak to either Emma or Dan, and we will see what we can do to accomodate you.",
			}'
		/>

		<FaqAccordion 
			:content='{
				"theme": "dark",
				"label": "FAQs",
				"heading": "Frequently asked Questions",
				"faqs": [
					{
						"question": "What if I dont RSVP?",
						"answer": "To help us plan accordingly, we ask that you RSVP no later than the date specified on your invitation. If we do not receive your RSVP by the set date, we will have to mark you as `Not Attending`. If you are having any issues RSVP`ing, please reach out on the number provided on the invite and we can help.",
					},
					{
						"question": "Can I bring a plus one?",
						"answer": "Our wedding is invitation only. If you have a plus one specified on your invitation, then you are welcome to bring a plus one. Unfortunately, we can not accomodate other extra guests due to venue capacity.",
					},
					{
						"question": "When should I arrive?",
						"answer": "We recommend arriving 15-20 minutes before the start of the ceremony. If late, we kindly ask you wait in the music room or bar area to minimise any disruption to the ceremony. If arriving for the evening, please arrive promptly for 18:00.",
					},
					{
						"question": "Do you have a registry? Can I bring a gift?",
						"answer": "You being with us to celebrate is enough, no gift is needed. However, should you wish to bring something, a contribution to our honeymoon would be greatly appreciated.",
					},
					{
						"question": "Are children invited?",
						"answer": "As much as we would love to accomodate your little ones, we have limited space at our venue. We have decided to keep children to strictly family, unless previously confirmed with the bride or groom.",
					},
					{
						"question": "Are there any colours I should avoid wearing?",
						"answer": "Please refrain from wearing colours traditionally reserved for the bride. These include white, ivory or cream.",
					},
				],
			}'
		/>

		<Text1Col 
			:content='{
				"theme": "light",
				"align": "centre",
				"description": "We cant wait to celebrate this special day!",
			}'
		/>
	</div>
</template>

<script>
	import PageHero from '~/components/PageHero.vue';
	import Text1Col from '~/components/Text1Col.vue';
	import FaqAccordion from '~/components/FaqAccordion.vue';
	import imageSrc from '~/assets/images/emma_dan_sat_tree.webp';

	export default {
		components: {
			PageHero,
			FaqAccordion,
			Text1Col,
		},
		data() {
			return {
				imageSrc
			}
		}
	};
</script>
