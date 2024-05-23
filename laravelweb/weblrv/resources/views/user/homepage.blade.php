<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>

@vite('resources/css/app.css')
@vite('resources/css/header/header.css')

@vite('resources/js/register/register.js')
@vite('resources/css/register/register.css')
<style>
 

</style>
</head>
@if (Auth::check())
      @include('layout.header_logout')
  @else
      @include('layout.header')
  @endif
<body>
<!--  -->
<span class="flex items-center">
    <span class="h-px flex-1 bg-slate-200"></span>
</span>
<!-- content -->
      <div>
          @yield('content')
      </div>
    @if (Auth::check())
        @include('layout.sidebar')
    @endif

  @include('layout.footer')
</body>
<!-- header script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let prevScrollPos = window.pageYOffset;
    let timer; 
    
    window.addEventListener("scroll", function() {
        let currentScrollPos = window.pageYOffset;
        if (prevScrollPos > currentScrollPos) {
            clearTimeout(timer); // Xóa bất kỳ thời gian chờ nào còn tồn tại
            timer = setTimeout(function() {
                if (!document.querySelector("header").classList.contains("active")) {
                    document.querySelector("header").classList.add("active");
                }
            }, 1000); // Thời gian chờ 1 giây (1000 mili giây)
        } else {
            document.querySelector("header").classList.remove("active");
        }
        prevScrollPos = currentScrollPos;
    });
});


</script>

</html>



