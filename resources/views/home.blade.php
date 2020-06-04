@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <style>
        div.dashboard-block {
            min-height: 150px;
            margin: 15px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            box-shadow: 1px -1px 3px 0 grey;
            text-align: center;
        }

        div.dashboard-block h1 {
            color: #ffffff;
            font-weight: bold;
            vertical-align: middle;
            padding-top: 20px;
            font-family: "Raleway", sans-serif;
            font-size: 45px;
        }

        div.dashboard-block p {
            width: 100%;
            left: 0;
            background-color: #ffffff;
            color: #0c0c0c;
            position: absolute;
            bottom: 0;
            margin-bottom: 0;
            padding-top: 10px;
            padding-bottom: 5px;
            font-size: 12px;
        }

        .color-green {
            background: #00ca6d;
        }

        .color-blue {
            background: #00a7d0;
        }

        .color-red {
            background: #dc4735;
        }

        .color-orange {
            background: #ff7702;
        }

        .color-purple {
            background: #9491c4;
        }


        .btn-sq-lg {
            width: 150px !important;
            height: 150px !important;
        }

        .btn-sq {
            width: 100px !important;
            height: 100px !important;
            font-size: 10px;
        }

        .btn-sq-sm {
            width: 50px !important;
            height: 50px !important;
            font-size: 10px;
        }

        .btn-sq-xs {
            width: 25px !important;
            height: 25px !important;
            padding:2px;
        }


        #chartdiv {
            width: 100%;
            height: 500px;
        }


        .take_meals_opt{
            display:block;
            width:150px;
            height:150px;
            text-align: center;
            vertical-align: middle;
            line-height: 150px;
            margin:0 0 0 0;
            padding:10px 21px;
            text-transform:uppercase;
            font-family:'Arial';
            font-weight:400;
            font-size:16px;
            text-transform: uppercase;
            color:white; /*#3e3e3e;*/
            background-image:url({{asset('images/dashboard_icons/idea.svg')}});
            /*border-bottom:1px solid #343434;*/
            transition: all 0.4s ease-in-out;
            -moz-transition: all 0.4s ease-in-out;
            -webkit-transition: all 0.4s ease-in-out;
            -o-transition: all 0.4s ease-in-out;
            float: left;
        }
        .dashboard-cards {
            position: relative;
            padding-bottom: 50px;
            margin: 0 !important;
        }
        .dashboard-cards .card {
            background: #ffffff;
            display: inline-block;
            -webkit-perspective: 1000;
            perspective: 1000;
            z-index: 20;
            padding: 0 !important;
            margin: 5px 5px 10px 5px;
            position: relative;
            text-align: left;
            -webkit-transition: all 0.3s 0s ease-in;
            transition: all 0.3s 0s ease-in;
            z-index: 1;
            width: calc(33.33333333% - 10px);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .dashboard-cards .card:hover {
            box-shadow: 0 15px 10px -10px rgba(31, 31, 31, 0.5);
            transition: all 0.3s ease;
        }
        .dashboard-cards .card .card-title {
            background: #ffffff;
            padding: 20px 15px;
            position: relative;
            z-index: 0;
        }
        .dashboard-cards .card .card-title h2 {
            font-size: 24px;
            letter-spacing: -0.05em;
            margin: 0;
            padding: 0;
        }
        .dashboard-cards .card .card-title h2 small {
            display: block;
            font-size: 14px;
            margin-top: 8px;
            letter-spacing: -0.025em;
        }
        .dashboard-cards .card .card-description {
            position: relative;
            font-size: 14px;
            border-top: 1px solid #ddd;
            padding: 10px 15px 0 15px;
        }
        .dashboard-cards .card .card-actions {
            box-shadow: 0 2px 0px 0 rgba(0, 0, 0, 0.075);
            padding: 10px;
            text-align: center;
        }
        .dashboard-cards .card .card-flap {
            background: #d9d9d9;
            position: absolute;
            width: 100%;
            -webkit-transform-origin: top;
            transform-origin: top;
            -webkit-transform: rotateX(-90deg);
            transform: rotateX(-90deg);
        }
        .dashboard-cards .card .flap1 {
            -webkit-transition: all 0.3s 0.3s ease-out;
            transition: all 0.3s 0.3s ease-out;
            z-index: -1;
        }
        .dashboard-cards .card .flap2 {
            -webkit-transition: all 0.3s 0s ease-out;
            transition: all 0.3s 0s ease-out;
            z-index: -2;
        }
        .dashboard-cards.showing .card {
            cursor: pointer;
            opacity: 0.6;
            -webkit-transform: scale(0.88);
            transform: scale(0.88);
        }
        .dashboard-cards .no-touch .dashboard-cards.showing .card:hover {
            opacity: 0.94;
            -webkit-transform: scale(0.92);
            transform: scale(0.92);
        }
        .dashboard-cards .card.d-card-show {
            opacity: 1 !important;
            -webkit-transform: scale(1) !important;
            transform: scale(1) !important;
        }
        .dashboard-cards .card.d-card-show .card-flap {
            background: #ffffff;
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
        }
        .dashboard-cards .card.d-card-show .flap1 {
            -webkit-transition: all 0.3s 0s ease-out;
            transition: all 0.3s 0s ease-out;
        }
        .dashboard-cards .card.d-card-show .flap2 {
            -webkit-transition: all 0.3s 0.2s ease-out;
            transition: all 0.3s 0.2s ease-out;
        }
        .dashboard-cards .card .task-count {
            width: 40px;
            height: 40px;
            position: absolute;
            top: 22px;
            right: 10px;
            background: #ecf0f1;
            text-align: center;
            line-height: 40px;
            border-radius: 100%;
            color: #333333;
            font-weight: 600;
            transition: all .2s ease;
        }

        // Task List
           .dashboard-cards .task-list {
               padding: 0 !important;
           }
        .dashboard-cards .task-list li {
            padding: 10px 0;
            padding-left: 10px;
            margin: 3px 0;
            list-style-type: none;
            border-bottom: 1px solid #e9ebed;
            border-left: 3px solid #f36525;
            transition: all .2s ease;
        }
        .dashboard-cards .task-list li:hover {
            background: #ecf0f1;
            transition: all .2s ease;
        }
        .dashboard-cards .task-list li span {
            float: right;
            color: #f36525;
            margin-right: 5px;
        }
        .dashboard-cards.showing .card.d-card-show .task-count {
            color: #ffffff;
            background: #f36525;
            transition: all .2s ease;
        }
        .dashboard-cards .card-actions .btn {
            color: #333;
        }
        .dashboard-cards .card-actions .btn:hover {
            color: #f36525;
        }

    </style>
    <div class="row justify-content-between" style="padding-top: 10px;">
        <div class="col-sm-12 col-lg-12">
            <div class="brand-card">
                <div class="brand-card-body">
                    <div >
                        <div class="text-value">P2P Money Transfering Application</div>
                        <div class="text-uppercase text-muted small"> User Dashboard
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.col-->


    </div><!--row-->
    <div class="row justify-content-between" style="padding-top: 10px;">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title" align="center">{{$totalSendCount}}</h3>
                    <h6 class="card-text" align="center">Money Send Requests</h6>
                </div>
            </div>

        </div><!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title" align="center">{{$totalReceiveCount}}</h3>
                    <h6 class="card-text" align="center">Total Money Received </h6>
                </div>
            </div>
        </div><!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title" align="center">{{$totalSendAmount}} LKR</h3>
                    <h6 class="card-text" align="center">Total Amount Sent</h6>
                </div>
            </div>
        </div><!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title" align="center">{{$totalReceiveAmount}} LKR</h3>
                    <h6 class="card-text" align="center">Total Amount Received</h6>
                </div>
            </div>
        </div><!--/.col-->
    </div><!--row-->


@endsection
