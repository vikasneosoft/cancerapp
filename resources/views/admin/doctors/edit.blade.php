@extends('admin.layout')
@section('title')
    Edit Doctor
@endsection
@section('admin-css')
    <link href="{{ asset('public/common/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('admin-content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Event</li>
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
                            <h3 class="card-title">Event</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::model($doctor, ['method' => 'POST', 'id' => 'edit-form', 'files' => true]) }}
                        {{ Form::hidden('action', 'edit') }}
                        {{ Form::hidden('id', $doctor['id'], ['id' => 'id']) }}
                        @include('admin.doctors.formElements',['submitButtonText' => 'Update'])
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
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    specialization: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Doctor name is required.",
                    },
                    email: {
                        required: "Doctor email is required",
                        email: "Email is not valid"
                    },
                    specialization: {
                        required: "Select at least one option",
                    }
                },
                errorElement: 'span',
                errorClass: 'error_msg errormsges',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#edit-form').serialize(),
                        url: "{{ route('admin.editDoctor') }}",
                        beforeSend: function() {
                            $("#loadingImage").show();
                        },
                        success: function(data) {
                            $("#loadingImage").hide();
                            window.location.href =
                                "{{ route('admin.getDoctors') }}";
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $("#loadingImage").hide();
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
