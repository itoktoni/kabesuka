<!DOCTYPE html>
<html>

@php
$total = 0;
@endphp

<head>
	<link href="{{ Helper::disableSecure('stylesheets/print.min.css') ?? '' }}" media="all" rel="stylesheet" />
</head>

<body>
	<div id='page'>
		<div>
			<div>
				<div class="logo">
					<img class="logo" style="margin-top:-50px;margin-left:-60px;margin-bottom:-30px;width:400px;"
						src="{!! Helper::print('logo/mobile.png') !!}" alt="">
                </div>

				<div class="desc" style="margin-top: -20px;">
					<p style="font-size: 13px;">
						{{ env('WEBSITE_ADDRESS') }} - Phone {{ env('WEBSITE_PHONE') }}
					</p>
				</div>

				<hr>
			</div>
			<div style="margin-bottom: -20px;clear: both;">
				<h4 style='text-align: center; color:blackhite;line-height: 0;font-size: 1.5em; font-weight: bold;'>
					PURCHASE ORDER ( {{ $master->po_code ?? '' }} )
				</h4>
				<div>
					<div style="margin-top: 20px;">
						<table border='0.4' cellpadding='5' cellspacing='0' id='templateList' width='100%'>
							<tr>
								<td align='left' colspan='3' valign='top'>
									Supplier Name
								</td>
								<td align='left' colspan='5' valign='top'>
									{{ $master->has_supplier->supplier_name ?? '' }}
								</td>
							</tr>
							<tr>
								<td align='left' colspan='3' valign='top'>
									Status
								</td>
								<td align='left' colspan='5' valign='top'>
									{{ PurchaseStatus::getDescription($master->po_status) ?? '' }}
								</td>
							</tr>
							<tr>
								<td align='left' colspan='3' valign='top'>
									Notes
								</td>
								<td align='left' colspan='5' valign='top'>
									{{ $master->po_notes ?? '' }}
								</td>
							</tr>
							<tr>
								<td align='left' colspan='3' valign='top'>
									PO Date
								</td>
								<td align='left' colspan='5' valign='top'>
									{{ date_format(date_create($master->po_date),"d F Y") ?? '' }}
								</td>
							</tr>


							<tr>
								<td align='left' width="30px;" colspan='1' style='background-color: #e0e0e0 !important'
									valign='top'>
									No.
								</td>
								<td align='left' colspan='4' style='background-color: #e0e0e0 !important' valign='top'>
									Product Name
								</td>
								<td align='right' width="100px;" colspan='1'
									style='background-color: #e0e0e0 !important' valign='top'>
									Qty
								</td>
								<td align='right' width="150px;" colspan='1'
									style='background-color: #e0e0e0 !important' valign='top'>
									Price
								</td>
								<td align='right' colspan='1' width="150px;"
									style='background-color: #e0e0e0 !important' valign='top'>
									Sub Total
								</td>
							</tr>
							@foreach($master->has_detail as $item)
							<tr>
								<td align='center' colspan="1" valign='middle'>
									<span>{{ $loop->iteration ?? '' }}</span>
								</td>
								<td align='left' colspan='4' valign='middle'>
									<span>{{ $item->has_product->product_name ?? '' }}</span>
								</td>
								<td align='right' colspan='1' valign='middle'>
									<span>{{ $item->po_detail_qty ?? '' }}</span>
								</td>
								<td align='right' colspan='1' valign='middle'>
									<span>{{ number_format($item->po_detail_price) ?? '' }}</span>
								</td>
								<td align='right' colspan='1' valign='middle'>
									<span>{{ number_format($item->po_detail_total) ?? '' }}</span>
								</td>
							</tr>
							@endforeach
							<tr>
								<td align='left' colspan='7' valign='middle'>
									TOTAL
								</td>
								<td align='right' colspan='1' valign='middle'>

									{{ Helper::createRupiah($master->has_detail->sum('po_detail_total')) ?? '' }}

								</td>
							</tr>
							</tr>
						</table>
					</div>
				</div>

				<div align="right" style='margin-top: 10px;'>
					<span style="margin-top: 50px;"> Created By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<p style="margin-top: 70px;">
						<br>
						( {{ ucwords($master->has_user->name) ?? '' }} )
					</p>
				</div>

			</div>
		</div>
</body>

</html>