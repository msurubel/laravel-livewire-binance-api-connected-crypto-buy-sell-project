@extends('layouts.front')
@section('content')

        <div class="helpdesk-search section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <div class="helpdesk-search-content">
                            <p class="mb-1">{{$page->page_short}}</p>
                            <h2 class="mb-5">{{$page->page_tittle}}</h2>
                            <div class="helpdesk-form">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="troubleshooting section-padding">
            <div class="container">
               <p>{!!$page->page_body!!}</p>
            </div>
        </div>


@endsection