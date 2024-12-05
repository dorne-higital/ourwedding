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

		<div v-if="isModalOpen" class="modal" @click="closeModal">
			<span
				class="close" 
				@click.stop="closeModal"
			>
				&times;
			</span>
			<div class="modal-content" @click.stop>
				<!-- Arrows at the top-right -->
				<span class="arrow left" @click="prevImage">&#10094;</span>
				<span class="arrow right" @click="nextImage">&#10095;</span>
				
				<img :src="modalImageUrl" />

				<!-- Thumbnails at the bottom -->
				<!-- <div class="thumbnails">
					<div 
						v-for="(image, index) in visibleThumbnails" 
						:key="index" 
						:class="['thumbnail', { active: index + startIndex === currentImageIndex }]" 
						@click="openModal(index + startIndex)"
					>
						<img :src="image.url" :alt="image.name" />
					</div>
				</div> -->
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
			visibleThumbnails() {
				if (this.images.length <= 5) {
					// Show all images if 5 or fewer
					return this.images;
				}

				let startIndex = this.currentImageIndex - 2;
				let endIndex = this.currentImageIndex + 3;

				// Wrap around if indices go out of bounds
				if (startIndex < 0) {
					startIndex = this.images.length + startIndex;
				}
				if (endIndex > this.images.length) {
					endIndex = endIndex - this.images.length;
				}

				// Create visible thumbnails array
				if (startIndex < endIndex) {
					return this.images.slice(startIndex, endIndex);
				} else {
					return [...this.images.slice(startIndex), ...this.images.slice(0, endIndex)];
				}
			},
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
		gap: 0.5rem; /* Adjust spacing between images */
		padding: 1rem;
		width: 100%;

		/* Alternate rows */
		.image-container {
			position: relative;
			width: 100%;
			overflow: hidden; /* Ensures the image doesn't spill out */
			aspect-ratio: 3 / 2;

				img {
					width: 100%;
					height: 100%;
					object-fit: cover;
				}
			
		}
	}


  .modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100dvh;
    overflow: auto;
    background-color: $bg-secondary;

    .close {
      position: absolute;
      top: 20px;
      right: 35px;
      color: #fff;
      font-size: 40px;
      font-weight: bold;
      cursor: pointer;
    }

	.modal-content {
		display: flex;
		align-items: center;
		justify-content: center;
		position: relative;
		background-color: transparent;
		padding: 2rem 1rem;
		border-radius: 8px;
		text-align: center;
		height: 90dvh;

		/* Main modal image */
		img {
			border-radius: 8px;
			max-width: 100vw;
			object-fit: contain;
			width: 100%;
		}

		/* Arrows at the top-right */
		.arrow {
			background-color: #ffffff94;
			position: absolute;
			bottom: 50%;
			font-size: 2rem;
			cursor: pointer;
			user-select: none;
			color: $color-2;
			border: 1px solid white;
			border-radius: 8px;
			padding: .5rem;

			&.left {
				left: 1rem;
			}

			&.right {
				right: 1rem;
			}
		}

		/* Thumbnails at the bottom */
		.thumbnails {
			position: absolute;
			bottom: 4rem; /* Distance from bottom of modal */
			left: 0;
			width: 100%;
			display: flex;
			justify-content: center;
			gap: 10px;
			max-height: 30vh;

			.thumbnail {
				width: calc(20% - 5px);
				height: 6rem;
				cursor: pointer;
				opacity: 0.6;

				img {
					// width: 100%;
					height: 100%;
					object-fit: cover;
					border-radius: 4px;
					border-bottom: 4px solid transparent; /* Default border */
					margin-top: 0;
				}

				&.active {
					opacity: 1;

					img {
						border-bottom: 4px solid $color-2; /* Highlight active thumbnail */
					}
				}
			}
		}
	}

  }
}

</style>
