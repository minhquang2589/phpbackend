@extends ('layout.master')

@section ('main_content')
    <div class="container">
        <h2>Login</h2>
        <div class="login-error mt-3 mb-3">
            @if($errors->any())
                <strong>Holy smokes!</strong>
                @foreach($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <form action="{{ route('login.store') }}" method="post">
            @csrf
            <div class="form-group ">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group form-check mb-2">
               <input type="checkbox" class="form-check-input" id="exampleCheck1">
               <label class="form-check-label" for="exampleCheck1">Remember me!</label>
            </div>
            <button type="submit" class="btn btn-primary mb-5">Login</button>
        </form>
    </div>
@endsection 