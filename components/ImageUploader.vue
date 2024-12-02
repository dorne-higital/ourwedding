<template>
	<div :class="[componentName]">
		<label 
			for="fileInput" 
			class="upload-area"
		>
			<h2>Click to Upload</h2>

			<p>or Drag & Drop your images here</p>
		</label>

		<input
			id="fileInput"
			type="file"
			ref="fileInput"
			multiple
			@change="uploadImages"
		/>

		<!-- Uploading Message -->
		<div 
			v-if="isUploading" 
			class="uploading-message"
		>
			<p>Uploading... {{ uploadProgress }}%</p>

			<div class="progress-bar">
				<div 
					class="progress" 
					:style="{ 
						width: uploadProgress + '%' 
					}"
				></div>
			</div>
		</div>

		<!-- Upload Confirmation -->
		<div 
			v-if="showConfirmation" 
			class="upload-confirmation"
		>
			<p>Files uploaded successfully, go to the gallery and view them all!</p>
			
			<nuxt-link
				to="/gallery"
				title="Go to the gallery"
			>
				Gallery
			</nuxt-link>
		</div>

		<!-- <div v-if="imageUrls.length > 0 && !isUploading">
			<p>Uploaded Images:</p>

			<div class="uploaded-images">
				<div 
					v-for="(imageUrl, index) in imageUrls" 
					:key="index" 
					class="uploaded-image"
				>
					<img 
						:src="imageUrl" 
						:alt="'Uploaded Image ' + (index + 1)" 
					/>
				</div>
			</div>
		</div> -->
	</div>
</template>

<script>
    import { storage, firestore } from "~/plugins/firebaseConfig";
    import firebase from "firebase/app";
    import "firebase/firestore";

    export default {
        name: 'imageUploader',
        props: {
            componentName: {
                type: String,
                default: 'image-uploader'
            },
        },
        data() {
            return {
                imageUrls: [],
                isUploading: false,
                uploadProgress: 0,
                showConfirmation: false, // New property for confirmation
            };
        },
        methods: {
            async uploadImages(event) {
                const files = event.target.files;
                if (!files || files.length === 0) return;

                this.isUploading = true;
                this.uploadProgress = 0;
                this.imageUrls = [];

                const uploadPromises = [];

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const resizedFile = await this.resizeImage(file, 1024, 1024, 0.8);
                    const storageRef = storage.ref();
                    const fileRef = storageRef.child(`images/${file.name}`);
                    const uploadTask = fileRef.put(resizedFile);

                    uploadPromises.push(
                        new Promise((resolve, reject) => {
                            uploadTask.on(
                                "state_changed",
                                snapshot => {
                                    const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                    this.uploadProgress = progress.toFixed(2);
                                },
                                error => {
                                    console.error("Error uploading image:", error);
                                    reject(error);
                                },
                                async () => {
                                    try {
                                        const imageUrl = await fileRef.getDownloadURL();
                                        this.imageUrls.push(imageUrl);
                                        await firestore.collection('images').add({
                                            name: file.name,
                                            url: imageUrl,
                                            createdAt: firebase.firestore.FieldValue.serverTimestamp()
                                        });
                                        resolve();
                                    } catch (error) {
                                        reject(error);
                                    }
                                }
                            );
                        })
                    );
                }

                try {
                    await Promise.all(uploadPromises);
                } catch (error) {
                    console.error("Error uploading one or more images:", error);
                }

                this.isUploading = false;
                this.uploadProgress = 0;
                this.showConfirmation = true; // Show confirmation after upload
            },
            dismissConfirmation() {
                this.showConfirmation = false; // Reset confirmation
            },
            resizeImage(file, maxWidth, maxHeight, quality) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = event => {
                        const img = new Image();
                        img.src = event.target.result;
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            let width = img.width;
                            let height = img.height;

                            if (width > height) {
                                if (width > maxWidth) {
                                    height *= maxWidth / width;
                                    width = maxWidth;
                                }
                            } else {
                                if (height > maxHeight) {
                                    width *= maxHeight / height;
                                    height = maxHeight;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, width, height);

                            canvas.toBlob(
                                blob => {
                                    resolve(blob);
                                },
                                file.type,
                                quality
                            );
                        };
                        img.onerror = error => {
                            reject(error);
                        };
                    };
                });
            }
        }
    };
</script>


<style lang="scss">
    @import "~/assets/css/main.scss";

    .image-uploader {
        padding: 2rem 4rem;
        display: flex;
        justify-content: center;
        align-items: center;
		flex-direction: column;

		input[type="file"] {
			display: none;
		}

		.upload-area {
			border: .25rem dashed $color-2;
			border-radius: .5rem;
			padding: 1rem;
			text-align: center;
			cursor: pointer;
			background: #f0f8fe;
			transition: border-color 0.3s, background-color 0.3s;
			margin: 0 auto;

			&:hover {
				border-color: $color-2;
				background: #f0f5fe;
			}

			h2,
			p {
				color: $primary-color;
			}
		}

		.uploading-message {
			margin-top: 20px;
			text-align: center;

			.progress-bar {
				width: 100%;
				background-color: #f3f3f3;
				border-radius: 8px;
				overflow: hidden;
				margin-top: 10px;

				.progress {
					height: 15px;
					background-color: #4caf50;
					width: 0%;
					transition: width 0.3s;
				}
			}
		}

		.upload-confirmation {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			gap: .5rem;
            padding: 2rem;
			text-align: center;

            p {
                color: $color-2;
            }

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
    }
</style>

