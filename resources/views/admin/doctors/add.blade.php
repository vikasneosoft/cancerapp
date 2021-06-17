@extends('admin.layout')
@section('title')
    Add Doctor
@endsection
@section('admin-css')


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
                        <li class="breadcrumb-item active">Add Doctor</li>
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
                            <h3 class="card-title">Doctor</h3>
                        </div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger danger-message">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {{ Form::open(['method' => 'POST', 'id' => 'add-form']) }}
                        @include('admin.doctors.formElements',['submitButtonText' => 'Add'])
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
            $("#add-form").validate({
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
                        data: $('#add-form').serialize(),
                        url: "{{ route('admin.addDoctor') }}",
                        beforeSend: function() {
                            $("#loadingImage").show();
                        },
                        success: function(data) {
                            $("#loadingImage").hide();
                            if (data.success == true) {
                                window.location = "getDoctors";
                            }
                            if (data.success == false) {
                                window.location = "getDoctors";
                            }
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