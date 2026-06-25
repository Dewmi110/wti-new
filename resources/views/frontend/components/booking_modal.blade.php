<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 10px; border: none;">
            <div class="modal-header" style="background: #2c687b; color: #fff; border-radius: 10px 10px 0 0;">
                <h5 class="modal-title" style="font-weight: 700;">Book {{ $tour->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 1;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('frontend.booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                    <input type="text" name="full_name" class="td-input mb-3" placeholder="Full Name *" required>
                    <div class="td-form-row">
                        <input type="email" name="email" class="td-input" placeholder="Email *" required>
                        <input type="tel" name="phone" class="td-input" placeholder="Phone *" required>
                    </div>
                    <div class="td-form-row mt-3">
                        <input type="number" name="travelers" class="td-input" placeholder="Travelers *" min="1"
                            required>
                        <input type="date" name="travel_date" class="td-input">
                    </div>
                    <textarea name="special_requests" class="td-input td-textarea mt-3"
                        placeholder="Special Requests"></textarea>
                    <button type="submit" class="td-btn-primary td-btn-full mt-3">Complete Booking</button>
                </form>
                {{-- Success message after redirect --}}
                @if(session('booking_success'))
                <div class="alert alert-success mt-3">
                    ✅ Your booking has been received! We'll contact you shortly.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>