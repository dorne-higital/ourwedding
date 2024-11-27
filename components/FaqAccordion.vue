<template>
    <section
        :class="[
            componentName,
            'theme-' + content.theme,
            'order-' + content.order
        ]"
    >
        <div class="content-container">
            <p 
                v-if="content?.label?.length" 
                class="description-header"
            >
                {{ content.label }}
            </p>

            <h1 v-if="content?.heading?.length">
                {{ content.heading }}
            </h1>

            <ul class="faq-list">
                <li 
                    v-for="(item, index) in content.faqs" 
                    :key="index" 
                    class="faq-item"
                >
                    <button 
                        class="faq-question"
                        @click="toggleFaq(index)"
                    >
                        {{ item.question }}
                        <span :class="['arrow', { 'expanded': isActive(index) }]"></span>
                    </button>
                    <div 
                        v-if="isActive(index)" 
                        class="faq-answer"
                    >
                        {{ item.answer }}
                    </div>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    name: 'faqAccordion',
    props: {
        componentName: {
            type: String,
            default: 'faq-accordion'
        },
        content: {
            default: () => ({
                theme: "light",
                order: "text-only",
                label: "FAQ Section",
                heading: "Frequently Asked Questions",
                faqs: [
                    { 
                        question: "What is your return policy?", 
                        answer: "We offer a 30-day return policy with a full refund."
                    },
                    { 
                        question: "Do you provide technical support?", 
                        answer: "Yes, we provide 24/7 customer support."
                    }
                ]
            }),
            type: Object
        }
    },
    data() {
        return {
            activeFaq: null
        };
    },
    methods: {
        toggleFaq(index) {
            this.activeFaq = this.activeFaq === index ? null : index;
        },
        isActive(index) {
            return this.activeFaq === index;
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~/assets/css/main.scss";

.faq-accordion {
    display: flex;
    flex-direction: column;
    padding: 3rem 2rem;
    text-align: center;
    width: 100%;

    @media only screen and (max-width: 600px) {
        padding: 3rem 0;
    }

    &.theme-light {
        background-color: $bg-primary;
        color: $primary-color;
    }

    &.theme-dark {
        background-color: $bg-secondary;
        color: $secondary-color;

        .faq-question,
        .faq-answer {
            color: $primary-color !important;
        }
    }

    .content-container {
        padding: 1rem 2rem;
    }

    .faq-list {
        list-style: none;
        margin: 0;
        padding: 0;

        .faq-item {
            margin-bottom: 1.5rem;

            .faq-question {
                background: $color-4;
                border: none;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                font-size: 1.2rem;
                padding: 1rem;
                width: 100%;

                &:hover {
                    background-color: #e8e8e8;
                    color: $primary-color;
                }

                .arrow {
                    border: solid currentColor;
                    border-width: 0 2px 2px 0;
                    display: inline-block;
                    margin-left: 1rem;
                    margin-top: .5rem;
                    padding: 0.2rem;
                    transform: rotate(45deg);
                    transition: transform 0.3s;

                    &.expanded {
                        margin-top: 1rem;
                        transform: rotate(-135deg);
                    }
                }
            }

            .faq-answer {
                background-color: $color-4;
                border-top: 2px solid #cac6c6;
                font-size: 1rem;
                padding: 1.5rem 1rem;
                color: $primary-color;
                text-align: left;
                width: 100%;
            }
        }
    }
}
</style>
