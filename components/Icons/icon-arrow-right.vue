<template>
    <svg 
        class="icon-arrow-right"
        xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
    >
        <path d="M10 7L15 12L10 17" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</template>

<script>
    export default {
        name: 'icon-arrow-right',
        props: {
            componentName: {
                type: String,
                default: 'icon-arrow-right'
            },
        },

    }
</script>