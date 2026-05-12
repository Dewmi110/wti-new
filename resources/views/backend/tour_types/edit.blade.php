<x-layout bodyClass="g-sidenav-show  bg-gray-200">
	<x-navbars.sidebar activePage='tour-types'></x-navbars.sidebar>
	<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
		<x-navbars.navs.auth titlePage="Edit Type"></x-navbars.navs.auth>
		<div class="container-fluid py-4">
			<div class="row">
				<div class="col-lg-6 col-md-8 mx-auto">
					<div class="card">
						<div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
							<h6 class="mb-0">Edit Type</h6>
							<a href="{{ route('admin.tour-types.index') }}" class="btn btn-outline-primary btn-sm mb-0">Back</a>
						</div>
						<div class="card-body pt-4 p-3">
							@if($errors->any())
								<div class="alert alert-danger">{{ $errors->first() }}</div>
							@endif
							<form method="POST" action="{{ route('admin.tour-types.update', $item) }}">
								@csrf
								@method('PUT')
								<div class="input-group input-group-outline mt-3">
									<label class="form-label">Type Name</label>
									<input type="text" name="type_name" class="form-control" value="{{ old('type_name', $item->type_name) }}">
								</div>

								<div class="form-check form-switch mt-3">
									<input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ $item->status ? 'checked' : '' }}>
									<label class="form-check-label" for="status">Active</label>
								</div>

								<div class="text-end mt-4">
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</x-layout>

