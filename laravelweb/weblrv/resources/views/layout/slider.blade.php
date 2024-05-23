
<!--  -->
<!-- @vite('resources/js/slider/slider.js') -->
<!--  -->
<div class="mx-4">
   <article x-data="slider" class="relative flex flex-shrink-0 overflow-hidden shadow-2xl">
      <div class="rounded-full bg-gray-600 text-white absolute top-5 right-5 text-sm px-2 text-center ">
         <span x-text="currentIndex"></span>
         <span x-text="images.length"></span>
      </div>
      <template x-for="(image, index) in images">
         <figure class="h-96" x-show="currentIndex == index + 1" x-transition:enter="transition transform duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition transform duration-300" x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         <img :src="image" alt="Image" class="absolute inset-0 h-full w-full object-cover opacity-100" />
         <figcaption class="absolute w-fit	 bg-gray-100  opacity-60 hover:opacity-80 inset-x-0 bottom-1 rounded-3xl  z-20 mx-auto p-4 font-light text-center tracking-widest leading-snug ">
      <!-- comment slider -->
            <div>
               <a class="text-neutral-950 " href=""><strong>Click here to see the new arrivals!</strong></a>
            </div>
         </figcaption>
         </figure>
      </template>
      <!-- button siderbar -->
      <button @click="back()"
         class="absolute left-14 bottom-40 translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 opacity-50 hover:opacity-70 bg-gray-100 hover:bg-gray-200">
         <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
               </path>
         </svg>
      </button>
      <button @click="next()"
      class="absolute right-14 bottom-40 translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 opacity-50 hover:opacity-70 bg-gray-50 hover:bg-gray-100">
         <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-800 hover:text-gray-600 hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
         </svg>
      </button>
   </article>
</div>
<!--  -->
<!-- script -->
<script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
<script>
   document.addEventListener('alpine:init', () => {
      Alpine.data('slider', () => ({
         currentIndex: 1,
         images: [
               'https://rakkiu.com/wp-content/uploads/2024/01/DSCF1637-scaled-e1706347480559.webp',
               'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80',
               'https://www.nationsonline.org/gallery/Vietnam/Halong-Bay-Panorama.jpg',
         ],
         back() {
               if (this.currentIndex > 1) {
                  this.currentIndex = this.currentIndex - 1;
               }
         },
         next() {
               if (this.currentIndex < this.images.length) {
                  this.currentIndex = this.currentIndex + 1;
               } else {
                  this.currentIndex = 1;
               }
         },
         autoNext() {
               setInterval(() => {
                  this.next();
               }, 1000);
         },
         mounted() {
               this.autoNext();
         },
      }))
   })
</script>




