import './bootstrap';
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";
import { getMessaging,getToken,onMessage } from "firebase/messaging";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDQFkPHTuvxOgZwGneKRCtIo-f8dKIxYP0",
  authDomain: "notif-ptn.firebaseapp.com",
  projectId: "notif-ptn",
  storageBucket: "notif-ptn.appspot.com",
  messagingSenderId: "548677176397",
  appId: "1:548677176397:web:0ed4a619276eb093b4a004",
  measurementId: "G-VKMGBZ0B7Y"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
const messaging = getMessaging(app);

$(document).ready(function() {
    var wrapper = $('.wrapper');
    var element = document.getElementById("wrap");
    
    $.ajax({
        type: 'GET',
        url: '/admin-total-notif',
        success: function(response) {
            $('#bell').html(response.total);
            // console.log(response.tanggal);
            $.each(response.data, function(key, value) {
                console.log(value.pesan);
                wrapper.append('<a id="notif'+key+'" class="dropdown-item d-flex align-items-center" href="/admin-notif">'
                +'<div class="mr-3">'
                +'<div class="icon-circle bg-warning">'
                +'  <i class="fas fa-exclamation-triangle text-white"></i>'
                +'</div>'
                +'</div>'
                +'<div>'
                +'<div class="small text-gray-500">'+response.tanggal[key]+'</div>'
                +value.pesan+'</div>'
                +'</a>')

                // $('#notif'+key).remove();
            });
            // $(element).remove();
        }
    });
});

$('#mark_read').on('click',function () {
    var wrapper = $('.wrapper');
    $.ajax({
        type: 'GET',
        url: '/admin-mark-read-notif',
        success: function(response) {
            $('#bell').html(response.total);
            console.log(response.tanggal);
            toastr.success(response.message);
            for (let index = 0; index < 3; index++) {
                if ('#notif'+index) {
                    $('#notif'+index).remove();
                }
            }
            $.each(response.data, function(key, value) {
            wrapper.append('<a id="notif'+key+'" class="dropdown-item d-flex align-items-center" href="/admin-notif">'
                +'<div class="mr-3">'
                +'<div class="icon-circle bg-warning">'
                +'  <i class="fas fa-exclamation-triangle text-white"></i>'
                +'</div>'
                +'</div>'
                +'<div>'
                +'<div class="small text-gray-500">'+response.tanggal[key]+'</div>'
                + value.pesan + '</div>'
                +'</a>');
            });
        }
    });  
});

function notif(){
    var wrapper = $('.wrapper');
    $.ajax({
        type: 'GET',
        url: '/admin-total-notif',
        success: function(response) {
            $('#bell').html(response.total);
            // console.log(response.tanggal);
            toastr.success(response.last);
            $.each(response.data, function(key, value) {
            $('#notif'+key).remove();
            wrapper.append('<a id="notif'+key+'" class="dropdown-item d-flex align-items-center" href="/admin-notif">'
                +'<div class="mr-3">'
                +'<div class="icon-circle bg-warning">'
                +'  <i class="fas fa-exclamation-triangle text-white"></i>'
                +'</div>'
                +'</div>'
                +'<div>'
                +'<div class="small text-gray-500">'+response.tanggal[key]+'</div>'
                + value.pesan + '</div>'
                +'</a>');
            });
        }
    });
}

onMessage(messaging, (payload) => {
  console.log('Message received. ', payload);
  alert('Ada siswa yang baru saja melakukan rating PTN');
//   toastr.success('Ada siswa yang baru saja melakukan rating PTN');
    
    notif();
});


getToken(messaging, { vapidKey: 'BNN9e3JwYwoNfAoBcOrWsGJvdytliNCPsbp7oYQPhfwAc3JAK33tJcNTFO8IpzMGZoJUacZg1c1YcxzhPhKVXYU' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        // ...
        // console.log(currentToken);
        sentTokenToServer(currentToken);
    } else {
        // Show permission request UI
        requestPermission();
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // ...
    });



function requestPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve a registration token for use with FCM.
            // ...
        } else {
            // console.log('Unable to get permission to notify.');
            alert('Izinkan Notifikasi Untuk Perangkat ini')
        }
    });
}


function sentTokenToServer(token){
    var csrf = document.querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

    let formData = new FormData();

    formData.append("token",token);
    
    fetch("/tokenweb",{
        headers: {
            "X-CSRF-Token": csrf,
            _method:"_POST",
        },
        method: "post",
        credentials: "same-origin",
        body: formData,
    }).then((response)=>{
        // console.log(response);
    })


    /**Versi Ajax**/

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // var formData = new FormData(this);
    // formData.append("token",token);
    // $.ajax({
    //     type: 'POST',
    //     url: "/tokenweb",
    //     data: formData,
    //     cache: false,
    //     contentType: false,
    //     processData: false,
        
    //     success: function(response) {
    //         console.log(response);
    //     },
    //     error: function(data) {
    //         console.log(data);
    //     }
    // });
}