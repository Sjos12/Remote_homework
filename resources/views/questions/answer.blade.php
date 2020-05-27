@extends ('layouts.app')

@section ('content')
<div class="container">
    <div class="row">
        <div class="originalquestion border border-light rounded p-3 col-12 ">
            <div class="row">
                <div class="col-10">
                    <h1>{{ $question->title }}</h1>
                    <p>{{ $question->content}}</p>
                </div> 
                <div class="col-2">
                @if($firstImage)
                    {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded', 'alt' => $question->title]) }}
                @endif
                </div>
            </div>           
            <div class="row">
            <div class="mx-auto text-center col-10"> 
                    <a class=""><svg class="bi bi-chevron-compact-down mx-auto" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                    </svg></a> 
                </div>
            </div>
        </div> 
    </div>
</div>
    
@endsection