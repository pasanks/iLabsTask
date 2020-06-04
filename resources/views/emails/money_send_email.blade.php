<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
        }
        tr, td {
            padding: 5px;
            margin: 0;
        }

        .header {
            background: #8a8a8a;
        }
        .header .columns {
            padding-bottom: 0;
        }
        .header p {
            color: #fff;
            margin-bottom: 0;
        }
        .header .wrapper-inner {
            padding: 20px; /*controls the height of the header*/
        }
        .header .container {
            background: #8a8a8a;
        }
        .wrapper.secondary {
            background: #f3f3f3;
        }

    </style>
</head>
<body>
<container>

    <spacer size="16"></spacer>

    <row>
        <columns>

            <h2> Hi {{$receiver}},</h2>
            <p class="lead">You got money from <b>{{$sent_user}}</b> on {{$datetime}}.</p>

            <p class="lead">Please follow below mentioned web link to complete money receive.</p>

            <p class="lead"><b>Transaction ID :  {{$transaction_key}}</b></p>
            <p class="lead"><b>Link :  {{$webLink}}</b></p>

            <p class="lead">If you do not aware about this activity please contact us on below contact details. </p>

            <br>
            <p class="lead">Regards,</p>
            <p class="lead"><b>P2P Money Send</b></p>

            <callout class="primary">
                <a href="http://www.pasankavinga.com/">Pasan Kavinga</a>
                <p>No. 973, Uluwaththa, Gothatuwa.</p>
                <p><b>T:</b> +94 71 636 7962 | <b>E:</b> pasankavinga@gmail.com | <b>W:</b> www.pasankavinga.com </p>
            </callout>

        </columns>
    </row>
</container>
</body>
</html>
