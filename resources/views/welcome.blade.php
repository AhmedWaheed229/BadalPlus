@extends('layouts.app')

@section('content')


        <!-- start welcome section-->
    <section class="welcome-section p-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="welcome-text wow fadeInUp" data-wow-delay="0.3s">
                        <h1>{{$welcome_title->content}}</h1>
                        <ul class="welcome-list">
                            @foreach($welcome_list as $list)
                                <li>{{$list->content}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 answering rounded-4">
                    <form> 
                        <div class="change-btn">
                            <div class="active">Buy</div>
                            <div>Sell</div>
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
                                <span>1 BTC  =</span><span>24,566.26 USD</span><i class="fa-sharp fa-solid fa-arrow-trend-up"></i>
                            </div>
                        </div>

                        <div class="dropdown dropdown-2">
                            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('images/pay-with.png')}}" width="90%" alt="">
                            </a>
                            <ul class="dropdown-menu" data-popper-placement="bottom-start">
                                <li><a class="dropdown-item" href="#">test 1</a></li>
                                <li><a class="dropdown-item" href="#">test 2</a></li>
                                <li><a class="dropdown-item" href="#">test 3</a></li>
                            </ul>
                            <div class="currency">
                                <span>Pay with</span>
                            </div>
                        </div>

                        
                        <div class="dropdown dropdown-3 dropdown-show">
                            <h1></h1>
                            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Show All
                            </a>
                            <ul class="dropdown-menu" data-popper-placement="bottom-start">
                                <li><a class="dropdown-item" href="#">test 1</a></li>
                                <li><a class="dropdown-item" href="#">test 2</a></li>
                                <li><a class="dropdown-item" href="#">test 3</a></li>
                            </ul>
                        </div>


                        <div class="dropdown dropdown-4 dropdown-show">
                            <h2>I want to spend</h2>
                            <h1></h1>
                            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                EGP
                            </a>
                            <ul class="dropdown-menu" data-popper-placement="bottom-start">
                                <li><a class="dropdown-item" href="#">test 1</a></li>
                                <li><a class="dropdown-item" href="#">test 2</a></li>
                                <li><a class="dropdown-item" href="#">test 3</a></li>
                            </ul>
                            <h3 class="pos">Minimum: 10 EGP</h3>
                        </div>

                        <button type="submit" class="form-btn">Find Offers</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end welcome section-->


    <!--  end services  -->
    <section class="services">
        <div class="container">
            <div class="services-heading text-center wow fadeInUp" data-wow-delay=".3s">
                <p>{{ __('our services') }}</p>
                <h3>
                    {{ __("online services for your entertainment") }}
                </h3>
            </div>

            <div class="row justify-content-between align-items-center">
                @foreach ($main_categories as $c)
                    <div class="col-md-6">
                        <div class="service first wow fadeInUp" data-wow-delay=".3s">
                            <img class="img-fluid" src="{{ $c->image_url }}" alt="">
                            <a href="{{route("browse", ["category"=>$c->id])}}">{{ $c->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--  end services  -->

    <!--  start why  -->
    <section class="why">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="why-content">
                        <div class="why-heading wow fadeInUp" data-wow-delay=".3s">
                            <p>{{ __("Why to choose us") }}</p>
                            <h3>{{__("We connect our customers with the best, and help them keep up-and stay open")}}.</h3>
                        </div>
                        <div class="why-list">
                            <ul>
                                @foreach ($why_us as $index=>$why)
                                    <li data-bs-toggle="collapse"
                                        data-bs-target="#multiCollapseExample{{ $why->id }}"
                                        aria-expanded="@if($index == 0) true @else false @endif"
                                        aria-controls="#multiCollapseExample{{ $why->id }}" type="button">
                                        <img class="icon" src="{{ $why->icon_url }}" alt="">
                                        {{ $why->title }}

                                        <div class="collapse" id="multiCollapseExample{{ $why->id }}">
                                            <div class="mt-3 mx-4">
                                                {{ $why->description }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="why-increases">
                        <div class="why-background wow fadeInUp" data-wow-delay=".3s">
                            <img src="images/why.png" alt="">
                        </div>
                        <div class="why-increases-value wow fadeInUp" data-wow-delay=".5s">
                            <img src="images/pie_graph.png" alt="">
                            <h4>30% {{ __("increases") }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  end why  -->

    <!--  start customer say  -->
    <section class="customer-say">
        <div class="container">
            <div class="customer-say-heading text-center wow fadeInUp" data-wow-delay=".3s">
                <h3>{{ __("What our customers say?") }}</h3>
            </div>

            <div class="customer-slider wow fadeInUp" data-wow-delay=".5s">
                <div class="customer-item">
                    <p>
                        “Buyer buzz partner network disruptive non-disclosure agreement business”
                    </p>
                    <div class="d-flex justify-content-between ">
                        <div class="customer-img">
                            <img src="images/customer_1.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Albus Dumbledore</h6>
                            <p>Manager@Howarts</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Learning curve infrastructure value proposition advisor strategy user experience hypotheses
                        investor.”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_2.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Severus Snape</h6>
                            <p>Manager@Snape</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Release facebook responsive web design business model canvas seed money monetization.”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_3.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Harry Potter</h6>
                            <p>Team Leader @ Gryffindor</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Buyer buzz partner network disruptive non-disclosure agreement business”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_1.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Albus Dumbledore</h6>
                            <p>Manager@Howarts</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Learning curve infrastructure value proposition advisor strategy user experience hypotheses
                        investor.”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_2.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Severus Snape</h6>
                            <p>Manager@Snape</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Release facebook responsive web design business model canvas seed money monetization.”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_3.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Harry Potter</h6>
                            <p>Team Leader @ Gryffindor</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Buyer buzz partner network disruptive non-disclosure agreement business”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_1.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Albus Dumbledore</h6>
                            <p>Manager@Howarts</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Learning curve infrastructure value proposition advisor strategy user experience hypotheses
                        investor.”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_2.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Severus Snape</h6>
                            <p>Manager@Snape</p>
                        </div>
                    </div>
                </div>
                <div class="customer-item">
                    <p>
                        “Release facebook responsive web design business model canvas seed money monetization.”
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="customer-img">
                            <img src="images/customer_3.png" alt="">
                        </div>
                        <div class="customer-info">
                            <h6>Harry Potter</h6>
                            <p>Team Leader @ Gryffindor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  end customer say  -->

@endsection
