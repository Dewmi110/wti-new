<div class="cf-panel">

    <h4 class="cf-panel-title">Send Your Enquiry</h4>
    <p class="cf-panel-sub">Fields marked <span style="color:#f4a020;">*</span> are required.</p>

    {{-- Alerts --}}
    <div id="cf-success" class="cf-alert cf-alert--success" style="display:none;">
        &#10003; Your enquiry has been sent! We'll be in touch shortly.
    </div>
    <div id="cf-error" class="cf-alert cf-alert--error" style="display:none;">
        &#10007; Something went wrong. Please try again or email us directly.
    </div>

    <div class="row" id="cf-form">

        {{-- Service Type --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">Service Type <span class="cf-req">*</span></label>
                <div class="cf-select-wrap">
                    <select id="cf-service" class="cf-input cf-select" required>
                        <option value="" disabled selected>Select a service…</option>
                        <option>Visit to Sri Lanka</option>
                        <option>Outbound Tours</option>
                        <option>MICE Tours</option>
                        <option>Corporate Travel</option>
                        <option>Air Tickets</option>
                        <option>Visa Services</option>
                        <option>Ancillaries</option>
                    </select>
                    <i class="fa fa-chevron-down cf-select-icon"></i>
                </div>
            </div>
        </div>

        {{-- Travel Date --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">Date to Travel <span class="cf-req">*</span></label>
                <input type="date" id="cf-date" class="cf-input" required min="{{ date('Y-m-d') }}">
            </div>
        </div>

        {{-- Destination --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">Select Destination <span class="cf-req">*</span></label>
                <div class="cf-select-wrap">
                    <select id="cf-destination" class="cf-input cf-select" required>
                        <option value="" disabled selected>Choose destination…</option>
                        @foreach($destinations as $dest)
                        <option value="{{ $dest->name }}">{{ $dest->name }}</option>
                        @endforeach
                    </select>
                    <i class="fa fa-chevron-down cf-select-icon"></i>
                </div>
            </div>
        </div>

        {{-- No. of People --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">No. of People <span class="cf-req">*</span></label>
                <input type="number" id="cf-people" class="cf-input" placeholder="e.g. 2" min="1" max="500" required>
            </div>
        </div>

        {{-- Full Name --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">Full Name <span class="cf-req">*</span></label>
                <input type="text" id="cf-name" class="cf-input" placeholder="Your full name" required>
            </div>
        </div>

        {{-- City --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">City of Residence <span class="cf-req">*</span></label>
                <input type="text" id="cf-city" class="cf-input" placeholder="e.g. London" required>
            </div>
        </div>

        {{-- Email --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">Email Address <span class="cf-req">*</span></label>
                <input type="email" id="cf-email" class="cf-input" placeholder="you@email.com" required>
            </div>
        </div>

        {{-- Phone --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">Phone Number <span class="cf-req">*</span></label>
                <input type="tel" id="cf-phone" class="cf-input" placeholder="+1 234 567 8900" required>
            </div>
        </div>

        {{-- WhatsApp --}}
        <div class="col-md-6">
            <div class="cf-group">
                <label class="cf-label">WhatsApp Number</label>
                <input type="tel" id="cf-whatsapp" class="cf-input" placeholder="Same as phone or different">
            </div>
        </div>

        {{-- Spacer --}}
        <div class="col-md-6"></div>

        {{-- Comments --}}
        <div class="col-md-12">
            <div class="cf-group">
                <label class="cf-label">Comments / Questions</label>
                <textarea id="cf-comments" class="cf-input" rows="4"
                    placeholder="Special requests, questions or details about your trip…"></textarea>
            </div>
        </div>

        {{-- Submit --}}
        <div class="col-md-12 mt-2">
            <button id="cf-submit" type="button" class="cf-submit-btn">
                <span id="cf-btn-text"><i class="fa fa-paper-plane mr-2"></i> Submit Enquiry</span>
                <span id="cf-btn-loading" style="display:none;"><i class="fa fa-spinner fa-spin mr-2"></i>
                    Sending…</span>
            </button>
        </div>

    </div>{{-- /#cf-form --}}
</div>{{-- /.cf-panel --}}

<script>
    (function () {
        'use strict';

        var CSRF_TOKEN = '{{ csrf_token() }}';

        function g(id) { return document.getElementById(id); }
        function v(id) { var el = g(id); return el ? el.value.trim() : ''; }

        function shake(id) {
            var el = g(id);
            if (!el) return;
            el.classList.add('is-invalid');
            setTimeout(function () { el.classList.remove('is-invalid'); }, 900);
        }

        function validate() {
            var required = [
                'cf-service', 'cf-date', 'cf-destination', 'cf-people',
                'cf-name', 'cf-city', 'cf-email', 'cf-phone'
            ];
            var ok = true;
            required.forEach(function (id) {
                if (!v(id)) { shake(id); ok = false; }
            });
            var email = v('cf-email');
            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                shake('cf-email'); ok = false;
            }
            return ok;
        }

        g('cf-submit').addEventListener('click', function () {
            if (!validate()) return;

            g('cf-btn-text').style.display = 'none';
            g('cf-btn-loading').style.display = 'inline';
            g('cf-submit').disabled = true;

            var payload = {
                service_type: v('cf-service'),
                travel_date:  v('cf-date'),
                destination:  v('cf-destination'),
                num_people:   v('cf-people'),
                full_name:    v('cf-name'),
                city:         v('cf-city'),
                email:        v('cf-email'),
                phone:        v('cf-phone'),
                whatsapp:     v('cf-whatsapp') || '',
                comments:     v('cf-comments') || '',
            };

            fetch('{{ route('enquiry.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify(payload)
            }).then(function (res) {
                if (!res.ok) return res.json().then(function (d) { throw d; });
                return res.json();
            }).then(function (json) {
                console.log('Enquiry response:', json);
                g('cf-success').style.display = 'block';
                g('cf-error').style.display = 'none';
                ['cf-service', 'cf-date', 'cf-destination', 'cf-people',
                 'cf-name', 'cf-city', 'cf-email', 'cf-phone',
                 'cf-whatsapp', 'cf-comments'].forEach(function (id) {
                    var el = g(id); if (el) el.value = '';
                });
                g('cf-success').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }).catch(function (err) {
                console.error('Enquiry error', err);
                try { console.debug('Error body:', err); } catch(e) {}
                g('cf-error').style.display = 'block';
                g('cf-success').style.display = 'none';
            }).finally(function () {
                g('cf-btn-text').style.display = 'inline';
                g('cf-btn-loading').style.display = 'none';
                g('cf-submit').disabled = false;
            });
        });
    })();
</script>