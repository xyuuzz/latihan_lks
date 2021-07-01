@extends("templates.app")

@section("content")

<section class="container-fluid bg">
    <section class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-lg rounded-lg position-absolute" style="top:25vh; border-radius: 10px">
                <div class="card-header">
                    <h5 class="text-center">Login Form</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route("login_u") }}" method="POST">
                        @csrf

                        @if(session("failed"))
                            <div class="alert alert-danger" role="alert">
                                {{ session("failed") }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required name="email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
        </div>
    </section>
</section>

@endsection
