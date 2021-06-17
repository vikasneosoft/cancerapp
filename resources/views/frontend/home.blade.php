@extends('frontend.layout')
@section('title')
    Dashboard
@endsection
@section('frontend-content')
    <div class="row">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homePage') }}">Home</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="box">
                <h1>Cancer inquiry</h1>
                @include('flash::message')
                <hr>
                <input type="hidden" id="add-inquery-route" value="{{ route('addInquiry') }}">
                {{ Form::open(['id' => 'add-inquery', 'file' => true]) }}
                <div class="form-group">
                    {{ Form::label('name', 'Name: ') }}
                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) }}
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email: ') }}
                    {{ Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) }}
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('contact_number', 'Contact Number: ') }}
                    {{ Form::text('contact_number', null, ['id' => 'contact_number', 'class' => 'form-control', 'maxlength' => 10]) }}
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('state', 'State: ') }}
                    {{ Form::text('state', null, ['id' => 'state', 'class' => 'form-control']) }}
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('city', 'City: ') }}
                    {{ Form::text('city', null, ['id' => 'city', 'class' => 'form-control']) }}
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Address: ') }}
                    {{ Form::text('address', null, ['id' => 'address', 'class' => 'form-control']) }}
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('pincode', 'Pincode: ') }}
                    {{ Form::text('pincode', null, ['id' => 'pincode', 'class' => 'form-control', 'maxlength' => 6]) }}
                    <label class="help-block text-danger"></label>
                </div>

                <div class="form-group">
                    {{ Form::label('cancer_type', 'Cancer type: ', ['class' => 'control-label']) }}
                    @if (count($cancerTypes))
                        {{ Form::select('cancer_type', array_replace(['' => 'Select'], $cancerTypes), null, ['class' => 'form-control', 'id' => 'cancer_type']) }}
                    @else
                        {{ Form::select('cancer_type', ['' => 'Empty'], null, ['class' => 'form-control', 'id' => 'cancer_type']) }}
                    @endif
                    <label class="help-block text-danger"></label>
                </div>
                <div class="form-group">
                    {{ Form::label('document', 'Document: ', ['class' => 'control-label']) }}
                    {{ Form::file('document', ['id' => 'document', 'class' => 'form-control']) }}
                    <label class="help-block text-danger"></label>
                </div>
                <p class="text-danger patient-wrong-credentials"></p>

                <div class="text-right">
                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                </div>


                {{ Form::close() }}
            </div>
        </div>

    </div>
@endsection
@section('frontend-js')
    <script src="{{ asset('public/common/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/common/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/inquery.js') }}"></script>
@endsection
