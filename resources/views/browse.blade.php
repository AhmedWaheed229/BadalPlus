@extends('layouts.app')

@section('content')

 <!--  start browse  -->
    <section class="browse">
        
        <div class="row">
            <div class="col-md-3 browse-form">
                <form> 
                    <div class="form-title">
                        <h1>Buy</h1>
                    </div>
                    <div class="dropdown dropdown-1">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span><img width="25px"  src="{{asset('images/crybto.png')}}"> CryptoCurrency, Wallets. Socialmedia, Games</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                        </ul>
                        <div class="currency">
                            <span>1 BTC  =</span><span>23,493.47 USD</span><i class="fa-sharp fa-solid fa-arrow-trend-up"></i>
                        </div>
                    </div>

                    <div class="dropdown dropdown-z dropdown-3 dropdown-show">
                        <h1 style="width: 80%"><img src="{{asset('images/pay-with.png')}}" width="100%" alt=""></h1>
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <ul class="dropdown-menu" data-popper-placement="bottom-start">
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown dropdown-3 dropdown-show">
                        <h2>Pay via</h2>
                        <h1 style="width: 80%"><img src="{{asset('images/pay-with.png')}}" width="100%" alt=""></h1>
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <ul class="dropdown-menu" data-popper-placement="bottom-start">
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                        </ul>
                    </div>
    
                    <div class="dropdown dropdown-4 dropdown-show">
                        <h2 style="color:black;">I want to spend</h2>
                        <h1></h1>
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            USD
                        </a>
                        <ul class="dropdown-menu" data-popper-placement="bottom-start">
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                            <li><a class="dropdown-item" href="#">test 1</a></li>
                            <li><a class="dropdown-item" href="#">test 2</a></li>
                            <li><a class="dropdown-item" href="#">test 3</a></li>
                        </ul>
                        <h3 class="pos" style="color:black;">Offer owner location</h3>
                    </div>
                    <div class="form-input">
                        <input placeholder="United Kingdom (UK)" type="text">
                    </div>
                    <p class="warning">Release the money to seller only after recceiving (1) confirmation in your wallet</p>
                    <p class="esc-info"><a class="a1" href="#">Click me</a> for more information about our <a class="a2" href="#">escrow AI system</a></p>
                    <button type="submit" class="form-btn">Find Offers</button>
                </form>
            </div>
            <div class="browse-table col-md-9">
                <div class="browse-header">
                    <img src="{{asset('images/posts/2311677381718.png')}}">
                    <h1>Cryptocurrency</h1>
                </div>

                <table>
                    <thead>
                        <tr>
                            <td>Buy from</td>
                            <td>Pay with</td>
                            <td>trade speed</td>
                            <td>Price per Bitcoin <i class="fa-regular fa-circle-question"></i></td>
                            <td><span><i class="fa-solid fa-arrow-down-short-wide"></i></span><span><i class="fa-solid fa-info"></i></span></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="#">Username</a>
                                <span><i class="fa-regular fa-thumbs-up"></i><h2>425</h2></span>
                                <span><i style="color: #3F9F4D;" class="fa-solid fa-circle"></i><h2>Active now</h2></span>
                            </td>
                            <td>
                                <h1>ANY Credit/Debit Card</h1>
                                <h2>5557r5288r5268 TD</h2>
                                <span>50/50 Fee</span>
                            </td>
                            <td>
                                <span><h1>5 min</h1><i class="fa-regular fa-clock"></i></span>
                            </td>
                            <td>
                                <h1>1 USD = 1.01 USD of BTC</h1>
                                <div>
                                    <span><h2>Min purchase:</h2><h3>290 USD</h3></span>
                                    <span><h2>Max purchase:</h2><h3>2,066 USD</h3></span>
                                </div>
                            </td>
                            <td>   
                                <h1>22,863,22 USD</h1>
                                <span><i class="fa-solid fa-arrow-down"></i><h2>1%</h2><ion-icon name="alert"></ion-icon></span>
                                <button>Buy</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </section>
    <!--  end browse  -->
@endsection

@section("scripts")

<script>
    @if(request("category"))
        $(window).load(function(){
            getSubCategories('{{ request("category") }}');
        });
    @endif

    $("#main_categories").change(function(){
        var id = $(this).val();
        getSubCategories(id);
    });

    function getSubCategories($id){
        $.ajax({
            url : '{{ route("web.getSubCategoris") }}',
            type : 'GET',
            data : {id : $id},
            success : function(result){
                var old_cat = "{{ request("sub_category") }}";
                var selected = "";
                var html = '<option value="">{{ __("Choose From Subcategories") }}</option>';
                $.each(result , function(index,val) {
                    old_cat == val.id ? selected = "selected" : selected = "";
                    html += '<option '+ selected +' value="'+ val.id +'">'+ val.name +'</option>';
                });
                $("#sub_categories").html(html);
            }
        });
    }
</script>
@endsection
