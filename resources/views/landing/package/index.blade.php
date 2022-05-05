@extends('layouts.landing.index')
@section('content')

    <div id="package" class="package content-config " style="min-height: 60vh">
        <div class="container bg-white my-5 py-3">

            <div class="row" id="packageList">
                <div class="col-lg-2 col-sm-12 col-12">
                    <div class="package-item" id="free">
                        <h6 class="package-title">Free</h6>

                        <ul class="package-list">
                            <li class="package-list-item package-list-active" onclick="clickHandler()">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>

                                <span>view members directory</span>

                            </li>
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>
                                    view members profile
                                </span>

                            </li>
                            <li class="package-list-item package-list-inactive">
                                <span class="iconify icon" data-icon="emojione-monotone:cross-mark" data-width="20"
                                      data-height="20"></span>
                                <span>send 1 private message</span>


                            </li>
                            <li class="package-list-item package-list-inactive">
                                <span class="iconify icon" data-icon="emojione-monotone:cross-mark" data-width="20"
                                      data-height="20"></span>
                                <span>add 1 media to your profile</span>

                            </li>
                        </ul>

                            <h6 class="package-title" id="pacage-title">Free</h6>

                    </div>
                </div>

                <div class="col-lg-2 col-sm-12 col-12">
                    <div class="package-item bronze" id="bronze">
                        <h6 class="package-title">Bronze</h6>

                        <ul class="package-list">
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>

                                <span>view members directory</span>

                            </li>
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>
                                    view members profile
                                </span>

                            </li>
                            <li class="package-list-item package-list-inactive">
                                <span class="iconify icon" data-icon="emojione-monotone:cross-mark" data-width="20"
                                      data-height="20"></span>
                                <span>send 3 private message</span>


                            </li>
                            <li class="package-list-item package-list-inactive">
                                <span class="iconify icon" data-icon="emojione-monotone:cross-mark" data-width="20"
                                      data-height="20"></span>
                                <span>add 3 media to your profile</span>

                            </li>
                        </ul>

                            <h6 class="package-price" id="package-2-price"></h6>

                        <span class="d-block">per month</span>
                        <span class="d-block text-capitalize">unlimited 6 month</span>
                        <span class="d-block text-capitalize">(3 month free)</span>
                        <span class="d-block text-capitalize">7 month billed a payment of 42</span>
                        <button class="btn" id="payBtn2">Buy Now</button>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-12 col-12">
                    <div class="package-item silver">
                        <h6 class="package-title">Silver</h6>
                        <span>popular plan</span>

                        <ul class="package-list">
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>

                                <span>view members directory</span>

                            </li>
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>
                                    view members profile
                                </span>

                            </li>
                            <li class="package-list-item package-list-inactive">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>send 5 private message</span>


                            </li>
                            <li class="package-list-item package-list-inactive">
                                <span class="iconify icon" data-icon="emojione-monotone:cross-mark" data-width="20"
                                      data-height="20"></span>
                                <span>add 5 media to your profile</span>

                            </li>
                        </ul>

                            <h6 class="package-price" id="package-3-price"></h6>

                        <span class="d-block">per month</span>
                        <span class="d-block text-capitalize">unlimited 6 month</span>
                        <span class="d-block text-capitalize">(3 month free)</span>
                        <span class="d-block text-capitalize">7 month billed a payment of 42</span>
                        <button class="btn" id="payBtn3">Buy Now</button>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-12 col-12">
                    <div class="package-item plus">
                        <h6 class="package-title">Plus</h6>
                        <ul class="package-list">
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>

                                <span>view members directory</span>

                            </li>
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>
                                    view members profile
                                </span>

                            </li>
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>send 3 private message</span>


                            </li>
                            <li class="package-list-item package-list-active">
                                <span class="iconify icon" data-icon="emojione-monotone:heavy-check-mark"
                                      data-width="20" data-height="20"></span>
                                <span>add 3 media to your profile</span>

                            </li>
                        </ul>

                        <h6 class="package-price" id="package-4-price"></h6>

                        <span class="d-block">per month</span>
                        <span class="d-block text-capitalize">unlimited 6 month</span>
                        <span class="d-block text-capitalize">(3 month free)</span>
                        <span class="d-block text-capitalize">7 month billed a payment of 42</span>

                        <button class="btn" id="payBtn4">Buy Now</button>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-12 col-12">
                    <div class="private-room">
                        <span>Top Room Private</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payModal2" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h6 class="text-capitalize">Payment: </h6>
                </div>
                <div class="modal-body">

                    <span id="modal-package-name2"></span>
                    <h6 id="modal-package-price2"></h6>

                    <div id="paypal-button-container3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payModal3" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h6 class="text-capitalize">Payment: </h6>
                </div>
                <div class="modal-body">

                    <span id="modal-package-name3"></span>
                    <h6 id="modal-package-price3"></h6>

                    <div id="paypal-button-container2"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payModal4" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h6 class="text-capitalize">Payment: </h6>
                </div>
                <div class="modal-body">

                    <span id="modal-package-name4"></span>
                    <h6 id="modal-package-price4"></h6>

                    <div id="paypal-button-container1"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom-js')
    <script
        src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&currency={{env('PAYPAL_CURRENCY')}}"></script>
    <script>
        const data = [
            {
                price: 8.00,
                package: 'Bronze',
                duration: {
                    unlimited: 6,
                    free: 3
                }
            },
            {
                price: 12.00,
                package: 'Silver',
                duration: {
                    unlimited: 3,
                    free: 1
                }
            },
            {
                price: 15.00,
                package: 'Plus',
                duration: {
                    unlimited: 1
                }
            }
        ]


        $(document).ready(function (){
            data.forEach(item=>{
                if(item.package === 'Bronze'){
                    $('#package-2-price').text('$'+item.price +'.00')
                }
                if(item.package === 'Silver'){
                    $('#package-3-price').text('$'+item.price +'.00')
                }
                if(item.package === 'Plus'){
                    $('#package-4-price').text('$'+item.price +'.00')
                }

            })

        })
        let price = null

        $(document).on('click', '#payBtn2', function (){
            $('#payModal2').modal('show')
            $('#modal-package-name2').text('Package Name: '+ data[0].package)
            $('#modal-package-price2').text('Price: $'+data[0].price+'.00')
            localStorage.setItem('package', JSON.stringify(data[0]))

            price = data[0].price
        })

        $(document).on('click', '#payBtn3', function (){
            $('#payModal3').modal('show')
            $('#modal-package-name3').text('Package Name: '+ data[1].package)
            $('#modal-package-price3').text('Price: $'+data[1].price+'.00')
            localStorage.setItem('package', JSON.stringify(data[1]))

            price = data[1].price
        })
        $(document).on('click', '#payBtn4', function (){
            $('#payModal4').modal('show')
            $('#modal-package-name4').text('Package Name: '+ data[2].package)
            $('#modal-package-price4').text('Price: $'+data[2].price+'.00')
            localStorage.setItem('package', JSON.stringify(data[2]))

            price = data[2].price
        })

        let user = JSON.parse(localStorage.getItem('user'))

        $(document).ready(function () {
            $.ajax({
                url: window.origin + '/api/admin/package',
                type: 'get',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (res) {

                    res.data.forEach(item => {
                        console.log(item)

                        if (item.price) {
                            $('#free #package-title').text(item.price)
                            $('#bronze #package-title').text(item.price)
                        }

                    })


                }, error: function (jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr)
                }
            });
        })


        const paypalButtonsComponent = paypal.Buttons({
            style: {
                color: "gold",
                shape: "rect",
                layout: "vertical"
            },

            createOrder: (data, actions) => {
                const createOrderPayload = {
                    intent: "CAPTURE",
                    purchase_units: [
                        {
                            reference_id: "REFID-000-1001",
                            amount: {
                                value: price
                            }

                        }
                    ],
                };

                return actions.order.create(createOrderPayload);
            },

            onApprove: (data, actions) => {
                const captureOrderHandler = (details) => {
                    let token = localStorage.getItem('accessToken')
                    let list = JSON.parse(localStorage.getItem('package'))
                    $.ajax({
                        url: window.origin + '/api/checkout',
                        type: 'POST',
                        data: list,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': token
                        },
                        success: function (res) {
                            console.log(res)
                        }, error: function (jqXhr, ajaxOptions, thrownError) {
                            console.log(jqXhr)
                        }
                    });
                };
                return actions.order.capture().then(captureOrderHandler);
            },
            onError: (err) => {
                console.error('An error prevented the buyer from checking out with PayPal');
            }
        });

        paypalButtonsComponent
            .render("#paypal-button-container1")
            .catch((err) => {
                console.error('PayPal Buttons failed to render');
            });

        paypalButtonsComponent
            .render("#paypal-button-container2")
            .catch((err) => {
                console.error('PayPal Buttons failed to render');
            });

        paypalButtonsComponent
            .render("#paypal-button-container3")
            .catch((err) => {
                console.error('PayPal Buttons failed to render');
            });
    </script>
@endpush
