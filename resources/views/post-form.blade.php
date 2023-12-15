<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">LinkedIn Post Form</div>

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

                        <form method="post" action="{{ url('/post-to-linkedin') }}">
                            @csrf

                            <div class="form-group">
                                <label for="content">Post Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
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