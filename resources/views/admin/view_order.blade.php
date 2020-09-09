@extends('admin.admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			

			<div class="row-fluid sortable">
				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table">
							  <thead>
								  <tr>
									  <th>Username</th>
									  <th>Mobile</th>
									  <th>Email</th>
							  </thead>   
							  <tbody>
								<tr>
									@foreach($order_by_id as $v_order)
									@endforeach
									<td>{{ $v_order->customer_name }}</td>
									<td>{{ $v_order->mobile_number }}</td>
									<td>{{ $v_order->customer_email }}</td>

									                                  
								</tr>
								                                  
							  </tbody>
						 </table>  
						     
					</div>
				</div><!--/span-->
				
				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped">
							  <thead>
								  <tr>
									  <th>Username</th>
									  <th>Address</th>
									  <th>Mobile</th>
									  <th>Email</th>                                          
								  </tr>
							  </thead>   
							  <tbody>
								<tr>
									@foreach($order_by_id as $v_order)
									@endforeach
									<td>{{ $v_order->shipping_first_name }}</td>
									<td>{{ $v_order->shipping_address }}</td>
									<td>{{ $v_order->shipping_mobile_number }}</td>
									<td>{{ $v_order->shipping_email }}</td>
									                                      
								</tr>
								                                 
							  </tbody>
						 </table>  
						    
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
			
			
			<div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Combined All Table</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>Id</th>
									  <th>Product Name</th>
									  <th>Product Price</th>
									  <th>Product Sales Quantity</th>
									  <th>Product Sub Total</th>                                          
								  </tr>
							  </thead>   
							  <tbody>
							  	@foreach($order_by_id as $v_order)
								<tr>
									<td>{{ $v_order->order_id }}</td>
									<td>{{ $v_order->product_name }}</td>
									<td>{{ $v_order->product_price }}</td>
									<td>{{ $v_order->product_sales_quantity }}</td>
									<td>{{ $v_order->product_price*$v_order->product_sales_quantity }}</td>                 
								</tr>
								@endforeach
								                                 
							  </tbody>
							  <tbody>
							  	<tfoot>
							  		<tr>
							  			<td colspan="4">Total with vat: </td>
							  			<td><strong>={{ $v_order->order_total }} Tk</strong></td>
							  		</tr>
							  	</tfoot>
							  </tbody>
						 </table>  
						 <!-- <div class="pagination pagination-centered">
						  <ul>
							<li><a href="#">Prev</a></li>
							<li class="active">
							  <a href="#">1</a>
							</li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
						</div>  -->    
					</div>
				</div><!--/span-->
			</div><!--/row-->


@endsection