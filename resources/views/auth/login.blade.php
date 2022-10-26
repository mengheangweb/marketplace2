<x-master-layout>
    <div class="row mt-5">
        <div class="col-md-4">
            <h5>Login</h5>
            <hr>
            <form action="/login" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" value="mengheangweb@gmail.com" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="inputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" value="12345678" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-master-layout>