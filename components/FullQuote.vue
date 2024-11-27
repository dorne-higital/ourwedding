<template>
    <section
        :class="[
            componentName,
            'theme-' + content.theme,
            'align-' + content.align,
        ]"
    >
		<h2
			v-if="content?.heading?.length"
			class="heading"
		>
			{{ content.heading }}

			<span>{{ content.hightlight }}</span>
		</h2>
    </section>
</template>

<script>
    export default {
        name: 'fullQuote',
        props: {
            componentName: {
                type: String,
                default: 'full-quote'
            },
            content: {
                default: () => ({
                    "theme": "dark",
                    "align": "centre",
                    "heading": "section heading",
                    "hightlight": "section heading highlight",
                }),
                type: Object
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "~/assets/css/main.scss";

    .full-quote {
        display: flex;
        flex-direction: row;
        gap: 2rem;
        padding: 2rem 4rem;
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

		h2 {
			color: $color-4;
			font-family: $secondary-font;
			font-weight: 900;
			line-height: 3rem;
			text-align: justify;
			text-transform: uppercase;

			span {
				color: $color-1;
			}
		}
    }
</style>