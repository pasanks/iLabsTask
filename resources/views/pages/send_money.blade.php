@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="page-header">
                <h4>Send money to an email</h4>
            </div>
        </div>
        <div class="col-md-12">
            <form method="POST" action="{{ route('master.sendMoneyRequest') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Receiver Email  <span style="color: red">*</span></label>
                    <input type="email" name="send_email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                           autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Amount  <span style="color: red">*</span></label>
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Amount"
                           onkeypress ="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                           autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Purpose</label>
                    <textarea class="form-control" name="purpose" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
        <ul>
            <li><i>Fields marked with <span style="color: red">*</span> are mandatory.</i></li>
            <li>Please limit purpose field for 250 characters</li>
        </ul>
    </div>
@endsection
