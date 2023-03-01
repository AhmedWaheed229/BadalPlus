@extends('dashboard.layouts.app')

@section('title', ' - '.__('wallet'))

@section('content')

    <div class="row">
        <div class="col-12">
            <section class="wallet-dashboard">
                <!-- start wallet dashboard header -->
                <div class="wallet-dashboard-header">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="badge bg-white w-100 mb-3 p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>{{__("Your card")}}</h4>
                                    <a href="{{route("add_balance")}}" class="btn btn-warning">
                                        <img src="{{asset("images/plus.png")}}" alt="">
                                        {{__("Add Balance")}}
                                    </a>
                                </div>
                                <img class="w-100 d-block mx-auto mt-2" style="object-fit: contain; max-height: 200px"
                                     src="{{asset("images/credit-card.png")}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="badge p-3 badge-orange bg-white w-100 mb-3"
                                 style="@if(app()->getLocale() == 'ar') border-right: @else border-left: @endif 2px solid #FC5B00;">
                                <img src="{{asset("images/wallet_1.png")}}" alt="" class="d-block mb-3 mx-auto"
                                     height="80">
                                <p class="text-capitalize">{{__("balance")}} {{__("Total")}}</p>
                                <h4>{{number_format($record->balance, 2)}} {{$record->currency->name ?? ""}}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="badge p-3 badge-yellow bg-white w-100 mb-3"
                                 style="@if(app()->getLocale() == 'ar') border-right: @else border-left: @endif 2px solid #FBD540;">
                                <p>{{__("Earning")}}</p>
                                @php
                                    $earning = $record->soldPosts()
                                    ->with("currency")->groupBy('currency_id')
                                    ->selectRaw('sum(price) as sum, currency_id, id, status,created_by, bought_by')->get();
                                @endphp
                                <h5>
                                    @foreach($earning as $index => $e)
                                        <span style="white-space: nowrap">
                                        {{$e->sum}} {{$e->currency->name ?? ""}}
                                        </span>
                                        @if(count($earning) > ($index+1))
                                            -
                                        @endif
                                    @endforeach
                                </h5>
                            </div>
                            <div class="badge p-3 badge-green bg-white w-100 mb-3"
                                 style="@if(app()->getLocale() == 'ar') border-right: @else border-left: @endif 2px solid #2A7928;">

                                <p>{{__("Spending")}}</p>
                                @php
                                    $spending = $record->boughtPosts()
                                    ->with("currency")->groupBy('currency_id')
                                    ->selectRaw('sum(price) as sum, currency_id, id, status,created_by, bought_by')->get();
                                @endphp
                                <h5>
                                    @foreach($spending as $index => $e)
                                        <span style="white-space: nowrap">
                                        {{$e->sum}} {{$e->currency->name ?? ""}}
                                        </span>
                                        @if(count($spending) > ($index+1))
                                            -
                                        @endif
                                    @endforeach
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end wallet dashboard header -->

                <div class="row">
                    <div class="col-md-6">
                        <!-- start wallet history -->
                        <div id="accordionExample" class="wallet-history accordion mb-4 bg-white alert">
                            <div class="header mb-2 d-flex justify-content-between">
                                <h4>{{__("History")}}</h4>
                                <!-- Nav tabs -->
                                <ul class="nav p-0" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="btn mx-2 btn-warning" id="buying-tab" data-bs-toggle="tab"
                                                data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                            {{__("buying")}}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="btn btn-light" id="buying-tab" data-bs-toggle="tab"
                                                data-toggle="collapse" data-target="#headingTwo"
                                                aria-expanded="true" aria-controls="headingTwo">
                                            {{__("Selling")}}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordionExample">
                                @foreach($record->boughtPosts as $p)
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{$p->image_url}}" class="mx-2 rounded" style="height: 60px; max-width: 100px; object-fit: contain; overflow: hidden" alt="">
                                        <h6 class="w-100">{{$p->title}}</h6>
                                        <div class="badge bg-yellow">{{$p->price}} {{$p->currency->name ?? ""}}</div>
                                    </div>
                                @endforeach
                            </div>

                            <div id="headingTwo" class="collapse" aria-labelledby="headingTwo"
                                 data-parent="#accordionExample">
                                @foreach($record->soldPosts as $p)
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{$p->image_url}}" class="mx-2 rounded" style="height: 60px; max-width: 100px; object-fit: contain; overflow: hidden" alt="">
                                        <h6 class="w-100">{{$p->title}}</h6>
                                        <div class="badge bg-yellow">{{$p->price}} {{$p->currency->name ?? ""}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end wallet history -->
                    </div>

                    <div class="col-md-6">
                        <!-- start wallet Statistic -->
                        <div class="wallet-history wallet-statistic mb-4 bg-white p-3 rounded">
                            <div class="header mb-2 d-flex justify-content-between">
                                <h4>{{__("Statistic")}}</h4>
                                <!-- Nav tabs -->
                                <ul class="nav p-0" id="statistic" role="tablist">
                                    <li class="nav-item">
                                        <button class="btn mx-2 btn-warning" data-toggle="earning">{{__("Earning")}}</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="btn btn-light" data-toggle="spending">{{__("Spending")}}</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="earning">
                                    <canvas id="earningChart"></canvas>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="spending">
                                    <canvas id="spendingChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const labels = [
            @foreach($earning as $p)
                "{{ $p->currency->name ?? '' }}",
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: '{{__("Earning")}}',
                backgroundColor: 'transparent',
                borderColor: '#FCD441',
                data: [@foreach($earning as $p) {{$p->sum}},  @endforeach],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        new Chart(
            document.getElementById('earningChart'),
            config
        );

        const s_labels = [
            @foreach($spending as $p)
                "{{ $p->currency->name ?? '' }}",
            @endforeach
        ];
        const s_data = {
            labels: s_labels,
            datasets: [{
                label: '{{__("Spending")}}',
                backgroundColor: 'transparent',
                borderColor: '#FCD441',
                data: [@foreach($spending as $p) {{$p->sum}},  @endforeach],
            }]
        };

        const s_config = {
            type: 'line',
            data: s_data,
            options: {}
        };
        new Chart(
            document.getElementById('spendingChart'),
            s_config
        );

        $("#statistic button").click(function () {
            var div = $(this).data('toggle');
            $(document).find("#"+div).addClass("active").siblings().removeClass("active");
        });
    </script>
@endsection
