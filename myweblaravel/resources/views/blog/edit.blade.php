@extends('admin.dashboard')

@section('title', 'Blog - Edit')
<!--  -->
@section('content')
<div class="">
   <div class="flex mt-14 mb-10 ml-20">
      <h3><strong class="text-xl">Blog - Edit</strong></h3>
   </div>
   <div class="flex justify-center mb-4">
      <table class="lg:w-1/2 w-full mx-2 lg:mx-0 divide-gray-200 bg-white text-sm">
         <thead class="ltr:text-left rtl:text-right">
            <tr>
               <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Image</th>
               <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Title</th>
               <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Description</th>
               <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
            </tr>
         </thead>
         <tbody class=" divide-gray-200">
            <tr>
               <td class=" text-gray-900">
                  <div class="w-28 h-28">
                     <img src="{{ asset('images/' . $blog->image_url) }}" alt="{{ $blog->name }}" class="object-cover transition duration-500 group-hover:scale-105" />
                  </div>
               </td>
               <td>{{ $blog ->title}}</td>
               <td>{{ $blog ->description}}</td>
               <td>
                  @if ($blog -> status)
                  <p class="text-red-600">Active</p>
                  @else
                  <p class="text-red-600">Not Active</p>
                  @endif
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="lg:flex justify-center">
      <div class="lg:w-1/2 mx-4 ">
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul class="mb-4">
               @foreach ($errors->all() as $error)
               <div class="mt-0 text-red-700 rounded-xl relative" role="alert">
                  <li class="block sm:inline text-xs">{{ $error }}</li>
               </div>
               @endforeach
            </ul>
         </div>
         @endif
         @if (session('success'))
         <div class="alert text-blue-600 alert-success">
            <strong>{{ session('success') }} </strong>
         </div>
         @endif
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul class="mb-1">
               @foreach ($errors->all() as $error)
               <div class="mt-0 text-red-700 rounded-xl relative" role="alert">
                  <li class="block sm:inline text-xs">{{ $error }}</li>
               </div>
               @endforeach
            </ul>
         </div>
         @endif
         <form action="{{ route('blog.edit.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="relative z-0 w-full mb-5 mt-4 group">
               <input value="{{$blog -> title}}" type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
               <label for="title" name="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Blog title</label>
            </div>
            <div class="relative z-0 w-full mb-5 mt-4 group">
               <input value="{{$blog ->description }}" type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
               <label for="description" name="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            <div class="max-w-lg">
               <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
               <input require class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image" for="image" type="file" name="image">
            </div>
            <div class="mt-2">
               <label>
                  <input class="size-4 rounded border-gray-300" type="checkbox" name="status" {{ $blog->status == 1 ? 'checked' : '' }}>
                  <span class="text-red-600 ml-3">Status?</span>
               </label>
            </div>
            <div class="mt-3">
               <textarea class="w-full" name="content" id="editor">{{$blog->content}}</textarea>
            </div>
            <input type="hidden" name="id" value="{{$blog->id}}">
            <div class="flex justify-start lg:flex lg:justify-start">
               <button type="submit" class="text-white mt-6 bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-1/2 sm:w-auto px-20 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function() {
      ClassicEditor
         .create(document.querySelector('#editor'), {
            ckfinder: {
               uploadUrl: "{{ route('blog.file.upload') }}?_token={{ csrf_token() }}"
            },
         })
         .catch(error => {
            console.error(error);
         });
   });
</script>
@endsection