@extends('layout.app')

@section('title', __('Home Page'))
@section('description', __('Home Page'))

@section('content')

<div class="col-12" style="padding: 2%">

	<div class="row">
		<div class="col-xxl-6 col-sm-6 mb-25">
			<!-- Card 1  -->
			<div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">





				<div class="overview-content w-100">
					<div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
						<div class="ap-po-details__titlebar">
							<h1>{{$total_projects}}+</h1>
							<p>{{__('Total Projects')}}</p>
						</div>
						<div class="ap-po-details__icon-area">
							<div class="svg-icon order-bg-opacity-primary color-primary">

								<i class="uil uil-briefcase-alt"></i>
							</div>
						</div>
					</div>
					<div class="ap-po-details-time">
						<span class="color-{{$projects_difference > 0 ? 'success' : 'danger'}}"><i <i
								class="las la-arrow-{{$projects_difference > 0 ? 'up' : 'down'}}"></i>
							<strong>{{abs(round($projects_difference, 2))}}%</strong></span>
						<small>{{__('Since last month')}}</small>
					</div>
				</div>

			</div>
			<!-- Card 1 End  -->
		</div>
		<div class="col-xxl-6 col-sm-6 mb-25">
			<!-- Card 2 -->
			<div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">





				<div class="overview-content w-100">
					<div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
						<div class="ap-po-details__titlebar">
							<h1>{{$total_visits}}</h1>
							<p>{{__('Total Visits')}}</p>
						</div>
						<div class="ap-po-details__icon-area">
							<div class="svg-icon order-bg-opacity-info color-info">

								<i class="uil uil-shopping-cart-alt"></i>
							</div>
						</div>
					</div>
					<div class="ap-po-details-time">
						<span class="color-{{$visits_difference > 0 ? 'success' : 'danger'}}"><i <i
								class="las la-arrow-{{$visits_difference > 0 ? 'up' : 'down'}}"></i>
							<strong>{{abs(round($visits_difference, 2))}}%</strong></span>
						<small>{{__('Since last month')}}</small>
					</div>
				</div>

			</div>
			<!-- Card 2 End  -->
		</div>
		<div class="col-xxl-6 col-sm-6 mb-25">
			<!-- Card 3 -->
			<div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">





				<div class="overview-content w-100">
					<div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
						<div class="ap-po-details__titlebar">
							<h1>{{$total_earned}}</h1>
							<p>{{__('Total Money Earned')}}</p>
						</div>
						<div class="ap-po-details__icon-area">
							<div class="svg-icon order-bg-opacity-secondary color-secondary">

								<i class="uil uil-usd-circle"></i>
							</div>
						</div>
					</div>
					<div class="ap-po-details-time">
						<span class="color-{{$earned_difference > 0 ? 'success' : 'danger'}}">
							<i class="las la-arrow-{{ $earned_difference > 0 ? 'up' : 'down' }}"></i>
							<strong>{{abs(round($earned_difference, 2))}}%</strong></span>
						<small>{{__('Since last month')}}</small>
					</div>
				</div>

			</div>
			<!-- Card 3 End  -->
		</div>
		<div class="col-xxl-6 col-sm-6 mb-25">
			<!-- Card 4  -->
			<div class="ap-po-details ap-po-details--2 p-25 radius-xl d-flex justify-content-between">





				<div class="overview-content w-100">
					<div class=" ap-po-details-content d-flex flex-wrap justify-content-between">
						<div class="ap-po-details__titlebar">
							<h1>{{$total_users}}</h1>
							<p>{{__('Total Users')}}</p>
						</div>
						<div class="ap-po-details__icon-area">
							<div class="svg-icon order-bg-opacity-warning color-warning">

								<i class="uil uil-users-alt"></i>
							</div>
						</div>
					</div>
					<div class="ap-po-details-time">
						<span class="color-{{$users_difference > 0 ? 'success' : 'danger'}}"><i <i
								class="las la-arrow-{{$users_difference > 0 ? 'up' : 'down'}}"></i>
							<strong>{{abs(round($users_difference, 2))}}%</strong></span>
						<small>{{__('Since last month')}}</small>
					</div>
				</div>

			</div>
			<!-- Card 4 End  -->
		</div>
	</div>



	@include('partials._statistics')
	<div class="row">
		<div class="col-12 mb-25">

			<div class="card border-0 px-25 pb-10 h-100">
				<div class="card-header px-0 border-0">
					<h6>{{__('Users')}}</h6>
				</div>
				<div class="card-body p-0">
					<div class="tab-content">
						<div class="tab-pane fade active show" id="t_selling-today222" role="tabpanel"
							aria-labelledby="t_selling-today222-tab">
							<div class="selling-table-wrap selling-table-wrap--source">
								<div class="table-responsive">
									<table class="table table--default table-borderless">
										<thead>
											<tr>
												<th>{{__('Username')}}</th>
												<th>{{__('Email')}}</th>
												<th>{{__('Phone')}}</th>
												<th>{{__('Active')}}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($users as $user)
											<tr>
												<td style="padding-left: 1%;padding-right: 1%">
													<span>{{$user->name}}</span>
												</td>
												<td>{{$user->email}}</td>
												<td>{{$user->phone}}</td>
												<td style="padding-left: 1%;padding-right: 1%">
													{{$user->status}}
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection