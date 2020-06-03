@extends ('layouts.app')

@section ('content')
 

<div class="container">
        <div class="originalquestion border border-light rounded p-3 col-12 ">
            <div class="row">
                <div class="col-10 my-auto">
                    <h1>{{ $question->title }}</h1>
                    <!--<p>{{ $question->content}}</p>-->
                </div> 
                <div class="col-2">
                    @if($firstImage)
                        {{ $firstImage->img()->attributes(['class' => 'img-fluid rounded', 'alt' => $question->title]) }}
                    @endif
                </div>
            </div>
             <!--@todo: on the caret click, the question should pop down and the paragraph should preview as well as the image which should grow larger-->          
            <div class="row">
                <div class="mx-auto text-center col-10"> 
                    <a class="">
                        <svg class="bi bi-chevron-compact-down mx-auto" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                        </svg>
                    </a> 
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-12 mr-auto ml-auto pt-4">
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Places a texbox on the middle of the image" onclick="spawntext()"><svg class="bi bi-textarea-t" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14 9a1 1 0 100-2 1 1 0 000 2zm0 1a2 2 0 100-4 2 2 0 000 4zM2 9a1 1 0 100-2 1 1 0 000 2zm0 1a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M1.5 2.5A1.5 1.5 0 013 1h10a1.5 1.5 0 011.5 1.5v4h-1v-4A.5.5 0 0013 2H3a.5.5 0 00-.5.5v4h-1v-4zm1 7v4a.5.5 0 00.5.5h10a.5.5 0 00.5-.5v-4h1v4A1.5 1.5 0 0113 15H3a1.5 1.5 0 01-1.5-1.5v-4h1z" clip-rule="evenodd"/>
                        <path d="M11.434 4H4.566L4.5 5.994h.386c.21-1.252.612-1.446 2.173-1.495l.343-.011v6.343c0 .537-.116.665-1.049.748V12h3.294v-.421c-.938-.083-1.054-.21-1.054-.748V4.488l.348.01c1.56.05 1.963.244 2.173 1.496h.386L11.434 4z"/>
                        </svg>
                    </button>               

                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Places a resizable circle on the middle of the image" onclick="spawncircle()"><svg class="bi bi-circle" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Places a straight line on the middle of the image" onclick="spawncircle()"><svg class="bi bi-slash" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Places an arrow on the middle of the image" onclick="spawncircle()"><svg class="bi bi-arrow-up" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Places an arrow on the middle of the image" onclick="spawncube()">RECT
                    </button>

                <div class="float-right">
                    <!--<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Places a texbox on the middle of the image" onclick="spawncircle()"><svg class="bi bi-check" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                        </svg></button>-->
                    <a class="btn btn-primary pt-2 pb-2" href="#" id="color1" onclick="changetextcolor('blue')"><span class="badge  badge-pill badge-primary colorindicator1 float-right">.</span></a>
                    <a class="btn btn-primary pt-2 pb-2" href="#" id="color2" onclick="changetextcolor('green')"><span class="badge badge-pill badge-success colorindicator4 float-right">.</span></a>
                    <a class="btn btn-primary pt-2 pb-2" href="#" id="color3" onclick="changetextcolor('red')"><span class="badge badge-pill badge-danger colorindicator2 float-right">.</span></a>
                    <a class="btn btn-primary pt-2 pb-2" href="#" id="color4" onclick="changetextcolor('white')"><span class="badge badge-pill badge-light colorindicator3 float-right">.</span></a>
                    <a class="btn btn-primary pt-2 pb-2" href="#" id="color5" onclick="changetextcolor('black')"><span class="badge badge-pill badge-dark colorindicator4 float-right">.</span></a>
                    

                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Removes selected element" onclick="removeactiveobject()"><svg class="bi bi-trash" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                        </svg></button>
                </div>         
            </div>
        </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-12"> 
        <canvas class="mt-4 mx-auto border border-light" id="canvas" height="600" width="1000"> 
                            <!-- All the objects and images get spawned here.-->
        </canvas>
    </div>
</div>

@endsection