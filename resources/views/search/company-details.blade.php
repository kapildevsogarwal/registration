{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Company nformation')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title pull-left">Company Detail Name: <strong>{{($Details->name)?ucwords($Details->name):''}}</strong></h3>
                <h3 class="box-title pull-right">Registration Code: <strong>{{ $Details->referal }}</strong></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
						<tr>
                            <td width="20%"><strong>Company Name</strong></td>
                            <td>
								{{($Details->name)?ucfirst($Details->name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Type</strong></td>
                            <td>
                                {{($Details->type)?ucfirst($Details->type):''}}
                            </td>
                        </tr>
                        @if($status == 1)
                        <tr>
                            <td width="20%"><strong>Address</strong></td>
                            <td>
							   {{($Details->address)?ucfirst($Details->address):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Email</strong></td>
                            <td>
                                {{($Details->email)?ucfirst($Details->email):''}}
                            </td>
                        </tr>
                        
						<tr>
                            <td width="20%"><strong>District</strong></td>
                            <td>
                               {{$Details->district}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>State</strong></td>
                            <td>
                               {{$Details->state}}
                            </td>
                        </tr>
                        
						<tr>
                            <td width="20%"><strong>Zipcode</strong></td>
                            <td>
                               {{$Details->zip}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>GST</strong></td>
                            <td>
                               {{$Details->gst}}
                            </td>
                        </tr>
                        @endif
						{{--
                            <tr>
                                <td width="20%"><strong>Payment Status</strong></td>
                                <td>
                                   <strong>{{($Details->payment_id != '')?'Active':'Inactive'}}</strong>
                                </td>
                            </tr>
    						<tr>
                                <td width="20%"><strong>Payment Time</strong></td>
                                <td>
    							{{ ($Details->created_at)?date('d M, Y h:i:sa', strtotime($Details->created_at)):'Not Done Yet' }}
                                </td>
                            </tr>
                        --}}
                        <tr>
                            <td colspan="2" align="center">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" data-url="{{ route('search.approve-request', [$Details->id])}}" class="form-check-input" id="approve-company" value="{{$Details->id}}">
                                    <label class="form-check-label" for="approve-company">For more detail request for approval</label>
                                </div>
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
        $(document).ready(function(){
            // Delete delivery ticket
            $('body').on('click', '#approve-company', function(e){
                e.preventDefault();
                var dataUrl = $(this).data('url');
                var checkVal = $(this).val();
                if ($(this).is(':checked')) {
                    console.log(checkVal);
                    // Remove delivery ticket
                    swal.fire({
                        title: 'Request for company full detail?',
                        text: "This cannot be undone!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#00a65a',
                        cancelButtonColor: '#dd4b39',
                        confirmButtonText: 'Yes, send it!',
                        cancelButtonText: 'Never mind'
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                type: 'POST',
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
                                        })
                                    }
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection