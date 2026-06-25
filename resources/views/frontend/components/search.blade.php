<div class="container" style="position:relative; margin-top:-80px;">
   <div class="row justify-content-center">
      <div class="col-lg-11">
         <div class="search-wrap-1 ftco-animate search-card">
            <form action="{{ route('frontend.tours.search') }}" method="GET" class="search-property-1">
               <div class="row no-gutters">

                  {{-- Tour Type --}}
                  <div class="col-lg d-flex">
                     <div class="form-group p-4 border-0">
                        <label>Tour Type</label>
                        <div class="form-field">
                           <div class="select-wrap">
                              <div class="icon"><span class="fa fa-chevron-down"></span></div>
                              <select name="tour_type" class="form-control">
                                 <option value="">All Types</option>
                                 @foreach($types as $type)
                                 <option value="{{ $type->id }}">
                                    {{ $type->type_name }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>

                  {{-- Destination --}}
                  <div class="col-lg d-flex">
                     <div class="form-group p-4">
                        <label>Destination</label>
                        <div class="form-field">
                           <div class="icon"><span class="fa fa-search"></span></div>
                           <input type="text" name="destination" class="form-control" placeholder="Search place">
                        </div>
                     </div>
                  </div>

                  {{-- Price Limit --}}
                  <div class="col-lg d-flex">
                     <div class="form-group p-4">
                        <label>Price Limit</label>
                        <div class="form-field">
                           <div class="select-wrap">
                              <div class="icon"><span class="fa fa-chevron-down"></span></div>
                              <select name="max_price" class="form-control">
                                 <option value="">Any Price</option>
                                 <option value="500">500</option>
                                 <option value="1000">1,000</option>
                                 <option value="2000">2,000</option>
                                 <option value="5000">5,000</option>
                                 <option value="10000">10,000</option>
                                 <option value="50000">50,000</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>

                  {{-- Search Button --}}
                  <div class="col-lg-3 d-flex">
                     <div class="form-group d-flex w-100 border-0 mb-0">
                        <div class="form-field w-100 d-flex">
                           <input type="submit" value="Search" class="form-control btn btn-primary h-100">
                        </div>
                     </div>
                  </div>

               </div>
            </form>
         </div>
      </div>
   </div>
</div>