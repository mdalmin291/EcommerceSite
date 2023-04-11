<!DOCTYPE html>

<html>
	<head>
		<meta name="viewport" content="width=device-width" />
		<base href="/" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Shomikaron Barcode</title>
		<!-- Bootstrap -->
		<link href="{{ asset('assets/barcode/') }}/bootstrap.min.css" rel="stylesheet" />
		<link href="{{ asset('assets/barcode/') }}/font-awesome.min.css" rel="stylesheet" />
		<link href="{{ asset('assets/barcode/') }}/custom.min.css" rel="stylesheet" />
		<link href="{{ asset('assets/barcode/') }}/custom.barcode.css" rel="stylesheet" />

	</head>
	<body style="background:white;line-height:12px;color:black;text-align:center;">
		<div class="container">
			<div class="row">
				@foreach($itemBarcode as $item)
				<div class="col-md-2 text-center" style="margin-top:10px;margin-bottom:2px;margin-left:15px;">
					<span style="font-weight:bold;font-size:11px;">{{$item['company']}}</span><br />
					<span style="font-size:11px;padding:0px;margin:0px;">{{$item['name']}}</span><br />
					<span style="padding:0px;margin:0px;"><img src="{{$item['barcode']}}" /></span><br />
					<span style="font-size:11px;">{{$item['code']}} TK. {{$item['amount']}}</span><br />
				</div>
				@endforeach
			</div>
		</div>
	</body>
</html>
