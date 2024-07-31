<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task 1 | HL</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-4">
        <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
                @if ($errors->has('title'))
                    <span class="text-danger">
                        {{ $errors->first('title') }}
                    </span>
                @endif
                <label for="title">Title of Blog</label>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="image" name="image" accept=".png,.jpeg,.jpg"
                    required>
                @if ($errors->has('image'))
                    <span class="text-danger">
                        {{ $errors->first('image') }}
                    </span>
                @endif
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="content" placeholder="Write your blog here" name="content" style="height: 200px"
                    required></textarea>
                <label for="content">Blog Content</label>
                @if ($errors->has('content'))
                    <span class="text-danger">
                        {{ $errors->first('content') }}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @if (session()->get('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @elseif(session()->get('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

</body>
