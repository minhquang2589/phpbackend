@extends('admin.dashboard')
@section('title', 'Blog - Upload')
@section('content')

<div class="mx-6 lg:mx-0 ">
   <div class="flex justify-start mt-14 mb-10 ml-20">
      <h3><strong class="text-3xl">Blog - Upload</strong></h3>
   </div>
   <form class="max-w-md mx-auto " method="POST" action="{{ route('blog.update.submit') }}" enctype="multipart/form-data">
      @csrf
      <div class="relative z-0 w-full mb-5 mt-4 group">
         <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
         <label for="title" name="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Blog title</label>
      </div>
      <div class="relative z-0 w-full mb-5 mt-4 group">
         <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
         <label for="description" name="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
      </div>
      <div class="max-w-lg">
         <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
         <input require class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image" for="image" type="file" name="image">
      </div>
      <div class="mt-3">
         <textarea class="w-full" name="content" id="editor"></textarea>
      </div>
      <!--  -->
      <div class="mb-5 mt-2 w-full">
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
         <div class="flex py-3 justify-start lg:flex lg:justify-start">
            <button type="submit" class="block mr-2 rounded-xl bg-gray-800 px-8 py-2 text-sm text-white transition hover:bg-black">Submit</button>
         </div>
   </form>
</div>
<script>
   ////
   document.addEventListener("DOMContentLoaded", function() {
      ClassicEditor
         .create(document.querySelector('#editor'), {
            ckfinder: {
               uploadUrl: "{{ route('blog.file.upload') }}?_token={{ csrf_token() }}"
            },
            on: {
               fileUploadRequest: function(evt) {
                  evt.preventDefault();
                  var responseData = evt.data.responseData;
                  var imageUrl = responseData.url;
                  $.ajax({
                     url: "{{ route('blog.update.submit') }}",
                     method: 'POST',
                     data: {
                        editor: editor.getData(),
                        url: imageUrl
                     },
                     headers: {
                        'X-CSRF-TOKEN': csrfToken
                     },
                     success: function(response) {
                        console.log(response);
                     },
                     error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                     }
                  });
               }
            }
         })
         .catch(error => {
            console.error(error);
         });
   });

</script>
@endsection