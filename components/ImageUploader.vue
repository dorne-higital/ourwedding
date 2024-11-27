<template>
  <div>
    <input type="file" ref="fileInput" multiple @change="uploadImages" />
    <div v-if="isUploading" class="uploading-message">
      <div class="progress-bar">
        <div class="progress" :style="{ width: uploadProgress + '%' }"></div>
      </div>
    </div>
    <div v-if="imageUrls.length > 0 && !isUploading">
      <!-- <p>Uploaded Images:</p>
      <div class="uploaded-images">
        <div v-for="(imageUrl, index) in imageUrls" :key="index" class="uploaded-image">
          <img :src="imageUrl" :alt="'Uploaded Image ' + (index + 1)" />
        </div>
      </div> -->
    </div>
  </div>
</template>

<script>
import { storage, firestore } from "~/plugins/firebaseConfig";
import firebase from "firebase/app";
import "firebase/firestore";

export default {
  data() {
    return {
      imageUrls: [],
      isUploading: false,
      uploadProgress: 0
    };
  },
  methods: {
    async uploadImages(event) {
      const files = event.target.files;
      if (!files || files.length === 0) return;

      // Set uploading state to true
      this.isUploading = true;
      this.uploadProgress = 0;

      // Clear previous uploads
      this.imageUrls = [];

      // Upload each file
      const uploadPromises = [];
      for (let i = 0; i < files.length; i++) {
        const file = files[i];

        // Resize and compress image
        const resizedFile = await this.resizeImage(file, 1024, 1024, 0.8);

        const storageRef = storage.ref();
        const fileRef = storageRef.child(`images/${file.name}`);
        
        // Create a promise for each file upload
        const uploadTask = fileRef.put(resizedFile);
        uploadPromises.push(
          new Promise((resolve, reject) => {
            uploadTask.on(
              "state_changed",
              snapshot => {
                // Update progress bar
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
                  
                  // Store image metadata in Firestore (optional)
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

      // Wait for all uploads to finish
      try {
        await Promise.all(uploadPromises);
      } catch (error) {
        console.error("Error uploading one or more images:", error);
      }

      // Set uploading state to false
      this.isUploading = false;
      this.uploadProgress = 0;
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

<style>
.uploading-message {
  color: blue;
  font-weight: bold;
  margin-top: 10px;
}

.progress-bar {
  width: 100%;
  background-color: #f3f3f3;
  border-radius: 5px;
  overflow: hidden;
  margin-top: 10px;
}

.progress {
  height: 20px;
  background-color: #4caf50;
  width: 0%;
  transition: width 0.2s;
}

.uploaded-images {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.uploaded-image {
  width: 100px;
  height: 100px;
}

.uploaded-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 8px;
}
</style>
