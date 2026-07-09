@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
        <h3 class="card-header-title">Tour Inclusions, Exclusions & Cancellation Policies</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom:16px;">
            <i class="fas fa-check-circle alert-icon"></i>
            <div class="alert-body">{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom:16px;">
            <i class="fas fa-times-circle alert-icon"></i>
            <div class="alert-body">
                <strong>Please fix the following errors:</strong>
                {{ $errors->first() }}
            </div>
        </div>
    @endif

    @php
        $activeTab = request('tab', 'inclusions');
    @endphp

    <div class="card">

        {{-- Tab Nav --}}
        <div class="policy-tabs">
            <button type="button" class="policy-tab-btn {{ $activeTab === 'inclusions' ? 'active' : '' }}" data-tab="inclusions">
                <i class="fas fa-check-circle"></i> Inclusions
            </button>
            <button type="button" class="policy-tab-btn {{ $activeTab === 'exclusions' ? 'active' : '' }}" data-tab="exclusions">
                <i class="fas fa-times-circle"></i> Exclusions
            </button>
            <button type="button" class="policy-tab-btn {{ $activeTab === 'cancellation-policies' ? 'active' : '' }}" data-tab="cancellation-policies">
                <i class="fas fa-file-contract"></i> Cancellation Policies
            </button>
        </div>

        {{-- ── INCLUSIONS TAB ── --}}
        <div class="policy-tab-panel {{ $activeTab === 'inclusions' ? 'active' : '' }}" id="panel-inclusions">
            <div class="card-body">
                <div class="policy-layout">

                    {{-- Add form --}}
                    <div class="policy-form-col">
                        <div class="card-header-sub" style="margin-bottom:10px;">Add Inclusion</div>
                        <form action="{{ route('admin.tour-policies.store', ['type' => 'inclusions']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-input" placeholder="e.g. Airport pickup & drop-off">
                            </div>
                            <div class="form-group">
                                <div class="toggle-wrap">
                                    <label class="toggle">
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <span class="toggle-label">Active</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-plus"></i> Add Inclusion
                            </button>
                        </form>
                    </div>

                    {{-- List --}}
                    <div class="policy-list-col">
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th width="110">Status</th>
                                        <th width="110" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($inclusions as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if($item->status)
                                                <span class="td-badge badge-success"><span class="dot dot-green"></span> Active</span>
                                            @else
                                                <span class="td-badge badge-dark"><span class="dot dot-orange"></span> Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="td-actions justify-content-center">
                                                <button type="button" class="action-btn action-edit" onclick="openEditModal('inclusions', {{ $item->id }}, {{ json_encode($item->title) }}, {{ $item->status }})">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <form action="{{ route('admin.tour-policies.destroy', ['type' => 'inclusions', 'id' => $item->id]) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="action-btn action-delete" onclick="return confirm('Delete this inclusion?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center">No inclusions yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── EXCLUSIONS TAB ── --}}
        <div class="policy-tab-panel {{ $activeTab === 'exclusions' ? 'active' : '' }}" id="panel-exclusions">
            <div class="card-body">
                <div class="policy-layout">

                    <div class="policy-form-col">
                        <div class="card-header-sub" style="margin-bottom:10px;">Add Exclusion</div>
                        <form action="{{ route('admin.tour-policies.store', ['type' => 'exclusions']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-input" placeholder="e.g. International flights">
                            </div>
                            <div class="form-group">
                                <div class="toggle-wrap">
                                    <label class="toggle">
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <span class="toggle-label">Active</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-plus"></i> Add Exclusion
                            </button>
                        </form>
                    </div>

                    <div class="policy-list-col">
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th width="110">Status</th>
                                        <th width="110" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($exclusions as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if($item->status)
                                                <span class="td-badge badge-success"><span class="dot dot-green"></span> Active</span>
                                            @else
                                                <span class="td-badge badge-dark"><span class="dot dot-orange"></span> Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="td-actions justify-content-center">
                                                <button type="button" class="action-btn action-edit" onclick="openEditModal('exclusions', {{ $item->id }}, {{ json_encode($item->title) }}, {{ $item->status }})">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <form action="{{ route('admin.tour-policies.destroy', ['type' => 'exclusions', 'id' => $item->id]) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="action-btn action-delete" onclick="return confirm('Delete this exclusion?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center">No exclusions yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── CANCELLATION POLICIES TAB ── --}}
        <div class="policy-tab-panel {{ $activeTab === 'cancellation-policies' ? 'active' : '' }}" id="panel-cancellation-policies">
            <div class="card-body">
                <div class="policy-layout">

                    <div class="policy-form-col">
                        <div class="card-header-sub" style="margin-bottom:10px;">Add Cancellation Policy</div>
                        <form action="{{ route('admin.tour-policies.store', ['type' => 'cancellation-policies']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-input" placeholder="e.g. Standard 30-Day Policy">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="4" placeholder="Full policy text..."></textarea>
                            </div>
                            <div class="form-group">
                                <div class="toggle-wrap">
                                    <label class="toggle">
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <span class="toggle-label">Active</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-plus"></i> Add Policy
                            </button>
                        </form>
                    </div>

                    <div class="policy-list-col">
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th width="110">Status</th>
                                        <th width="110" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cancellationPolicies as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if($item->status)
                                                <span class="td-badge badge-success"><span class="dot dot-green"></span> Active</span>
                                            @else
                                                <span class="td-badge badge-dark"><span class="dot dot-orange"></span> Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="td-actions justify-content-center">
                                                <button type="button" class="action-btn action-edit" onclick="openEditModal('cancellation-policies', {{ $item->id }}, {{ json_encode($item->title) }}, {{ $item->status }}, {{ json_encode($item->description) }})">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <form action="{{ route('admin.tour-policies.destroy', ['type' => 'cancellation-policies', 'id' => $item->id]) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="action-btn action-delete" onclick="return confirm('Delete this policy?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center">No cancellation policies yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- Shared Edit Modal --}}
<div id="policyEditModal" class="policy-modal-overlay" style="display:none;">
    <div class="policy-modal">
        <div class="policy-modal-header">
            <h5 id="policyEditModalTitle">Edit Item</h5>
            <button type="button" onclick="closeEditModal()" class="action-btn action-delete"><i class="fas fa-times"></i></button>
        </div>
        <form id="policyEditForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Title <span class="required">*</span></label>
                <input type="text" name="title" id="policyEditTitle" class="form-input">
            </div>
            <div class="form-group" id="policyEditDescriptionWrap" style="display:none;">
                <label class="form-label">Description</label>
                <textarea name="description" id="policyEditDescription" class="form-input" rows="4"></textarea>
            </div>
            <div class="form-group">
                <div class="toggle-wrap">
                    <label class="toggle">
                        <input type="checkbox" name="status" id="policyEditStatus" value="1">
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">Active</span>
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px; padding-top:10px;">
                <button type="button" class="btn btn-outline" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>

<style>

</style>

<script>
document.querySelectorAll('.policy-tab-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const tab = this.dataset.tab;

        document.querySelectorAll('.policy-tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.policy-tab-panel').forEach(p => p.classList.remove('active'));

        this.classList.add('active');
        document.getElementById('panel-' + tab).classList.add('active');

        // update URL without full reload, so refresh keeps the tab
        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        window.history.replaceState({}, '', url);
    });
});

function openEditModal(type, id, title, status, description) {
    const form = document.getElementById('policyEditForm');
    form.action = '/admin/tour-policies/' + type + '/' + id;

    document.getElementById('policyEditTitle').value = title;
    document.getElementById('policyEditStatus').checked = !!status;

    const descWrap = document.getElementById('policyEditDescriptionWrap');
    if (type === 'cancellation-policies') {
        descWrap.style.display = 'block';
        document.getElementById('policyEditDescription').value = description || '';
    } else {
        descWrap.style.display = 'none';
        document.getElementById('policyEditDescription').value = '';
    }

    document.getElementById('policyEditModalTitle').textContent = 'Edit ' +
        (type === 'inclusions' ? 'Inclusion' : type === 'exclusions' ? 'Exclusion' : 'Cancellation Policy');

    document.getElementById('policyEditModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('policyEditModal').style.display = 'none';
}
</script>

@endsection