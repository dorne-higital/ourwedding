<template>
    <section :class="[componentName]">
        <div class="hero-banner">
            <div class="hero-content">
                <p class="description-header">{{ content.label }}</p>
                <h1>{{ content.heading }}</h1>
            </div>

            <div class="img-container">
                <img 
                    :src="content.image.src" 
                    :alt="content.image.alt">
            </div>
        </div>
    </section>
</template>
  

<script>
    export default {
        name: 'pageHero',
        props: {
            componentName: {
                type: String,
                default: 'page-hero'
            },
            content: {
                default: () => ({
                    "theme": "dark",
                    "align": "centre",
                    "label": "section label",
                    "heading": "section heading secondary",
                    "image": {
                        "src": "emma_dan_walk_dist.jpg",
                        "alt": "Image depicting the page header"
                    }
                }),
                type: Object
            }
        }
    }
</script>

<style lang="scss" scoped>
@import "~/assets/css/main.scss";

.page-hero {
    height: 40dvh;
    position: relative;
    width: 100%;

    @media only screen and (max-width: 600px) {
        height: 50vh;
    }

    .hero-banner {
        height: 100%;
        position: relative;
        width: 100%;

        .img-container {
            // background-color: $color-3;
            height: 100%;
            overflow: hidden;
            position: relative;
            width: 100%;

            &::before {
                content: "";
                background: rgba(0, 0, 0, 0.3);
                clip-path: polygon(100% 0, 100% 90%, 50% 100%, 0 90%, 0 0);
                height: 100%;
                left: 0;
                position: absolute;
                top: 0;
                width: 100%;
                z-index: 1;

                @media only screen and (max-width: 600px) {
                    clip-path: polygon(100% 0, 100% 95%, 50% 100%, 0 95%, 0 0);
                }
            }

            img {
                clip-path: polygon(100% 0, 100% 90%, 50% 100%, 0 90%, 0 0);
                height: 100%;
                object-fit: cover;
                width: 100%;

                @media only screen and (max-width: 600px) {
                    clip-path: polygon(100% 0, 100% 95%, 50% 100%, 0 95%, 0 0);
                }
            }
        }

        .hero-content {
            align-items: center;
            color: $primary-color;
            display: flex;
            flex-direction: column;
            justify-content: center;
            left: 50%;
            padding: 2rem;
            position: absolute;
            text-align: center;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            z-index: 2;

            .description-header {
                border-bottom: 1px solid $secondary-color;
                color: $secondary-color;
                font-weight: 500;
                margin-bottom: 1rem;
            }

            h1 {
                color: $secondary-color;
                margin-bottom: 1rem;
            }

            .button {
                background-color: $secondary-color;
                border: 2px solid transparent;
                color: $color-1;
                cursor: pointer;
                font-size: 1rem;
                font-weight: 500;
                padding: .75rem 2.25rem;
                transition: .2s;

                &:hover {
                    border: 2px solid $secondary-color;
                    transition: .3s;
                }
            }
        }
    }
}
</style>
