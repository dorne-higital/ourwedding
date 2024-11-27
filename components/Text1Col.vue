<template>
    <section
        :class="[
            componentName,
            'theme-' + content.theme,
            'align-' + content.align,
        ]"
    >
        <div class="content-container">
            <p 
                v-if="content?.description?.length"
                class="description-header"
            >
                {{ content.label }}
            </p>

            <h1
                v-if="content?.heading?.length"
                class="heading"
            >
                {{ content.heading }}
            </h1>

            <h4
                v-if="content?.subheading?.length"
                class="subheading"
            >
                {{ content.subheading }}
            </h4>

            <p
                v-if="content?.description?.length"
                class="description"
            >
                {{ content.description }}
            </p>

            <nuxt-link
                v-if="content?.button?.text?.length"
                :to="content?.button?.url"
                class="button"
            >
                {{ content.button.text }}
            </nuxt-link>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'text1Col',
        props: {
            componentName: {
                type: String,
                default: 'text-1-col'
            },
            content: {
                default: () => ({
                    "theme": "dark",
                    "align": "centre",
                    "label": "section label",
                    "heading": "section heading secondary",
                    "subheading": "optional section subheading",
                    "description": "optional desciptive text",
                    "button": {
                        "text": "Read more",
                        "url": "/"
                    },
                }),
                type: Object
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "~/assets/css/main.scss";

    .text-1-col {
        display: flex;
        flex-direction: row;
        gap: 2rem;
        padding: 2rem;
        width: 100%;

        @media only screen and (max-width: 600px) {
            padding: 1rem;
        }

        //////////////////
        // Theme styles //
        //////////////////
        
        &.theme-dark {
            background-color: $bg-secondary;
            color: $secondary-color;

            .content-container .button {
                background-color: $bg-primary;
                border: 2px solid $bg-primary;
                color: $primary-color;

                &:hover {
                    color: $secondary-color;
                }
            }
        }

        &.theme-color-1 {
            background-color: $color-1;
            color: $primary-color;
        }

        &.theme-color-2 {
            background-color: $color-2;
            color: $secondary-color;

            .content-container .button {
                background-color: $bg-primary;
                border: 2px solid $bg-primary;
                color: $primary-color;

                &:hover {
                    color: $secondary-color;
                }
            }
        }

        &.theme-color-3 {
            background-color: $color-3;
            color: $primary-color;

            .content-container .button {
                background-color: $bg-primary;
                border: 2px solid $bg-primary;
                color: $primary-color;

                &:hover {
                    color: $secondary-color;
                }
            }
        }

        //////////////////
        // Align styles //
        //////////////////
    
        &.align-left {
            .content-container {
                align-items: flex-start;
                text-align: left;
            }
        }
    
        &.align-centre {
            .content-container {
                align-items: center;
                text-align: center;
            }
        }
        
        &.align-right {
            .content-container {
                align-items: flex-end;
                text-align: right;
            }
        }

        .content-container {
            align-items: center;
            display: flex;
            flex-direction: column;
            padding: 1rem 2rem;
            width: 100%;

            @media only screen and (max-width: 600px) {
                padding: 1rem 0;
            }

            .button {
                background-color: $bg-secondary;
                border: 2px solid $bg-secondary;
                color: $secondary-color;
                margin-top: 1rem;
                padding: .5rem 1.5rem;
                transition: .3s;
                width: fit-content;

                &:hover {
                    background-color: transparent;
                    color: $primary-color;
                    transition: .3s;
                }
            }
        }
    }
</style>