{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Purchase Bill')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
             
    </div>
    <div class="col-xs-8 mb-2">
       
            <a href="{{ route('purchase.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus mr-1"></i>Add Purchase Bill</a>
        
    </div>
</div>
<div class="row">

    <div class="col-xs-12">

        @include('partials.flash-messages')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title pull-left">Inward Tax (Purchase Bill) <strong></strong></h3>
				
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
						<tr>
                            <td width="20%"><strong>Select Month</strong></td>
                            <td width="20%">
								<select id="select-month" name="select-month" class="form-control">
									<option value="">Select Month</option>
									<?php
										for($m=1; $m<=12; ++$m){
											echo date('F', mktime(0, 0, 0, $m, 1)).'<br>';
											echo '<option value='.date('m', mktime(0, 0, 0, $m, 1)).'>'.date('F', mktime(0, 0, 0, $m, 1)).'</option>';
										}
									?>
								</select>
                            </td>
							<td width="60%" colspan="2">&nbsp;</td>
							
                        </tr>
						<tr>
                            <td width="20%">&nbsp;</td>
                            <td width="26.66%" >
								<strong>Total IGST Paid</strong>
                            </td>
							 <td width="26.66%">
								<strong>Total CGST Paid</strong>
                            </td>
							 <td width="26.66%">
								<strong>Total SGST Paid</strong>
                            </td>
                        </tr>
                      
                        <tr>
                            
							<td width="20%">&nbsp;</td>
                            <td id="pt_igst">
								--
                            </td>
							<td id="pt_cgst">
								--
                            </td>
							<td id="pt_sgst">
								--
                            </td>
                        </tr>
						<tr>
                            
							<td width="20%">&nbsp;</td>
                            <td >
								&nbsp;
                            </td>
							<td >
								&nbsp;
                            </td>
							<td >
								&nbsp;
                            </td>
                        </tr>
						
						<tr>
                            <td width="20%"><b>Total Overview</b></td>
                            <td width="26.66%" >
								<strong>Total IGST Paid Till Now</strong>
                            </td>
							 <td width="26.66%">
								<strong>Total CGST Paid Till Now</strong>
                            </td>
							 <td width="26.66%">
								<strong>Total SGST Paid Till Now</strong>
                            </td>
                        </tr>
						 <tr>
                            
							<td width="20%">&nbsp;</td>
                            <td id="purchase_igst_total_all">
								--
                            </td>
							<td id="purchase_gst_total_all">
								--
                            </td>
							<td id="purchase_sgst_total_all">
								--
                            </td>
                        </tr>
								
                    </tbody>
                </table>
                <div class="text-center">
                </div>
               

			</div>
		</div>
	</div>
</div>
@endsection


@section('header_css')
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('themes/adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
@endsection

@section('footer_assets')

    <!-- Sparkline -->
    <script src="{{ asset('themes/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('themes/adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('themes/adminlte/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('themes/adminlte/dist/js/demo.js') }}"></script>
	<script>
    	function showSA(obj) {
		    swal.fire({
		        type: obj.type,
		        title: obj.message
		    }).then(function(result) {

				if(typeof obj.urlTarget != 'undefined') {
					window.open(obj.url, obj.urlTarget);
				} else if(typeof obj.url != 'undefined') {
					window.location.href = obj.url;
				}
				
		    });
		}		

        $(document).ready(function(){
						
			$("#select-month").change(function() {console.log('yes');
				$('.full-page-loader').show();
				let getSelect = $(this).val();
				$('#select-month option[value="'+getSelect+'"]').attr("selected", "selected");
				if(getSelect !=''){ console.log("dddd");
					$('#select-overview-month').prop("disabled", false);
					$('#party_id').val(getSelect);
					var _Url = BASE_URL + 'inward/get-month-purchase-total';
					$.ajax({
						type: "get",
						url: _Url,
						data: 'month='+$(this).val(),
						dataType: 'JSON',
						cache: false,
						beforeSend: function(){
							//$('.full-page-loader').show();
						},
						success: function(data){
							$('.full-page-loader').hide();
							$('#pt_igst').text(data.arr.purchase_igst_total);
							$('#pt_cgst').text(data.arr.purchase_ca_gst_total);
							$('#pt_sgst').text(data.arr.purchase_sgst_total);
							
							$('#purchase_igst_total_all').text(data.arr.purchase_igst_total_all);
							$('#purchase_gst_total_all').text(data.arr.purchase_gst_total_all);
							$('#purchase_sgst_total_all').text(data.arr.purchase_sgst_total_all);
						}
					});
				}
				else{
					$('.full-page-loader').hide();
					$('#select-overview-month').prop("disabled", true);
					$('#pt_igst').text('--');
					$('#pt_cgst').text('--');
					$('#pt_sgst').text('--');
					
					$('#purchase_igst_total_all').text('--');
					$('#purchase_gst_total_all').text('--');
					$('#purchase_sgst_total_all').text('--');
				}
			});
			
			$("#select-overview-month").change(function() {console.log('yes');
				$('.full-page-loader').show();
				let getSelect = $(this).val();
				$('#select-month option[value="'+getSelect+'"]').attr("selected", "selected");
				if(getSelect !=''){ console.log("dddd");
					$('#select-overview-month').prop("disabled", false);
					$('#party_id').val(getSelect);
					var _Url = BASE_URL + 'inward/get-month-purchase-total';
					$.ajax({
						type: "get",
						url: _Url,
						data: 'month='+$(this).val(),
						dataType: 'JSON',
						cache: false,
						beforeSend: function(){
							//$('.full-page-loader').show();
						},
						success: function(data){
							$('.full-page-loader').hide();
							$('#pt_igst').text(data.arr.purchase_igst_total);
							$('#pt_cgst').text(data.arr.purchase_ca_gst_total);
							$('#pt_sgst').text(data.arr.purchase_sgst_total);
						}
					});
				}
				else{
					$('.full-page-loader').hide();
					$('#select-overview-month').prop("disabled", true);
					$('#pt_igst').text('--');
					$('#pt_cgst').text('--');
					$('#pt_sgst').text('--');
				}
			});
			
			
            // Delete delivery ticket
            $('body').on('click', '.delete-purchase', function(e){
                e.preventDefault();

                var dataUrl = $(this).data('url');

                // Remove delivery ticket
                swal.fire({
                    title: 'Permanently delete this purchase detail information?',
                    text: "This cannot be undone!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00a65a',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Never mind'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: dataUrl,
                            dataType: 'json',
                            data: {
                            },
                            beforeSend: function(){
                                //$('.full-page-loader').show();
                            },
                            error: function(response, status, xhr) {
                            },
                            success: function(response, status, xhr, $form) {

                               // $('.full-page-loader').hide();

                                if(response.status == 'failure') {
                                    showSA({
                                        type: 'error',
                                        message: response.payload.message,
                                    })

                                } else {
                                    showSA({
                                        type: 'success',
                                        message: response.payload.message,
                                        url: response.payload.url
                                    })
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('keyup', '#serach', function () {
                var query = $('#serach').val();
                var page = $('#hidden_page').val();           
                fetch_data(page, query);
            });

            $(document).on('click', '.pagination a', function (event) { console.log("ddd");
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });
            
            $('#insurance_filter').change(function(){
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });

            function fetch_data(page, query) {
                $.ajax({
                    url: BASE_URL + "company/search-company?page=" + page + "&query=" + query,
                    beforeSend: function () {
                        $('.full-page-loader').show();
                    },
                    success: function (data)
                    {
                        $('.full-page-loader').hide();
                        $("#business-list").find("tbody").html();
                        $("#business-list").find("tbody").html(data);
                    }
                });
            }
        });
    </script>

@endsection