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
							<a href="/admin/checkpoint/{{ $checkpoint->id }}/data"><strong>Open Date:</strong> {{ \Carbon\Carbon::parse($checkpoint->open_date)->format("F jS, Y") }} {{ ($checkpoint->published == 0) ? "*" : "" }}</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			* = Not published
		@endif
		</div>
	</div>
</div>
@endsection