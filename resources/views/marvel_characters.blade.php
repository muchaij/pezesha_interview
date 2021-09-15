@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-3 pb-3">
        <div class="col-sm-12">
            <h5>Marvel Characters</h5>
            <hr>
        </div>
        <div class='col-sm-12 results'>
            <div>
                Loading... Please wait!
            </div>
        </div>
        <div class='col'>
            <button class='btn btn-primary btnPrev'>Prev</button>
        </div>
        <div class="col text-center items">
            Loading items
        </div>
        <div class='col text-right'>
            <button class='btn btn-primary btnNext'>Next</button>
        </div>

    </div>
</div>
@endsection
    @push('js')
    <script>
        $(document).ready(function(){
            $('.navbar').removeClass('bg-dark');
            $('.navbar').removeClass('navbar-dark');
            $('.navbar').removeClass('fixed-top');
            $('.navbar').addClass('navbar-light');
            $('.navbar').addClass('bg-light');
            $('.navbar').addClass('shadow-sm');
            var offset = 0;
            var totals = 0;
            var pages = 0;
            getCharacters();
            function getCharacters(){
                $.ajax({
                    url: "{{ url('get/marvel/characters') }}?offset="+offset,
                    type: "GET",
                }).done(function(data){
                    var results = JSON.parse(data);
                    totals = parseInt(results.data.total);
                    offset = parseInt(results.data.offset);
                    pages = Math.ceil(totals/parseInt(results.data.count));
                    $('.items').html("Page "+(offset+1)+" of "+pages+" Page(s)");
                    $('.results').html("");
                    $.each(results.data.results, function(index, item){
                        $('.results').append(
                            '<div class="row bg-white border mt-1 pt-1 pb-1 mb-2">'+
                                '<div class="col-sm-6 col-md-3">'
                                    +'<img src="'+item.thumbnail.path+"."+item.thumbnail.extension+'" class="img-fluid">'
                                +'</div>'
                                +'<div class="col-sm-6 col-md-9">'
                                    +"<h5>"+item.name+"</h5>"
                                    +"<span class='text-muted'>Modified On: "+item.modified+"</span>"
                                    +"<p>"+item.description+"</p>"
                            +'</div></div>');
                    });
                });
            }
            $('.btnNext').click(function(){
                if(pages>offset){
                    offset++;
                    getCharacters();
                }
            });
            $('.btnPrev').click(function(){
                if(offset>0){
                    offset--;
                    getCharacters();
                }
            });
        });
    </script>
@endpush
