<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<style>
	@page {
		margin: 0px;
	}

	/* html { margin: 0px} */
	body {
		margin-left: 0px;
		margin-right: 17px;
	}

	table#border {
		border: 0.5px solid grey;
	}

	.print-only {
		display: none !important
	}

	* {
		background: transparent !important;
		color: black !important;
		-webkit-box-shadow: none !important;
		box-shadow: none !important;
		text-shadow: none !important;
		-webkit-filter: none !important;
		filter: none !important;
		-ms-filter: none !important
	}

	*,
	*:before,
	*:after {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box
	}

	a,
	a:visited {
		text-decoration: underline
	}


	a[href]:after {
		content: "
(" attr(href) ")"}abbr[title]:after{content:"(" attr(title) ")"}.ir
a:after, a[href^="javascript:"]:after, a[href^="#"]:after {
			content: ""
		}

		pre,
		blockquote {
			border: 1px solid #999;
			page-break-inside: avoid
		}

		thead {
			display: table-header-group
		}

		tr,
		img {
			page-break-inside: avoid
		}

		img {
			max-width: 100% !important;
			vertical-align: middle;
			max-height: 100% !important
		}

		table {
			border-collapse: collapse
		}

		th,
		td {
			/* border: solid 1px #333; */
			/* padding: 0.25em 8px; */
			vertical-align: top
		}

		dl {
			margin: 0
		}

		dd {
			margin: 0
		}

		@page {
			margin: 1cm 0.5cm
		}

		p,
		h2,
		h3 {
			orphans: 3;
			widows: 3
		}

		h2,
		h3 {
			page-break-after: avoid
		}

		.hide-on-print {
			display: none !important
		}

		.print-only {
			display: block !important
		}

		.hide-for-print {
			display: none !important
		}

		.show-for-print {
			display: inherit !important
		}

		.break-page-after {
			page-break-after: always;
			page-break-inside: avoid
		}

		html {
			overflow-x: visible
		}

		body {
			font-size: 12px;
			line-height: 1.5;

			font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Arial, sans-serif;
			padding: 0
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-weight: normal
		}

		h1 a,
		h2 a,
		h3 a,
		h4 a,
		h5 a,
		h6 a {
			font-weight: inherit
		}

		h2 {
			font-size: 2em;
			line-height: 1.5;
			margin-bottom: 0.75em
		}

		h3 {
			font-size: 1.5em;
			line-height: 1;
			margin-top: 2em;
			margin-bottom: 1em
		}

		h4 {
			font-size: 1.25em;
			line-height: 2.4
		}

		h5 {
			font-weight: bold;
			margin-top: 2.25em;
			margin-bottom: 0.75em
		}

		h6 {
			text-transform: uppercase;
			margin-top: 2.25em;
			margin-bottom: 0.75em
		}

		#page {
			width: 100%;
			position: relative;
		}

		.address p {
			margin-top: 0px;
			margin-bottom: 0px;
		}

		.th {
			text-align: left;
			width: 40%;
			padding: 0px;
		}

		.total {
			text-align: right;
			width: 20%;
			padding: 0px;
		}

		.price {
			text-align: right;
			width: 30%;
			padding: 0px;
		}

		.td {
			text-align: right;
			padding: 0px;
		}

		.name {
			padding: 0px;
		}

		.qty {
			text-align: right;
			width: 10%;
			padding: 0px;
		}

		.address td {
			padding-top: 7px;
		}

		.alamat {
			font-size: 0.8rem;
			line-height: 1.2;
		}
	</style>

	<title>Document</title>
</head>


