<template>
	<div>
		<MainNav />
		<Nuxt />
		<MainFooter />
	</div>
</template>
  
<script>
import MainNav from '~/components/MainNav.vue';
import MainFooter from '~/components/MainFooter.vue';

export default {
  components: {
	MainNav,
	MainFooter
  }
};
</script>