@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('ID') }}</th>
                        <th scope="col">{{ __('Created') }}</th>
                        <th scope="col">{{ __('Updated') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <th scope="row">{{ $question->title }}</th>
                            <td>{{ $question->state }}</td>
                            <td>{{ $question->uuid }}</td>
                            <td>{{ $question->created_at->toDateTimeString() }}</td>
                            <td>{{ $question->updated_at->toDateTimeString() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
