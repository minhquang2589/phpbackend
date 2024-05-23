@extends('admin.dashboard')

@section('title', 'Blog - Update ')
<!--  -->
@section('content')
<div class="">
   <div class="flex mt-14 mb-10 ml-20">
      <h3><strong class="text-xl">Blog - Update</strong></h3>
   </div>
   <div class="flex justify-center mb-4">
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
      <div class="alert text-blue-600 alert-success mb-5">
         <strong>{{ session('success') }} </strong>
      </div>
      @endif
      <table class="lg:w-1/2 w-full mx-2 lg:mx-0 divide-gray-200 bg-white text-sm">
         <thead>
            <tr>
               <th class="px-4 py-2 font-medium text-gray-900">Image</th>
               <th class="px-4 py-2 font-medium text-gray-900">Status</th>
               <th class=" px-4 py-2 font-medium text-gray-900">Title</th>
               <th class=" px-4 py-2 font-medium text-gray-900">Action</th>
            </tr>
         </thead>
         <tbody class="divide-y divide-gray-200">
            @if ( isset($blog))
            @foreach($blog as $value)
            <tr>
               <td class="text-gray-900">
                  <div class="w-28 h-28">
                     <img src="{{ asset('images/' . $value->image_url) }}" alt="{{ $value->name }}" class="object-cover transition duration-500 group-hover:scale-105" />
                  </div>
               </td>
               <td>
                  @if ($value->status)
                  <p class="text-red-600">Active</p>
                  @else
                  <p class="text-red-600">Not Active</p>
                  @endif
               </td>
               <td class=" px-4 py-2 text-gray-900">{{ $value->title }}</td>
               <td>
                  <form action="{{ route('blog.delete' , ['id' =>$value->id ]) }}" method="POST">
                     @csrf
                     <button onclick="return confirm('Do you want to delete?')" type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full">
                        Delete
                     </button>
                  </form>
               </td>
               <td>
                  <form action="{{ route('blog.edit',['id' => $value->id ]) }}" method="get">
                     @csrf
                     <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full">
                        Update
                     </button>
                  </form>
               </td>
            </tr>
            @endforeach
            @else
            <tr>
               <td colspan="5">
                  <h1>No sections</h1>
               </td>
            </tr>
            @endif
         </tbody>
      </table>
   </div>
</div>


@endsection