@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Lesson Tips</h2>
		</div>
		
		<div class="panel panel-default">
			
			<div class="row">
				<div class="col-sm-12">
					<div class="tips-container">
						<ul class="bxslider">
			            	@foreach($weeks as $week)
			            	<li>
				            	<div class="row">
				            		<div class="col-sm-12">
						            	<h2 class="text-center">{{ $week->title }}</h2>
				            		</div>
				            	</div>
				            	<div class="row">
				            		<div class="col-sm-12 col-md-5">
								          {!! $week->description !!}				          
				            		</div>
				            		<div class="col-sm-12 col-md-7">
						            	<div class="action-items">
						            		<div class="list-group">
						            		@foreach ($week->items as $item)
						            			<div class="list-group-item">{!! $item->text !!}</div>
						            		@endforeach
						            		</div>
						            	</div>
				            		</div>
				            	</div>
			            	</li>
			            	@endforeach
			            </ul>
					</div>
				</div>
			</div>
			
		</div>
		
		
	</div>
	
@endsection