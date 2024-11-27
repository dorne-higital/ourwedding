
// plugins/firebaseConfig.js
import firebase from "firebase/app";
import "firebase/storage";
import "firebase/firestore";

const firebaseConfig = {
    apiKey: "AIzaSyCal0tdhSC4GOjD_XCtcNS4HYaaNWqxVMY",
    authDomain: "our-wedding-85499.firebaseapp.com",
    projectId: "our-wedding-85499",
    storageBucket: "our-wedding-85499.appspot.com",
    messagingSenderId: "387714531938",
    appId: "1:387714531938:web:7090fa6c0950cefd82473b",
    measurementId: "G-E24GNRB1SH"
};

if (!firebase.apps.length) {
  firebase.initializeApp(firebaseConfig);
}

const storage = firebase.storage();
const firestore = firebase.firestore();

export { storage, firestore };
