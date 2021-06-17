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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
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
                        data: $('#edit-form').serialize(),
                        url: "{{ route('admin.editCancerType') }}",
                        beforeSend: function() {
                            $("#loadingImage").show();
                        },
                        success: function(data) {
                            $("#loadingImage").hide();
                            if (data.success == true) {
                                window.location.href =
                                    "{{ route('admin.getCancerTypes') }}";

                            }
                            if (data.success == false) {
                                window.location.href =
                                    "{{ route('admin.getCancerTypes') }}";

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
