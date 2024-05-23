@if (isset($section_02_view))
<div class="overflow-hidden lg:mr-10 lg:mt-10  sm:grid sm:grid-cols-2 sm:items-center">
   <div class="p-8  ">
      <div class="mx-auto max-w-xl text-center ltr:sm:text-left rtl:sm:text-right">
         <h2 class="text-2xl font-bold text-gray-900 md:text-3xl">
            <a href="{{route('product.new')}}">
               {{$section_02_view -> title}}
            </a>
         </h2>
         <p class="hidden text-gray-600 md:mt-4 md:block">
            {{$section_02_view -> description}}
         </p>
         <div class="mt-4 md:mt-8">
            <a href="{{route('product.new')}}" class="inline-block rounded bg-gray-900 px-12 py-3 text-sm font-medium text-white transition hover:bg-black focus:outline-none focus:ring focus:ring-yellow-400">
               Shopping now
            </a>
         </div>
      </div>
   </div>
   <div class="lg:mr-4 px-2">
      <a href="{{route('product.new')}}">
         <img alt="" src="{{ asset('images/' . $section_02_view->image) }}" class="h-full w-full object-cover sm:h-[calc(100%_-_2rem)] sm:self-end sm:rounded-ss-[30px] md:h-[calc(100%_-_4rem)] md:rounded-ss-[60px]" />
      </a>
   </div>
</div>
@endif