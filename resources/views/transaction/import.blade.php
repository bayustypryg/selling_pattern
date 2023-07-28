@extends('layouts.app')
@section('content')
    <div class="card col-6 mx-auto">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{$title}}</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('transaction.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="file" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="progress mb-3" style="display: none">
                    <div class="progress-bar progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary btn-block">Import</button>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('form').submit(function (event) {
                event.preventDefault();

                var form = $(this);
                var formData = new FormData(form[0]);

                // Tampilkan progress bar
                var progressBar = $('.progress');
                progressBar.show();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total * 90;
                                progressBar.find('.progress-bar').css('width', percentComplete + '%');
                                progressBar.find('.progress-bar').attr('aria-valuenow', percentComplete); // Perbarui nilai aria-valuenow
                                console.log(percentComplete);
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        // Animasi progress bar selesai
                        var percentComplete = 100;
                        progressBar.find('.progress-bar').css('width', percentComplete + '%');
                        progressBar.find('.progress-bar').attr('aria-valuenow', percentComplete);

                        // Proses berhasil, tampilkan alert sukses
                        swal({
                            title: "Success!",
                            text: "Berhasil import data!",
                            icon: "success",
                            button: "OK!",
                        }).then(function () {
                            // Redirect ke halaman 'transaction' setelah alert ditutup
                            window.location.href = '{{ route('transaction') }}';
                        });
                    },
                    error: function (xhr, status, error) {
                        // Proses gagal, tampilkan alert error
                        alert('Upload gagal. Silakan coba lagi.');
                    },
                    complete: function () {
                        // Setelah proses selesai, sembunyikan progress bar
                        progressBar.hide();
                    }
                });
            });
        });
    </script>
    
@endsection
