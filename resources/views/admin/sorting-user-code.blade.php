<form action="/admin/users/sorted" method="get" class="form-inline sort-users">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="week">Current Week</label><br>
			<select name="currentWeek">
				<option value="null"></option>
				<option value="pre">Pre-test</option>
				<option value="1">Week 1</option>
				<option value="2">Week 2</option>
				<option value="3">Week 3</option>
				<option value="4">Week 4</option>
				<option value="5">Week 5</option>
				<option value="6">Week 6</option>
				<option value="7">Week 7</option>
				<option value="8">Week 8</option>
				<option value="9">Week 9</option>
				<option value="10">Week 10</option>
				<option value="11">Week 11</option>
				<option value="12">Week 12</option>
				<option value="post">Post-test</option>
				<option value="completed">Completed</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="city">City</label><br>
			<select name="city">
				<option value="null"></option>
				<?php
					$used = array();
					$cities = \App\User::orderBy('shipping_city')->get();
				?>
				@foreach ($cities as $user)
					@if(!in_array($user->shipping_city, $used))
						<option value="{{ $user->shipping_city }}">{{ $user->shipping_city }}</option>
					<?php 
						$used[] = $user->shipping_city;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="state">State</label><br>
			<select name="state">
				<option value="null"></option>
				<?php
					$used = array();
					$states = \App\User::orderBy('shipping_state')->get();
				?>
				@foreach ($states as $user)
					@if(!in_array($user->shipping_state, $used))
						<option value="{{ $user->shipping_state }}">{{ $user->shipping_state }}</option>
					<?php 
						$used[] = $user->shipping_state;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="zip">Zip Code</label><br>
			<select name="zip">
				<option value="null"></option>
				<?php
					$used = array();
					$zips = \App\User::orderBy('shipping_zip_code')->get();
				?>
				@foreach ($zips as $user)
					@if(!in_array($user->shipping_zip_code, $used))
						<option value="{{ $user->shipping_zip_code }}">{{ $user->shipping_zip_code }}</option>
					<?php 
						$used[] = $user->shipping_zip_code;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="country">Country</label><br>
			<select name="country">
				<option value="null"></option>
				<?php
					$used = array();
					$countries = \App\User::orderBy('country')->get();
				?>
				@foreach ($countries as $user)
					@if(!in_array($user->country, $used))
						<option value="{{ $user->country }}">{{ $user->country }}</option>
					<?php 
						$used[] = $user->country;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="team">Favorite Team</label><br>
			<select name="team">
				<option value="null"></option>
				<?php
					$used = array();
					$teams = \App\User::orderBy('favorite_team')->get();
				?>
				@foreach ($teams as $user)
					@if(!in_array($user->favorite_team, $used))
						<option value="{{ $user->favorite_team }}">{{ $user->favorite_team }}</option>
					<?php 
						$used[] = $user->favorite_team;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="city">First Year?</label><br>
			<select name="first_year">
				<option value="null"></option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="pre_assessment_complete">Pretest Complete</label><br>
			<select name="pre_assessment_complete">
				<option value="null"></option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="post_assessment_complete">Posttest Complete</label><br>
			<select name="post_assessment_complete">
				<option value="null"></option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="payment_reminders">Payment Reminders</label><br>
			<select name="payment_reminders">
				<option value="null"></option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="city">Paid</label><br>
			<select name="paid">
				<option value="null"></option>
				<option value="1">Yes</option>
				<option value="0">Pending</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="city">Program</label><br>
			<select name="program">
				<option value="null"></option>
				@foreach (\App\Program::all() as $program)
				<option value="{{ $program->id }}">{{ $program->title }}</option>
				@endforeach
			</select>			
		</div><br>
		<button type="submit" class="btn btn-primary">Sort Users</button>
	</form>