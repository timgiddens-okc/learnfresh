@extends("layouts.app")
	
@section("content")

	@if(\Auth::user()->isAdmin())
		@include("nav.users")
	@endif

<div class="container">
	
	<div class="page-header">
		<h2>Administrators</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			@if($errors->any())
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
				<p>{{ $error }}</p>
				@endforeach
			</div>
			@endif
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	      @if(Session::has('alert-' . $msg))
	      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
	      @endif
	    @endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div id="user-table">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<td>
								<td>Last Logged In</td>
								<td>Name</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Site Address</td>
								<td>Shipping Address</td>
								<td>Billing Address</td>
								<td>Country</td>
								<td>Joined</td>
								<td>Edit User</td>
								<td>Impersonate This User</td>
								<td class="text-center">Delete User</td>
							</tr>
						</thead>
						<tbody>
							<?php $currentCount = 1; ?>
							@foreach ($users as $user)
							<tr>
								<td>{{ $currentCount }}</td>
								<?php 
									$currentCount++; 
								?>
								<td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans() }}</td>
								<td>{{ $user->name }}</td>
								<td><a href="/admin/{{ $user->id }}/email">{{ $user->email }}</a></td>
								<td>{{ $user->phone }}</td>
								<td>
									@if($user->site_address_1)
										{{ $user->site_address_1 }}<br>{{ ($user->site_address_2) ? $user->site_address_2 . "\n" : "" }}{{ $user->site_city }}, {{ $user->site_state }} {{ $user->site_zip_code }}
									@endif
								</td>
								<td>
									@if($user->shipping_address_1)
										{{ $user->shipping_address_1 }}<br>{{ ($user->shipping_address_2) ? $user->shipping_address_2 . "\n" : "" }}{{ $user->shipping_city }}, {{ $user->shipping_state }} {{ $user->shipping_zip_code }}
									@endif
								</td>
								<td>
									@if($user->billing_address_1)
										{{ $user->billing_address_1 }}<br>{{ ($user->billing_address_2) ? $user->billing_address_2 . "\n" : "" }}{{ $user->billing_city }}, {{ $user->billing_state }} {{ $user->billing_zip_code }}
									@else
										N/A
									@endif
								</td>
								<td>{{ $user->country }}</td>
								<td>{{ $user->created_at->setTimezone('America/Chicago')->diffForHumans() }}</td>
								<td class="text-center">
									<a href="/admin/user/{{ $user->id }}/edit"><i class="fa fa-pencil"></i></a>
								</td>
								<td class="text-center">
									<a href="/impersonation/{{ $user->id }}"><i class="fa fa-eye"></i></a>
								</td>
								<td class="text-center">
									<a href="/admin/user/{{ $user->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="row">
			  	<div class="col-sm-12">
			    	{{ $users->links() }}
			  	</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<h2>Invite Admin</h2>
			<p>The user will receive an email letting them know about their account, and give them a temporary password.</p>
			<form action="/invite-admin" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" />
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control" />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Send Invite</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection