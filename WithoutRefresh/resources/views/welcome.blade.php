<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task 1 | HL</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-4">
        <form class="w-50 mx-auto" action="{{ route('upload') }}" method="POST" id="addform"
            enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                    name="email" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Submit</button>
            </div>
        </form>

        <form class="w-50 mx-auto d-none" action="{{ route('edit') }}" method="POST" id="editform"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="editEmail" placeholder="name@example.com" name="email"
                    required>
                <label for="editEmail">Email address</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Update</button>
            </div>
        </form>

        <hr class="my-4">
        <div class="container-fluid mt-4 mb-3">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Sr.#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="data-table-body">
                    @php
                        use App\Models\DataModel;
                        $data = DataModel::all();
                    @endphp
                    @foreach ($data as $record)
                        <tr class="text-center" data-id="{{ $record->id }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $record->email }}</td>
                            <td>
                                <form action="{{ route('delete') }}" method="POST" class="d-inline delform">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $record->id }}">
                                    <button type="submit" class="btn btn-danger"
                                        style="width:100px;">Delete</button>
                                </form>
                                <button class="btn btn-primary edit-btn" style="width:100px;"
                                    data-id="{{ $record->id }}" data-email="{{ $record->email }}">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            // Add Form Submission
            $('#addform').on('submit', function(event) {
                event.preventDefault();
                var inputValue = $('#floatingInput').val();
                $.ajax({
                    url: "{{ route('upload') }}",
                    type: 'POST',
                    data: {
                        email: inputValue,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Data has been processed successfully",
                            timer: 2500,
                            showConfirmButton: false
                        });

                        var newRow = `
                            <tr class="text-center" data-id="${response.id}">
                                <th scope="row">${response.id}</th>
                                <td>${response.email}</td>
                                <td>
                                    <form action="{{ route('delete') }}" method="POST" class="d-inline delform">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="${response.id}">
                                        <button type="submit" class="btn btn-danger" style="width:100px;">Delete</button>
                                    </form>
                                    <button class="btn btn-primary edit-btn" style="width:100px;" data-id="${response.id}" data-email="${response.email}">Edit</button>
                                </td>
                            </tr>`;

                        $('#data-table-body').append(newRow);
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "An unexpected error occurred",
                            timer: 2500,
                            showConfirmButton: false
                        });
                    }
                });
            });

            // Delete Form Submission
            $(document).on('submit', '.delform', function(event) {
                event.preventDefault();
                var form = $(this);
                var recordId = form.find('input[name="id"]').val();
                $.ajax({
                    url: "{{ route('delete') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('tr[data-id="' + recordId + '"]').remove();
                    },
                });
            });

            // Edit Button Click
            $(document).on('click', '.edit-btn', function() {
                var recordId = $(this).data('id');
                var email = $(this).data('email');
                $('#editId').val(recordId);
                $('#editEmail').val(email);
                $('#addform').addClass('d-none');
                $('#editform').removeClass('d-none');
            });

            // Edit Form Submission
            $('#editform').on('submit', function(event) {
                event.preventDefault();
                var recordId = $('#editId').val();
                var inputValue = $('#editEmail').val();
                $.ajax({
                    url: "{{ route('edit') }}",
                    type: 'PUT',
                    data: {
                        id: recordId,
                        email: inputValue,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var row = $('tr[data-id="' + recordId + '"]');
                        row.find('td').eq(0).text(response.email);
                        $('#editform').addClass('d-none');
                        $('#addform').removeClass('d-none');
                    },
                    error: function() {
                        alert('something wrong');
                    }
                });
            });
        });
    </script>
</body>

</html>
