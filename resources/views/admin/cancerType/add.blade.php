@extends('admin.layout')
@section('title')
    Add Category
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
                        <li class="breadcrumb-item active">Add cancer type</li>
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
                        {{ Form::open(['id' => 'add-form']) }}
                        @include('admin.cancerType.formElements',['submitButtonText' => 'Add'])
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
                },
                messages: {
                    name: {
                        required: "Cancer type name is required"
                    },
                },
                errorElement: 'span',
                errorClass: 'error_msg errormsges',
                submitHandler: function(form) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        data: $('#add-form').serialize(),
                        url: "{{ route('admin.addCancerType') }}",
                        beforeSend: function() {
                            $("#loadingImage").show();
                        },
                        success: function(data) {
                            $("#loadingImage").hide();
                            if (data.success == true) {
                                window.location = "getCancerTypes";
                            }
                            if (data.success == false) {
                                window.location = "getCancerTypes";
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
