@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="page-header">
                <h4>Sent Money Summary Report</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped" id="received-money-table">
                    <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Sent to</th>
                        <th>Amount</th>
                        <th>Purpose</th>
                        <th>Sent Date</th>
                    </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div>
    </div>
{{--    //DATATBLE AJAX INITIATING--}}
    <script>
        $(document).ready( function () {

            var table = $('#received-money-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                paging:false,
                ajax: "{!! route('master.sendMoneyReport_getDataForDT') !!}",
                columns: [
                    { data: 'transaction_key' },
                    { data: 'send_email' },
                    { data: 'amount' },
                    { data: 'purpose' },
                    { data: 'created_at' }
                ],
            });
        });
    </script>
@endsection
