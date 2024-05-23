@extends ('layout.client_master')


@section ('main_content')
    <div class="container">
        <h2>Register</h2>
        <div class="register-error mt-3 mb-3">
            @if($errors->any())
                <strong>Holy smokes!</strong>
                @foreach($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <form action="{{ route('Register.store') }}" method="post">
            @csrf
            <div class="form-group ">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Enter Your Name">            </div>
            <div class="form-group ">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group mb-3">
                <label for="matchpassword">Confirm Password</label>
                <input name="matchpassword" type="password" class="form-control" id="matchpassword" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary  mb-5">Register</button>
        </form>
    </div>
@endsection 
@section('page_title')
   Register
@endsection