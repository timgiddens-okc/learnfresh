@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Community</h2>
			<div class="categories">
			<a href="/community/category/media">Media</a> <span style="margin: 0px 5px;">|</span> 
			<a href="/community/category/program-support">Program Support</a> <span style="margin: 0px 5px;">|</span> 
			<a href="/community/category/testing">Testing</a> <span style="margin: 0px 5px;">|</span> 
			<a href="/community/category/all-star-advice">All-Star Advice</a> <span style="margin: 0px 5px;">|</span> 
			<a href="/community/category/events">Events</a> <span style="margin: 0px 5px;">|</span> 
			<a href="/community/category/classroom-creations">Classroom Creations</a> <span style="margin: 0px 5px;">|</span> 
			<a href="/community/category/other">Other</a>
			</div> 
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
			<div class="col-sm-12 col-md-8">
				<h6>Most Recent</h6>
				<div class="list-group">
					@foreach ($topics as $topic)
						<a href="/community/{{ $topic->slug }}" class="list-group-item">
							<h5><strong>{{ $topic->title }}</strong></h5>
							<?php
								$postUser = \App\User::find($topic->user_id);
							?>
							@if (count($topic->comments))
							<h6>Updated {{ $topic->comments->last()->updated_at->setTimezone('America/Chicago')->diffForHumans() }} by {{ App\User::find($topic->comments->last()->user_id)['name'] }} <span style="margin: 0px 5px;">|</span> {{ count($topic->comments) }} comments <span style="margin: 0px 5px;">|</span> {{ ucwords(str_replace("-"," ", $topic->category)) }}</h6>
							@else
							<h6>Posted {{ $topic->created_at->setTimezone('America/Chicago')->diffForHumans() }} by {{ $postUser['name'] }} <span style="margin: 0px 5px;">|</span> {{ count($topic->comments) }} comments <span style="margin: 0px 5px;">|</span> <a href="/community/category/{{ $topic->category }}" style="display: inline-block;">{{ ucwords(str_replace("-"," ", $topic->category)) }}</a></h6>
							@endif
							@if ($topic->user_id == Auth::user()->id || Auth::user()->isAdmin())
								<a href="/community/{{ $topic->slug }}/edit" class="edit"><i class="fa fa-pencil-square-o"></i></a>
							@endif
							@if ($topic->user_id == Auth::user()->id || Auth::user()->isAdmin())
								<a href="/community/{{ $topic->slug }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
							@endif
						</a>
					@endforeach
				</div>
				<div class="row">
  				<div class="col-sm-12">
    				{{ $topics->links() }}
  				</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Search Posts
					</div>
					<div class="panel-body">
						<form action="/community/search" method="get">
							<div class="form-group">
							<input type="text" name="query" class="form-control" placeholder="Search for a post." />
							</div>
							<button type="submit" class="btn btn-primary expanded">Search</button>
						</form>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						Add New Post
					</div>
					<div class="panel-body">
						<a href="/community/new-post" class="btn btn-primary expanded">Add New Post</a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection