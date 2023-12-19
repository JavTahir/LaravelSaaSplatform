<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Post Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Twitter Post Form</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="post" action="{{ url('/post-tweet') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="content">Post Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control-file" id="image" name="image[]" multiple="multiple">

                            </div>

                            <button type="submit" class="btn btn-primary">Post to LinkedIn</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
