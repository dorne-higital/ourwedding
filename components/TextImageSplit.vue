<template>
    <section
        :class="[
            componentName,
            'theme-' + content.theme,
            'order-' + content.order,
        ]"
    >
        <div class="content-container">
            <p 
                v-if="content?.description?.length" 
                class="description-header"
            >
                {{ content.label }}
            </p>

            <h1 v-if="content?.heading?.length">
                {{ content.heading }}
            </h1>

            <h4 v-if="content?.subheading?.length">
                {{ content.subheading }}
            </h4>

            <p v-if="content?.description?.length">
                {{ content.description }}
            </p>

            <a 
                v-if="content?.button?.text?.length" 
                :href="content.button.url"
            >
                {{ content.button.text }}
            </a>
        </div>

        <div class="img-container">
            <img 
                :src="content.image.src" 
                :alt="content.image.alt"
            >
        </div>
    </section>
</template>
  
<script>
    export default {
        name: 'textImageSplit',
        props: {
            componentName: {
                type: String,
                default: 'text-image-split'
            },
            content: {
                default: () => ({
                    theme: "dark",
                    order: "image-text",
                    label: "section label",
                    heading: "section heading secondary",
                    subheading: "optional section subheading",
                    description: "optional descriptive text",
                    button: {
                        text: "Read more",
                        url: "/"
                    },
                    image: {
                        src: "",
                        alt: ""
                    }
                }),
                type: Object
            }
        }
    }
</script>
  
<style lang="scss" scoped>
    @import "~/assets/css/main.scss";

    .text-image-split {
        display: flex;
        flex-direction: row;
        gap: 2rem;
        padding: 5rem 2rem;
        width: 100%;

        @media only screen and (max-width: 600px) {
            flex-direction: column-reverse;
            padding: 3rem 0;
        }

        //////////////////
        // Theme styles //
        //////////////////

        &.theme-dark {
            background-color: $bg-secondary;
            color: $secondary-color;
        }

        &.theme-color-1 {
            background-color: $color-1;
            color: $primary-color;
        }

        &.theme-color-2 {
            background-color: $color-2;
            color: $secondary-color;
        }

        //////////////////
        // Order styles //
        //////////////////

        &.order-image-text {
            flex-direction: row-reverse;

            @media only screen and (max-width: 600px) {
                flex-direction: column;
            }
        }

        &.order-text-image {
            flex-direction: row;

            @media only screen and (max-width: 600px) {
                flex-direction: column;
            }
        }

        .content-container {
            flex: 1;
            padding: 1rem 2rem;
            width: 50%;

            @media only screen and (max-width: 600px) {
                padding: 0 1rem;
                width: 100%;
            }
        }

        .img-container {
            flex: 1;
            width: 50%;

            @media only screen and (max-width: 600px) {
                width: 100%;
            }

            img {
                max-height: 30rem;
                object-fit: cover;
                width: 100%;
            }
        }
    }
</style>
  