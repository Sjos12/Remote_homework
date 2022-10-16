<template>
    <div class="container card vh-150">
        <!-- @if ($errors->any())
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sm-offset-md-2">
                <div class="alert alert-danger" role="alert">
                    @if($errors->has('general'))
                        {{ __('Error occurred while saving:') }}
                        <ul>
                            @foreach($errors->get('general') as $general_error)
                                <li>{{ $general_error }}</li>
                            @endforeach
                        </ul>
                        <br/>
                    @endif
                    {{ __('Check form for field errors') }}
                </div>
            </div>
        </div>
    @endif -->

        <div class="d-flex justify-content-center mb-4">
            <span class="circle"><h1>1</h1></span>
            <span class="circle"><h1>2</h1></span>
        </div>

        <form enctype="multipart/form-data" id="myDropzone">
            <!-- <div class="tab">
                    <div class="row">
                        <div class="form-group col-12 col-md-8 offset-md-2">
                            <h4 class="text-center">
                                Choose your question type
                            </h4>
                            <div class="d-flex justify-content-center">
                                <h1
                                    type="button"
                                    class="title6 font-white typebtn activebtn"
                                    onclick="questionType(1)"
                                >
                                    Public
                                </h1>
                                <h1
                                    type="button"
                                    class="title6 font-white typebtn"
                                    onclick="questionType(2)"
                                >
                                    Private
                                </h1>
                            </div>
                            <div class="type">
                                <h4>Choose a category</h4>
                                                        
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="d-flex my-4"><input type="checkbox" name="categories[]" value="{{$category->id}}"><p class="m-0 ml-2 ">{{ $category->category }}</p></li>
                                    @endforeach
                                </ul>
                              
                            </div>

                            <div class="type">
                                <h4>Choose a receiver</h4>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="receiver"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="">
                <div class="row">
                    <div class="form-group col-12 col-md-8 offset-md-2">
                        <label for="title">Question Title</label>
                        <input
                            type="text"
                            class="title6 form-control"
                            id="title"
                            name="title"
                            aria-describedby="titleHelp"
                            value="{{ old('title') }}"
                        />
                        <!-- @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror -->
                    </div>

                    <div class="form-group col-12 col-md-8 offset-md-2">
                        <label for="content"> Your Question </label>
                        <textarea
                            id="content"
                            class="form-control contentarea"
                            rows="5"
                            name="content"
                            aria-describedby="contentHelp"
                        ></textarea>
                        <small id="contentHelp" class="form-text text-muted">
                            Describe in as much detail as possible exactly the
                            question you have
                        </small>
                        <!-- @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import LayoutVue from "../Layouts/Layout.vue";
export default {
    layout: LayoutVue,
};
</script>