<body>
	<div id='page'>
		<div>
			<h2 style="text-align: center;margin-top:0px;margin-bottom:-20px">
				<img id="logo" style="height:80px;" src="{{ public_path('files/logo/black.png') }}" alt="">
			</h2>
			@if(env('NPWP'))
            <h5 style="text-align: center;margin-top:0px;margin-bottom:0px;">
                NPWPD : {{ env('NPWP') ?? '' }}
			</h5>
			@endif
            <hr style="border:none;border-top: dotted 1px;">
			<h3 style="text-align: center;margin-top:0px;margin-bottom:0px;">
				{{ $master->booking_code ?? '' }}
			</h3>
		</div>

		<hr style="border:none;border-top: dotted 1px;">

		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="th">Customer</td>
				<td class="td">{{ $master->booking_name ?? '' }}</td>
			</tr>
			<tr>
				<td class="th">Telp</td>
				<td class="td"> {{ $master->booking_phone ?? '' }}</td>
			</tr>

		</table>

		<hr style="border:none;border-top: dotted 1px;">
		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="name">Person</td>
				<td style="text-align: center;" class="qty">Qty</td>
				<td class="price">Harga</td>
				<td class="price">Total</td>
			</tr>
		</table>
		<hr style="border:none;border-top: dotted 1px;">
		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			@if($master->booking_dewasa_qty)
			<tr>
				<td class="name">Dewasa</td>
				<td class="qty" style="text-align: center;">{{ $master->booking_dewasa_qty ?? '' }}</td>
				<td class="price">{{ Helper::createRupiah(env('PRICE_DEWASA')) }}</td>
				<td class="price">{{ Helper::createRupiah($master->booking_dewasa_price) ?? '' }}</td>
			</tr>
			@endif

			@if($master->booking_lansia_qty)
			<tr>
				<td class="name">Lansia</td>
				<td style="text-align: center;" class="qty">{{ $master->booking_lansia_qty ?? '' }}</td>
				<td class="price">{{ Helper::createRupiah(env('PRICE_LANSIA')) }}</td>
				<td class="price">{{ Helper::createRupiah($master->booking_lansia_price) ?? '' }}</td>
			</tr>
			@endif

			@if($master->booking_anak_qty)
			<tr>
				<td class="name">Anak-Anak</td>
				<td style="text-align: center;" class="qty">{{ $master->booking_anak_qty ?? '' }}</td>
				<td class="price">{{ Helper::createRupiah(env('PRICE_ANAK')) }}</td>
				<td class="price">{{ Helper::createRupiah($master->booking_anak_price) ?? '' }}</td>
			</tr>
			@endif

		</table>

		<hr style="border:none;border-top: dotted 1px;">

		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="name">Subtotal</td>
				<td class="total">{{ number_format( $master->booking_value ,0,",",".")}}</td>
			</tr>
		</table>

		<hr style="border:none;border-top: dotted 1px;">

		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="name">Down Payment (DP)</td>
				<td class="total">- {{ number_format( $master->booking_dp ,0,",",".")}}</td>
			</tr>
		</table>

		<hr style="border:none;border-top: dotted 1px;">

		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="name">Discount {{ $master->booking_discount_description ?? '' }}</td>
				<td class="total">- {{ number_format( $master->booking_discount_value ,0,",",".")}}</td>
			</tr>
		</table>

		<hr style="border:none;border-top: dotted 1px;">

        <table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="name">Pajak Restoran {{ env('PPN') }}%</td>
				<td align="right" class="td">{{ number_format( ($master->booking_value * env('PPN') / 100) ,0,",",".") }}
				</td>
			</tr>
        </table>

		<hr style="border:none;border-top: dotted 1px;">

		<table border='0' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
			<tr>
				<td class="name"><strong style="font-size: 15px;">Total</strong></td>
				<td align="right" class="price"><strong
						style="font-size: 15px;">{{ number_format( $master->booking_summary ,0,",",".") }}</strong>
				</td>
			</tr>
		</table>

		<div>
			<h5 class="description" style="margin-top:20px;margin-bottom:20px;line-height: 5px;">
				<span>
					{!! config('website.description') !!}
				</span>
			</h5>
		</div>

		<hr>

		<div>
			<h5 class="description" style="margin-top:20px;margin-bottom:20px;line-height: 5px;">
				<span>
					Tanggal : {{ $master->booking_start_time->format('Y-m-d') }} - Jam :
					{{ $master->booking_start_time->format('H:i:s') }} -
					{{ $master->booking_end_time->format('H:i:s') }}
				</span>
			</h5>
		</div>

		<h6 style="text-align: center;">
			...
		</h6>
</body>

</html>