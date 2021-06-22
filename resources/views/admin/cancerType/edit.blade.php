@extends('admin.layout')
@section('title')
    Edit Category
@endsection

@section('admin-content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}"> Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit cancer type</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cancer Type</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::model($cancerType, ['id' => 'edit-form']) }}
                        {{ Form::hidden('action', 'edit') }}
                        {{ Form::hidden('id', $cancerType['id'], ['id' => 'id']) }}
                        @include('admin.cancerType.formElements',['submitButtonText' => 'Update'])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-js')
    <script src="{{ asset('public/common/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/common/js/additional-methods.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#edit-form").validate({
                rules: {
                    name: {
                        required: true,
                        lettersonly: true
                    },
                },
                messages: {
                    name: {
                        required: "Cancer type name is required",
                        lettersonly: "Invalid name format"
                    },
                },
                errorElement: 'span',
                errorClass: 'error',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'PUT',
                        data: $('#edit-form').serialize(),
                        url: "{{ route('cancer.update', '+id+') }}",
                        beforeSend: function() {
                            $("#loadingImage").css({
                                "display": "block"
                            });
                        },
                        success: function(data) {
                            window.location.href =
                                "{{ route('cancer.index') }}";
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $("#loadingImage").css({
                                "display": "none"
                            });
                            $.each(xhr.responseJSON.errors, function(i, obj) {
                                $('input[name="' + i + '"]').closest('.form-group')
                                    .addClass('has-error');
                                $('input[name="' + i + '"]').closest('.form-group')
                                    .find('label.help-block').slideDown(400).html(
                                        obj);
                            });
                        }
                    });
                }
            });
        });
    </script>

@endsection
