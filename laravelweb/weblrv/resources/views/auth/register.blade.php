
@extends('dashboard')
@section('title', 'Registrations')

@section('content')
<!--  -->
<div class="lg:flex">
   <div class="lg:w-1/2 xl:max-w-screen-sm">
         <div class="sm:px-24 mt-0 md:px-48 pt-10 lg:px-12 lg:mt-6 xl:px-24">
            <h2 class="text-center flex justify-center text-4xl font-display font-semibold  xl:text-4xl
            xl:text-bold">Register</h2>
            <div class="mt-12">
<!-- form -->
               <form method="POST" action="{{ route('register.post') }}">
                  @csrf
                  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 flex flex-col my-2">
                     <div class="-mx-3 ">
                        <div class="md:w-full px-3">
                           <label class="block  text-sm font-bold tracking-wide text-grey-darker mb-2" for="fullname">
                           Full Name
                           </label>
                           <input class="text-sm italic appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-2" id="fullname" name="fullname" type="text" placeholder="Enter Your Name">
                        </div>
                        <div class="md:w-full px-3">
                           <label class="block  text-sm font-bold tracking-wide text-grey-darker mb-2" for="email">
                           Email Address
                           </label>
                           <input class="appearance-none text-sm italic block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3" id="email" name="email" type="text" placeholder="Enter Your Email">
                        </div>
                        <div class="md:w-full px-3">
                           <label class="block  text-sm font-bold tracking-wide text-grey-darker mb-2" for="phone">
                           Phone Number
                           </label>
                           <input class="appearance-none italic block w-full bg-grey-lighter text-sm text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3" id="phone" name="phone" type="tphoneext" placeholder="Enter Your Phone Number">
                        </div>
                     </div>
                     <div class="inline-table">
                        <div class="-mx-3 mb-3">
                           <div class="md:w-full px-3">
                              <label class=" tracking-wide text-grey-darker text-sm font-bold mb-2" for="password">
                              Password
                              </label>
                              <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 " id="password" name="password" type="password" placeholder="*********">                            
                             </div>
                           </div>
                        <div class="-mx-3 md:flex mb-6">
                           <div class="md:w-full px-3">
                              <label class=" tracking-wide text-grey-darker text-sm font-bold mb-2" for="confirm_password">
                              Confirm Password
                              </label>
                              <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3" id="confirm_password" name="confirm_password" type="password" placeholder="*********">
                              <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                           </div>
                        </div>
                     </div>
                     <div class="-mx-3 md:flex mb-2">
                        <div class="md:w-full px-3 mb-6 md:mb-0">
                           <label class="block tracking-wide text-grey-darker text-sm font-bold mb-2" for="address">
                           Address
                           </label>
                           <input class="appearance-none italic text-sm block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4" id="address" name="address" type="text" placeholder="Enter Your Address">
                        </div>
                     </div>
<!-- Notification when error occurs -->
                  @if ($errors->any())
                     <div class="alert alert-danger">
                        <ul>
                           @foreach ($errors->all() as $error)
                           <div class="mt-0 text-red-700 rounded-xl relative" role="alert">
                              <li class="block sm:inline text-xs">{{ $error }}</li>
                           </div> 
                           @endforeach
                        </ul>
                     </div>
                  @endif
                     <div class="mt-10">
                        <button class="bg-gray-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                        font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-gray-800
                        shadow-lg">
                              Register
                        </button>
                     </div>
                     <div class="mt-12 text-sm font-display font-semibold text-gray-700 text-center">
                     You have account? <a  href="{{ Route('login') }}" class="cursor-pointer text-red-600 hover:text-red-800">Sign in</a>
                  </div>
                  </div>
               </form>
               
<!-- end form -->
            </div>
         </div>
   </div>
<!-- contnet -->
<!-- background -->
   <div class="hidden w-full h-2/5	 lg:flex items-center justify-center  flex-1 ">
         <div class=" z-1 transform duration-200 hover:scale-110 cursor-pointer">
            <img class="w-full mx-auto" xmlns="" id="f080dbb7-9b2b-439b-a118-60b91c514f72" data-name="Layer 1" viewBox="0 0 528.71721 699.76785" src="https://tailwindcss.com/_next/static/media/installation.50c59fdd.jpg" alt="image">
         </div>
   </div>
</div>
<!--  -->
@endsection