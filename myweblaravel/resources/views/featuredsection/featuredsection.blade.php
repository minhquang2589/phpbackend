@if (isset($AndImage[0]) && isset($AndImage[1]) && isset($AndImage[2]))
<div>
   <div class="text-center mt-10">
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">New Collection</h2>
      <p class="mx-auto mt-4 max-w-md text-gray-500">
         Customer service, customer service will be able to follow. So, rightly said fall, responsibilities born of pain?
      </p>
   </div>
   <span class="flex mt-2 items-center">
      <span class="h-px flex-1 bg-gray-300"></span>
   </span>
   <div class="flex">
      <ul class="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-3">
         <li>
            <a href="#" class="group relative block">
               <img src="{{ isset($AndImage[1]->image) ? asset('images/' . $AndImage[1]->image) : 'alternative_image_path.jpg' }}" alt="" class="aspect-square w-full object-cover transition duration-500 group-hover:opacity-90" />
               <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                  <h3 class="text-xl font-medium text-white">{{ $AndImage[1]->name ?? 'No name' }}</h3>
                  <span class="mt-1.5 rounded-xl inline-block  bg-gray-800 hover:bg-black  px-5 py-3 text-xs font-medium uppercase tracking-wide text-white">
                     Shop Now
                  </span>
               </div>
            </a>
         </li>
         <li>
            <a href="#" class="group relative block">
               <img src="{{ isset($AndImage[2]->image) ? asset('images/' . $AndImage[2]->image) : 'alternative_image_path.jpg' }}" alt="" class="aspect-square w-full object-cover transition duration-500 group-hover:opacity-90" />
               <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                  <h3 class="text-xl font-medium text-white">{{$AndImage[2]->name ?? 'No Name'}}</h3>
                  <span class="mt-1.5 rounded-xl inline-block bg-gray-800 hover:bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white">
                     Shop Now
                  </span>
               </div>
            </a>
         </li>
         <li class="lg:col-span-2 lg:col-start-2 lg:row-span-2 lg:row-start-1">
            <a href="#" class="group relative block">
               <img src="{{ isset($AndImage[0]->image) ? asset('images/' . $AndImage[0]->image) : 'alternative_image_path.jpg' }}" alt="" class="aspect-square w-full object-cover transition duration-500 group-hover:opacity-90" />
               <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                  <h3 class="text-xl font-medium text-white">{{$AndImage[0]->name ?? 'No Name'}}</h3>
                  <span class="mt-1.5 rounded-xl inline-block bg-gray-800 hover:bg-black px-5 py-3 text-xs font-medium uppercase tracking-wide text-white">
                     Shop Now
                  </span>
               </div>
            </a>
         </li>
      </ul>
   </div>
</div>
</div>
<span class="flex items-center">
   <span class="h-px flex-1 bg-gray-300"></span>
</span>
@endif