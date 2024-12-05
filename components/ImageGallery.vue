<template>
	<div :class="[componentName]">

		<div 
			v-if="images?.length < 1"
			class="gallery-message"
		>
			<h2>Oops, looks like no images have been uploaded!</h2>

			<p>Use the below to upload your pictures</p>
			
			<nuxt-link
				to="/upload"
				title="Go to the image upload page"
			>
				Upload images
			</nuxt-link>
		</div>

		<div class="gallery">
			<div 
				v-for="(image, index) in images" 
				:key="image.id" 
				class="image-container" 
				@click="openModal(index)"
			>
				<img :src="image.url" :alt="image.name" />
			</div>
		</div>

		<div
			v-if="isModalOpen" 
			class="modal" 
			@click="closeModal"
		>
			<span
				class="close" 
				@click.stop="closeModal"
			>
				X
			</span>

			<div class="modal-content" @click.stop>
				<span class="arrow left" @click="prevImage">&#10094;</span>
				<span class="arrow right" @click="nextImage">&#10095;</span>
				
				<img :src="modalImageUrl" />
			</div>
		</div>
	</div>
</template>

<script>
	import { firestore } from "~/plugins/firebaseConfig";

	export default {
        name: 'imageGallery',
        props: {
            componentName: {
                type: String,
                default: 'image-gallery'
            },
        },
		data() {
			return {
				images: [],
				isModalOpen: false,
				modalImageUrl: "",
				currentImageIndex: 0,
			};
		},
		mounted() {
			this.fetchImages();
		},
		methods: {
			fetchImages() {
				firestore.collection('images').orderBy('createdAt', 'desc').onSnapshot(snapshot => {
					this.images = snapshot.docs.map(doc => ({
						id: doc.id,
						...doc.data()
					}));
				});
			},
			openModal(index) {
				this.currentImageIndex = index;
				this.modalImageUrl = this.images[index].url;
				this.isModalOpen = true;
			},
			closeModal() {
				this.isModalOpen = false;
				this.modalImageUrl = "";
			},
			// Navigate to the previous image
			prevImage() {
				this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
				this.modalImageUrl = this.images[this.currentImageIndex].url;
			},
			// Navigate to the next image
			nextImage() {
				this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
				this.modalImageUrl = this.images[this.currentImageIndex].url;
			}
		},
		computed: {
			startIndex() {
				// Get the starting index for the visible thumbnails
				return (this.currentImageIndex - 2 + this.images.length) % this.images.length;
			},
			nextImages() {
				const nextImagesArray = [];

				for (let i = 1; i <= 5; i++) {
					nextImagesArray.push(this.images[(this.currentImageIndex + i) % this.images.length]);
				}

				return nextImagesArray;
			}
		}
	};
</script>

<style lang="scss" scoped>
@import "~/assets/css/main.scss";

.image-gallery {
	z-index: 99;

	.gallery-message {
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		gap: .5rem;
		padding: 2rem;
		text-align: center;

		a {
			padding: 1rem 2rem;
			background-color: #2758bd;
			color: #fff;
			border: none;
			border-radius: .5rem;
			cursor: pointer;
			transition: background-color 0.3s;
			width: 100%;

			&:hover {
				background-color: #2758bd;
			}
		}
	}

	.gallery {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		gap: .5rem; 
		padding: 1rem;
		width: 100%;

		.image-container {
			aspect-ratio: 3 / 2;
			overflow: hidden;
			position: relative;
			width: 100%;

			img {
				height: 100%;
				object-fit: cover;
				width: 100%;
			}
		}
	}

	.modal {
		align-items: center;
		background-color: $bg-secondary;
		display: flex;
		height: 100dvh;
		justify-content: center;
		left: 0;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 999;

		.close {
			align-items: center;
			background: white;
			border-radius: 100px;
			color: black;
			cursor: pointer;
			display: flex;
			font-size: 1.5rem;
			height: 2rem;
			justify-content: center;
			position: absolute;
			right: 1rem;
			top: 1rem;
			width: 2rem;
			z-index: 9999;
		}

		.modal-content {
			align-items: center;
			background-color: transparent;
			border-radius: .5rem;
			display: flex;
			height: 80dvh;
			justify-content: center;
			padding: 2rem 1rem;
			position: relative;
			text-align: center;

			img {
				border-radius: .5rem;
				max-width: 100vw;
				object-fit: contain;
				width: 100%;
			}

			.arrow {
				align-items: center;
				background-color: #ffffffdd;
				border: 1px solid white;
				border-radius: .5rem;
				bottom: calc(50% - 2rem);
				color: $color-2;
				cursor: pointer;
				display: flex;
				font-size: 2rem;
				height: 4rem;
				justify-content: center;
				padding: .5rem;
				position: absolute;
				user-select: none;

				&.left {
					left: 1rem;
				}

				&.right {
					right: 1rem;
				}
			}
		}

	}
}

</style>
