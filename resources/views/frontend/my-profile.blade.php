@extends('layouts.front_end')
@section('content')
<div>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }
        .fonts{
            font-weight: 600;
        }

        .ml-2{
            margin-left: .5rem;
        }
        .text-sm{
            font-size: .875rem;
        }
        .text-gray-400{
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203,213,224,var(--text-opacity));
        }
        .pb-4{
            padding-bottom: 1rem;
        }
        .w-full{
            width: 100%;
        }
        .mt-4{
            margin-top: 1rem;
        }
        .mt-4{
            margin-top: 1rem;
        }
        .text-gray-700{
            --text-opacity: 1;
             color: #4a5568;
             color: rgba(74,85,104,var(--text-opacity));
        }


        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
    <x-slot name="title">
        My Profile
    </x-slot>
    <x-slot name="header">
        My Profile
    </x-slot>
    <div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-8 order-2 order-lg-0">
                <aside class="shop-sidebar">
                    <div class="widget shop-widget mb-30">
                        <div class="shop-widget-title">
                            <h6 class="title"></h6>
                        </div>
                        <div class="card">
                            <img src="" alt="John" style="width:100%">
                            <h1>John Doe</h1>
                            <p class="title">MD.alamin</p>
                            <p>01843914561</p>
                            <a href="#"><i class="far fa-check-circle"></i>Check Account</a>
                            {{-- <p><button>Contact</button></p> --}}
                        </div>
                        <div class="shop-cat-list">
                            <ul>
                                <li><a href="#"><i class=""></i>Basic Information</a></li>
                                <li><a href="#">Address</a></li>
                                <li><a href="#">Orders</a></li>
                                <li><a href="#">Unconfirmed Orders</a></li>
                                <li><a href="#">Review</a></li>
                                <li><a href="#">Refund Settlement</a></li>
                                <li><a href="#">Change Password</a></li>
                                <li><a href="#">Appoinment</a></li>
                                <li><a href="#">Transaction</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="current balance pb-4">
                            <h4>
                                <span class="fonts">@if($companyInfo) {{$companyInfo->name}} @endif Account</span>
                                <span class="ml-2 text-sm text-gray-400">Your Account Information</span>
                            </h4>
                            <div class="w-full mt-4 mb-6">
                                 <div class="mb-4">
                                     <div class="flex">
                                         <h1 class="text-xl fonts">
                                            ৳ 0.00
                                         </h1>
                                     </div>
                                     <p class="text-gray-700">
                                         Current Balance
                                     </p>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p></p>
                    </div>
                    <div class="col-md-3">
                        <p></p>
                    </div>
                    <div class="col-md-3">
                        <p></p>
                    </div>
                    <div class="col-md-3">
                        <p></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p></p>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection
