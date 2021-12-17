@extends('layouts.dashboard')
@section('content')

<div class="content-box">

    <div class="row">

        <div class="col-lg-6">
            <div class="element-wrapper">
                <h6 class="element-header">
                Section 1 - Text and button
                </h6>
                <div class="element-box">
                <form method="POST" action="{{ route('update.ui.section1.text') }}">
                @csrf
                    <div class="form-group">
                    <label for=""> Heading</label><textarea class="form-control" rows="3" name="set1_h">{{ $set->set1_h }}</textarea>
                    </div>
                    <div class="form-group">
                    <label for=""> Body Text</label><input class="form-control" value="{{ $set->set1_p }}" name="set1_p" type="text">
                    </div>

                    <hr>

                    <div class="row">
                        <div style="padding: 10px;">
                            <p>if you want to use rout directory then you can use <span style="color: red;">"/"</span> Otherwise write full http link</p>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Button 1 Text</label><input class="form-control" value="{{ $set->set1_b1_text }}" name="set1_b1_text" type="text" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Button 1 Link</label><input class="form-control" value="{{ $set->set1_b1_link }}" name="set1_b1_link" type="text" required>                                
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Button 2 Text</label><input class="form-control" value="{{ $set->set1_b2_text }}" name="set1_b2_text" type="text" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for=""> Button 2 Link</label><input class="form-control" value="{{ $set->set1_b2_link }}" name="set1_b2_link" type="text" required>                                
                            </div>
                        </div>

                    
                    </div>
                    
                    <div class="form-buttons-w">
                    <button type="submit" onclick="section1text(this)" class="btn btn-primary">Save Change</button>
                    <div id="section1textpro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                    <script>
                    const section1text = (element) => {
                        element.hidden = true;                                                    
                        document.getElementById('section1textpro').style.display = "block";
                        
                    }
                    </script>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="element-wrapper">
                <h6 class="element-header">
                Section 1 - Widget
                </h6>
                <div class="element-box">
                        <form method="POST" action="{{ route('update.ui.section1.widget') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for=""> Widget Preview</label><br>
                            {!! $set->set1_widget !!}
                        </div><br><br>
                        
                        <div class="form-group">
                            <label for=""> Change Widget Code</label><input class="form-control" name="set1_widget" value="{{$set->set1_widget}}" type="text">                        
                        </div>                    
                        <div class="form-buttons-w">
                            <button type="submit" onclick="section1widget(this)" class="btn btn-primary">Save Change</button>
                            <div id="section1widgetpro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                            <script>
                            const section1widget = (element) => {
                                element.hidden = true;                                                    
                                document.getElementById('section1widgetpro').style.display = "block";
                                
                            }
                            </script>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <hr><br><br>

            <div class="col-lg-12">
                <div class="element-wrapper">
                    <h6 class="element-header">
                    Section 2 - Text and Icons
                    </h6>
                    <div class="element-box">
                    <form method="POST" action="{{ route('update.ui.section2.all') }}">
                    @csrf
                        <div class="form-group">
                        <label for=""> Heading</label><input class="form-control" value="{{ $set->set2_h }}" type="text" name="set2_h">
                        </div>

                        <hr>

                        <div class="row">
                            <div style="padding: 10px;">
                                <p>Please choose your favorite icon code from <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank">Font Awsome</a> You just need to paste here full code including <span style="color: red;">"li"</span> Tag</p><br>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 1 - Icon Code</label><input class="form-control" value="{{ $set->set2_cat1_icon }}" name="set2_cat1_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 1 - Text</label><input class="form-control" value="{{ $set->set2_cat1_text }}" name="set2_cat1_text" type="text" required>                                
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 2 - Icon Code</label><input class="form-control" value="{{ $set->set2_cat2_icon }}" name="set2_cat2_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 2 - Text</label><input class="form-control" value="{{ $set->set2_cat2_text }}" name="set2_cat2_text" type="text" required>                                
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 3 - Icon Code</label><input class="form-control" value="{{ $set->set2_cat3_icon }}" name="set2_cat3_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 3 - Text</label><input class="form-control" value="{{ $set->set2_cat3_text }}" name="set2_cat3_text" type="text" required>                                
                                </div>
                            </div>

                        
                        </div>
                        
                        <div class="form-buttons-w">
                        <button type="submit" onclick="section2text(this)" class="btn btn-primary">Save Change</button>
                        <div id="setting2pro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                        <script>
                        const section2text = (element) => {
                            element.hidden = true;                                                    
                            document.getElementById('setting2pro').style.display = "block";
                            
                        }
                        </script>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">

                <div class="element-wrapper">
                    <h6 class="element-header">
                    Section 3 - Text and Icons
                    </h6>
                    <div class="element-box">
                    <form method="POST" action="{{ route('update.ui.section3.text.icons') }}">
                    @csrf
                        <h5 class="form-header">
                            Use HTML Code
                        </h5>
                        <div class="form-desc">
                            <p style="font-size: 12px; color: gray;">Please write HTML Formate, and you can use any HTML tags like <span style="color: red;">"p" / "href" / "strong" or "span"</span> etc. And choose your favorite icon code from <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank">Font Awsome</a> You just need to paste here full code including <span style="color: red;">"li"</span> Tag</p>  
                        </div>
                        <div class="form-group">
                        <label for=""> Heading</label><input class="form-control" value="{{ $set->set3_h }}" type="text" name="set3_h" required>
                        </div>

                        <div class="form-group">
                        <label for=""> Sub Heading</label><input class="form-control" value="{{ $set->set3_p }}" type="text" name="set3_p" required>
                        </div>

                        <div class="row">
                            <!-- Catagories -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 1 - Icon Code</label><input class="form-control" value="{{ $set->set3_cat1_icon }}" name="set3_cat1_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 1 - Heading</label><input class="form-control" value="{{ $set->set3_cat1_h }}" name="set3_cat1_h" type="text" required>                                
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""> Catagories 1 - Sub Text</label><textarea class="form-control" name="set3_cat1_p" rows="3"  required>{{ $set->set3_cat1_p }}</textarea>                              
                                </div>
                            </div>
                            <!-- Catagories -->
                            
                            <!-- Catagories -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 2 - Icon Code</label><input class="form-control" value="{{ $set->set3_cat2_icon }}" name="set3_cat2_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 2 - Heading</label><input class="form-control" value="{{ $set->set3_cat2_h }}" name="set3_cat2_h" type="text" required>                                
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""> Catagories 2 - Sub Text</label><textarea class="form-control" name="set3_cat2_p" rows="3"  required>{{ $set->set3_cat2_p }}</textarea>                             
                                </div>
                            </div>
                            <!-- Catagories -->

                            <!-- Catagories -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 3 - Icon Code</label><input class="form-control" value="{{ $set->set3_cat3_icon }}" name="set3_cat3_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 3 - Heading</label><input class="form-control" value="{{ $set->set3_cat3_h }}" name="set3_cat3_h" type="text" required>                                
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""> Catagories 3 - Sub Text</label><textarea class="form-control" name="set3_cat3_p" rows="3"  required>{{ $set->set3_cat3_p }}</textarea>                                
                                </div>
                            </div>
                            <!-- Catagories -->

                            <!-- Catagories -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 4 - Icon Code</label><input class="form-control" value="{{ $set->set3_cat4_icon }}" name="set3_cat4_icon" type="text" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""> Catagories 4 - Heading</label><input class="form-control" value="{{ $set->set3_cat4_h }}" name="set3_cat4_h" type="text" required>                                
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""> Catagories 4 - Sub Text</label><textarea class="form-control" name="set3_cat4_p" rows="3"  required>{{ $set->set3_cat4_p }}</textarea>                                
                                </div>
                            </div>
                            <!-- Catagories -->

                        
                        </div>
                        
                        <div class="form-buttons-w">
                        <button type="submit" onclick="section3all(this)" class="btn btn-primary">Save Change</button>
                        <div id="setting3allpro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                        <script>
                        const section3all = (element) => {
                            element.hidden = true;                                                    
                            document.getElementById('setting3allpro').style.display = "block";
                            
                        }
                        </script>
                        </div>
                    </form>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="element-wrapper">
                    <h6 class="element-header">
                    Section 3 - Image
                    </h6>
                    <div class="element-box">
                            <form method="POST" action="{{ route('update.ui.section3.image') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for=""> Image Preview</label><br>
                                <img alt="" width="300px" src="/img/frontend/{{ $set->set3_image }}">
                            </div><br><br>
                            
                            <div class="form-group">
                                <label for=""> Change Image</label><input class="form-control" name="image" type="file" required>                        
                            </div>                    
                            <div class="form-buttons-w">
                                <button type="submit" onclick="setting3image(this)" class="btn btn-primary">Save Change</button>
                                <div id="setting3imagepro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                                <script>
                                const setting3image = (element) => {
                                    element.hidden = true;                                                    
                                    document.getElementById('setting3imagepro').style.display = "block";
                                    
                                }
                                </script>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <hr><br><br>

            <div class="col-lg-12">
                <div class="element-wrapper">
                    <h6 class="element-header">
                    Section 4 - Text and Icons
                    </h6>
                    
                    <div class="element-box">
                    <form method="POST" action="{{ route('update.ui.section4.text.icons') }}">
                    @csrf
                        <div class="form-group">
                        <label for=""> Heading</label><input class="form-control" value="{{ $set->set4_h }}" type="text" name="set4_h" required>
                        </div>

                        <div class="form-group">
                        <label for=""> Sub Heading</label><input class="form-control" value="{{ $set->set4_p }}" type="text" name="set4_p" required>
                        </div>

                        <hr>

                        
                            <div style="">
                                <p>Please choose your favorite icon code from <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2" target="_blank">Font Awsome</a> You just need to paste here full code including <span style="color: red;">"li"</span> Tag</p><br>
                            </div>

                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for=""> Catagories 1 - Icon Code</label><input class="form-control" value="{{ $set->set4_cat1_icon }}" name="set4_cat1_icon" type="text" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for=""> Catagories 1 - Text</label><input class="form-control" value="{{ $set->set4_cat1_h }}" name="set4_cat1_h" type="text" required>                                
                                    </div>
                                
                                    <div class="form-group">
                                        <label for=""> Catagories 1 - Sub Text</label><input class="form-control" value="{{ $set->set4_cat1_p }}" name="set4_cat1_p" type="text" required>
                                    </div>                                
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for=""> Catagories 2 - Icon Code</label><input class="form-control" value="{{ $set->set4_cat2_icon }}" name="set4_cat2_icon" type="text" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for=""> Catagories 2 - Text</label><input class="form-control" value="{{ $set->set4_cat2_h }}" name="set4_cat2_h" type="text" required>                                
                                    </div>
                                
                                    <div class="form-group">
                                        <label for=""> Catagories 2 - Sub Text</label><input class="form-control" value="{{ $set->set4_cat2_p }}" name="set4_cat2_p" type="text" required>
                                    </div>                                
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for=""> Catagories 3 - Icon Code</label><input class="form-control" value="{{ $set->set4_cat3_icon }}" name="set4_cat3_icon" type="text" required>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for=""> Catagories 3 - Text</label><input class="form-control" value="{{ $set->set4_cat3_h }}" name="set4_cat3_h" type="text" required>                                
                                    </div>
                                
                                    <div class="form-group">
                                        <label for=""> Catagories 3 - Sub Text</label><input class="form-control" value="{{ $set->set4_cat3_p }}" name="set4_cat3_p" type="text" required>
                                    </div>                                
                                </div>

                            </div>

                        
                        <div class="form-buttons-w">
                        <button type="submit" onclick="section4texticon(this)" class="btn btn-primary">Save Change</button>
                        <div id="setting4textpro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                        <script>
                        const section4texticon = (element) => {
                            element.hidden = true;                                                    
                            document.getElementById('setting4textpro').style.display = "block";
                            
                        }
                        </script>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

    </div>



</div>

@endsection