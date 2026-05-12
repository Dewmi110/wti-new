<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='destinations'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Create Destination"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                            <h6 class="mb-0">Create Destination</h6>
                            <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-primary btn-sm mb-0">Back</a>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <form action="{{ route('admin.destinations.store') }}" method="POST">
                                @csrf
                                <div class="input-group input-group-outline mt-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="input-group input-group-outline mt-3 is-filled">
                                    <label class="form-label">Country</label>
                                    <select name="country_id" class="form-control">
                                        @foreach($countries as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
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
