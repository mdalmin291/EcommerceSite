<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    {{-- <title>Invoice</title> --}}
    <title>{{ $title ?? '' }}</title>
    <base href="/" />
    <style>
        h6 {
            margin: 0px;
            padding: 0px;
            font-size: 11px;
            font-weight: normal;
        }

        body {
            font-family: tahoma;
            font-size: 11px;
            margin: 0px;
            padding: 16px;
        }

        #invoice_page {
            padding-top: 0px;
            width: 100%;
            height: 0px;
        }

        table {
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
        }

        .inv_item_row {
            /*border-bottom:1px solid gray;*/
        }

        .inv_item_row td,
        .inv_item_row th {
            padding: 0px 0px;
        }

    </style>

    <style>
        .stylefortable {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .styleforth {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .stylefortd {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .move {
            position: absolute;
            right: 79px;
        }

        .receipt {
            position: absolute;
            top: 32px;
            font-size: large;
            color: crimson;
        }

        .company {
            position: relative;
            top: 15px;
            left: 30px;
        }

        .purchase-position {
            position: relative;
            top: 0px;
            left: 14px;
        }

        .sale-purchase-position {

            position: relative;
            left: 0px;
        }

        .sale-purchase-position-one {
            position: relative;
            left: 30px;
            bottom: 10px;
        }

        .quotation-position-one {
            position: relative;
            left: 41px;
            top: 42px;
        }

        .requisition-position-one {
            position: relative;
            left: 101px;
            top: 42px;
        }

        .requisition-position-two {
            position: relative;
            top: 42px;
        }





        }

    </style>

    <script>
        window.print();
    </script>
</head>

<body>
    {{ $slot }}
</body>

</html>
