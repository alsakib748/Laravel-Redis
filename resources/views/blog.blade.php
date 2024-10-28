<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Redis Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">

        <h1 class="text-center text-warning">Laravel Redis Blog</h1>

        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header d-md-flex align-items-md-center justify-content-md-between">
                        <div class="card-title h3 text-secondary">Blog Content</div>
                        <div class="text-muted h3">Execution Time: {{ $execution_time }}</div>
                    </div>
                </div>

            </div>

            @foreach ($blogs as $key => $item)
                <div class="col-md-6 mt-2 mb-2">
                    <div class="card">
                        <card class="card-header">Id : {{ $item->id }}</card>
                        <div class="card-body">
                            <div class="card-title"><strong>{{ $item->title }}</strong></div>

                            <p>{{ Str::limit($item->description,100) }}</p>

                            <small>#{{ $item->tags }}</small>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('blogs.edit',$item->id) }}" class="btn btn-success m-1">Edit</a>
                            <a onclick="confirm('Are you sure to delete this ???')" href="{{ route('blogs.delete',$item->id) }}" class="btn btn-danger m-1">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
        integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
