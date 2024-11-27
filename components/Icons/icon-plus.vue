<template>
    <svg 
        class="icon-plus"
        xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
    >
        <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</template>

<script>
    export default {
        name: 'icon-plus',
        props: {
            componentName: {
                type: String,
                default: 'icon-plus'
            },
        },

    }
</script>