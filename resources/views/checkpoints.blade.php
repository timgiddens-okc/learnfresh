@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Checkpoints</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	      @if(Session::has('alert-' . $msg))
	      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
	      @endif
	    @endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
		@if(count($checkpoints) > 0)
			<table class="table table-bordered" style="margin: 0px 0px 10px 0px;">
				<tbody>
					@foreach($checkpoints as $checkpoint)
					<tr>
						<td>
							@if(\Carbon\Carbon::now() > $checkpoint->open_date && \Carbon\Carbon::now() < $checkpoint->close_date)
							<a href="/checkpoint"><strong>Open Date:</strong> {{ \Carbon\Carbon::parse($checkpoint->open_date)->format("F jS, Y") }} <span class="badge badge-pill badge-success pull-right">Open Now!</span></a>
							@else
							<div><strong>Open Date:</strong> {{ \Carbon\Carbon::parse($checkpoint->open_date)->format("F jS, Y") }}</div>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@endif
		</div>
	</div>
</div>
@endsection