<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="UTF-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
   <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>



   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<style>
   .image-container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 300px;
      overflow: hidden;
      background-color: #f0f0f0;
   }

   .product-image {
      max-width: 100%;
      max-height: 100%;
      width: auto;
      height: auto;
      object-fit: contain;
   }

   .notificationAddcart {
      position: fixed;
      top: 25%;
      left: 50%;
      height: 80px;
      display: flex;
      font-size: larger;
      justify-content: center;
      align-items: center;
      width: fit-content;
      z-index: 9999;
      transform: translateX(-50%);
      background-color: #fff;
      color: black;
      padding: 10px 80px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   }

   .notificationAddcart img {
      width: 100px;
      height: 100px;
   }

   .standing {
      max-height: calc(100vh - 100px);
      position: sticky;
      top: 66px;

   }

   .standing-viewcart {
      max-height: calc(100vh - 100px);
      position: sticky;
      top: 10px;
   }

   .mobileViewCart {
      display: none !important;
   }

   .pcViewCart {
      display: block !important;
   }

   .sidebar {
      display: none;
   }

   .sasidebar {
      display: block;
   }

   .filter_mobile {
      display: none;
   }

   .sidebar-mobile {
      display: none;
   }

   .sidebar-toggle {
      display: none;
      position: fixed;
      top: 88px;
      left: 20px;
      border: none;
      cursor: pointer;
      background: rgba(255, 255, 255, 0.8);
      width: 35px;
      height: 35px;
      padding: 0px 0px 0px 5px;
      border-radius: 8px;
   }

   .sidebar-toggle span {
      display: block;
      width: 25px;
      height: 3px;
      background-color: #333;
      margin: 5px 0;
      transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
   }

   .sidebar-toggle.open span:nth-child(1) {
      transform: translateY(9px) rotate(45deg);
   }

   .sidebar-toggle.open span:nth-child(2) {
      opacity: 0;
   }

   .sidebar-toggle.open span:nth-child(3) {
      transform: translateY(-9px) rotate(-45deg);
   }

   .sidebar-mobile {
      display: none;
   }

   .sidebar-mobile.open {
      display: block;
   }

   .fonfirm_delete_title {
      color: black;
      font-weight: bold;
   }


   .togger-hidden {
      border: 1px solid rgba(200, 200, 200, 1);
      cursor: pointer;
      padding: 0px 5px 2px 5px;
      border-radius: 4px;
      color: black;
   }

   .confirm_cancel_button {
      font-size: 14px !important;
      padding: 5px 10px !important;
      color: white !important;
      background-color: gray !important;
   }

   .confirm_delete_button {
      font-size: 14px !important;
      padding: 5px 10px !important;
      color: white !important;
      background-color: black !important;
      border-color: #333 !important;
   }


   .confirmDeleteContainer {
      width: fit-content;
      height: fit-content;
   }

   .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      backdrop-filter: blur(3px);
      -webkit-backdrop-filter: blur(2px);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   }

   .modal-addcart {
      display: none;
      position: fixed;
      z-index: 9999 !important;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   }

   .modal-content-addcart {
      background-color: #fff;
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 10px;
      border: 1px solid gray;
      width: 80%;
      max-width: 400px;
      max-height: 80%;
      overflow-y: auto;
      width: 100%;
      height: fit-content;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   }

   .modal-content {
      background-color: #fff;
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 10px;
      border: 1px solid gray;
      width: 80%;
      max-width: 400px;
      max-height: 80%;
      overflow-y: auto;
      width: 100%;
      height: fit-content;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   }

   .modal-sizechart {
      transition: opacity 0.5s ease, visibility 0.3s ease;
      opacity: 0;
      visibility: hidden;
      position: fixed;
      z-index: 9999 !important;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      backdrop-filter: blur(3px);
      -webkit-backdrop-filter: blur(2px);
   }

   .modal-sizechart.show {
      opacity: 1;
      visibility: visible;
   }

   .modal-sizechart-content {
      background-color: #fff;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 10px;
      border: 1px solid gray;
      width: 95%;
      max-width: 60%;
      max-height: 80%;
      overflow-y: auto;
      border-radius: 10px;
   }

   .closeModalSizeBtn {
      margin-right: 10px;
      padding: 2px;
   }

   .fade-enter-active,
   .fade-leave-active {
      transition: all 1s ease;
   }

   .fade-enter,
   .fade-leave-to {
      transform: translateX(100%);
      opacity: 0;
   }

   .fadesiderbar-enter-active,
   .fadesiderbar-leave-active {
      transition: all 1s ease;
   }

   .fadesiderbar-enter,
   .fadesiderbar-leave-to {
      opacity: 0;
   }

   .fadesiderbar-enter {
      transform: translateX(100%);
   }

   .fadesiderbar-leave-to {
      transform: translateX(-100%);
   }

   .incart {
      position: absolute;
      top: 0;
      right: 0;
      width: 350px;
      max-height: 100vh;
      min-height: 100vh;
      background-color: #fff;
      overflow-y: auto;
      transition: 1s;
      z-index: 9999;
      border-left: 1px solid rgb(20 41 20);
   }

   .productdetail {
      height: 100%;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      margin: 0;
      padding: 0;
   }

   .swiper {
      width: 83%;
      height: 100%;
   }

   .image-detail {
      text-align: center;
      font-size: 18px;
      display: block;
      width: 90%;
      height: 100%;
      object-fit: cover;
      margin-left: auto;
      margin-right: auto;
   }

   .button-next {
      color: gray;
   }

   .button-prev {
      color: gray;
   }

   @media screen and (max-width: 1000px) {
      .primage {
         height: 100%;
      }

      .standing {
         display: none;
      }

      .standing-viewcart {
         position: relative;
         z-index: 2 !important;
      }

      .mobileViewCart {
         display: block !important;
      }

      .pcViewCart {
         display: none !important;
      }

      .swiper {
         width: 97%;
         height: 100%;
      }

      .image-detail {
         text-align: center;
         display: block;
         width: 90%;
         height: 100%;
         object-fit: cover;
         margin-left: auto;
         margin-right: auto;
      }
   }

   @media only screen and (max-width: 768px) {
      .sidebar {
         display: block;
      }

      .incart {
         width: 290px;
      }

      .notificationAddcart {
         height: 60px;
         width: 95%;
         padding: 10px 25px;
      }

      .standing {
         display: none;
      }

      .filter_mobile {
         display: block;
      }

      .sidebar-mobile {
         display: block;
      }

      .sidebar-toggle {
         display: block;
      }

      .modal-content {
         width: 90%;
         top: 40%;
         height: fit-content;
      }

      .modal-content-addcart {
         width: 100%;
         top: 30%;
         height: fit-content;
      }

      .modal-sizechart-content {
         max-width: 100%;
         top: 40%;
      }

      .standing-viewcart {
         position: relative;
         z-index: 2 !important;
      }

      .mobileViewCart {
         display: block !important;
      }

      .pcViewCart {
         display: none !important;
      }

      .swiper {
         width: 98%;
         height: 100%;
      }

      .image-detail {
         text-align: center;
         display: block;
         width: 90%;
         height: 100%;
         object-fit: cover;
         margin-left: auto;
         margin-right: auto;
      }

   }
</style>

<body>
   <div id="app"></div>
   <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
</body>

</html>