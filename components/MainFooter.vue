<template>
    <section class="footer_section">
        <div v-if="isMobile" class="logo_container">
            <h2>Emma & Dan</h2>
        </div>
        
        <div class="company_info">
            <h5 @click="toggleSection('companyInfo')">
                Where we tie the knot 
                <span v-if="isMobile">
                    <icon-plus v-if="!isSectionOpen('companyInfo')" />
                    <icon-minus v-else />
                </span>
            </h5>
            <div :class="{ active: isSectionOpen('companyInfo') }">
                <p>Broadoaks Country House Hotel</p>
                <p>Bridge Ln</p>
                <p>Windermere</p>
                <p>LA23 1LA</p>
            </div>
        </div>

        <div class="quick_links">
            <h5 @click="toggleSection('quickLinks')">
                Useful Links
                <span v-if="isMobile">
                    <icon-plus v-if="!isSectionOpen('quickLinks')" />
                    <icon-minus v-else />
                </span>
            </h5>
            <div :class="{ active: isSectionOpen('quickLinks') }">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/upload">Upload</a>
                    </li>
                    <li>
                        <a href="/gallery">Gallery</a>
                    </li>
                    <li>
                        <a href="/rsvp">RSVP</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="contact_info">
            <h5 @click="toggleSection('contactInfo')">
                Still to decide?
                <span v-if="isMobile">
                    <icon-plus v-if="!isSectionOpen('contactInfo')" />
                    <icon-minus v-else />
                </span>
            </h5>
            <div :class="{ active: isSectionOpen('contactInfo') }">
                <ul class="hours">
                    <li>
						<p>The date to RSVP has now passed.</p>
                    </li>
                    <br />
					<li>
						<p>If you have an invite and would like to attend, please speak one of us, and we will try to accomodate you.</p>
					</li>
                </ul>
            </div>
        </div>

        <div class="legal_info">
            <p>Copyright &copy; Emma & Dan 2024</p>
        </div>
    </section>
</template>

<script>
import iconPlus from '~/components/Icons/icon-plus.vue';
import iconMinus from '~/components/Icons/icon-minus.vue';

export default {
    name: 'mainFooter',
    components: {
        iconPlus,
        iconMinus,
    },
    data() {
        return {
            openSection: null,
            isMobile: false
        };
    },
    mounted() {
        this.checkScreenSize();
        window.addEventListener('resize', this.checkScreenSize);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.checkScreenSize);
    },
    methods: {
        toggleSection(section) {
            this.openSection = this.openSection === section ? null : section;
        },
        isSectionOpen(section) {
            return this.openSection === section;
        },
        checkScreenSize() {
            this.isMobile = window.innerWidth <= 600;
        }
    }
}
</script>

<style lang="scss" scoped>
    @import "~/assets/css/main.scss";
    
    .footer_section {
        background-color: $bg-secondary;
        color: $secondary-color;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 5rem;
        justify-content: center;
        padding: 4rem 10rem;
        width: 100vw;
        z-index: 99;

        .logo_container {
            text-align: center;
            width: 100%;

            img {
                max-width: 40%;
            }
        }

        h5 {
            border-bottom: 1px solid $primary-color;
            color: $color-2;
            cursor: pointer;
            font-family: $secondary-font;
            font-size: 1rem;
            font-weight: 600;
            padding: .5rem 0;
            text-transform: uppercase;
            width: fit-content;

            @media only screen and (max-width: 600px) {
                align-items: center;
                background: #474747;
                border-bottom: 1px solid #7f7f7f;
                display: flex;
                justify-content: space-between;
                margin: 0;
                padding: .5rem;
                width: 100%;
            }
        }

        @media only screen and (max-width: 600px) {
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;

            .company_info, .quick_links, .contact_info {
                > div {
                    display: none;

                    &.active {
                        background: #474747;
                        display: block;
                        padding: .5rem;
                    }
                }
            }
        }

        .company_info {
			border-right: 1px solid $secondary-color;
            flex: 1;

			@media only screen and (max-width: 600px) {
				border-right: none;
			}

            p {
                margin-bottom: .5rem;

                a {
                    color: $secondary-color;
                    font-weight: 300;
                    padding: .5rem 0 .2rem;

                    &:hover {
                        border-bottom: 1px solid $primary-color;
                    }
                }
            }
        }

        .quick_links {
			border-right: 1px solid $secondary-color;
            flex: 1;

			@media only screen and (max-width: 600px) {
				border-right: none;
			}

            ul {
                @media only screen and (max-width: 600px) {
                    display: flex;
                    flex-wrap: wrap;

                    li {
                        width: 50%;

                        a {
                            font-weight: 300;
                            padding: .5rem 0 .2rem;

                            &:hover {
                                border-bottom: 1px solid $primary-color;
                            }
                        }
                    }
                }

                li a {
                    color: $secondary-color;

                    &:hover {
                        border-bottom: 1px solid $secondary-color;
                    }
                }
            }

            li {
                padding: .5rem 0;

                a {
                    font-weight: 400;
                }
            }
        }

        .contact_info {
            flex: 1;

            .hours {
                li {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;

                    p {
                        margin-bottom: .2rem;
                    }
                }
            }
        }

        .legal_info {
            border-top: 1px solid;
            padding: 2rem;
            text-align: center;
            width: 100%;

            ul {
                display: flex;
                flex-direction: row;
                gap: 2rem;
                justify-content: center;
                padding-bottom: 1rem;
            }
        }
    }
</style>
