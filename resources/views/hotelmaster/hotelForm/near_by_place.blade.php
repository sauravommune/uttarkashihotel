<div class="col-lg-12 col-12 near_places pt-2">
    <div class="row ps-md-2">
        @foreach ($places as $destination)
      
        <div class="col-md-6 col-12">
            <div class="row ps-md-2 mt-4 align-items-center">
                <div class="col-md-6 col-lg-5 col-12">
                    <input type="hidden" class="form-control border-0 p-0" value="{{ $destination->id }}" placeholder="Enter Near By Place" name=place[] />
                    <p class="text-dot mb-0">{{ $destination->places }}</p>
                </div>
                <div class="col-md-6 col-lg-6 col-12 mt-3 mt-md-0">
               
                    @forelse($destination?->placeDistance->where('hotel_id',request('id')) as $key => $ds)
                    <div class="input-group">
                        <input type="number" class="form-control form-control-solid" placeholder="Enter distance in km" name="distance[]"  value="{{$ds?->distance}}"/>
                        <span class="input-group-text">km</span>
                    </div>
                    @empty
                    <div class="input-group">
                        <input type="number" class="form-control form-control-solid" placeholder="Enter distance in km" name="distance[]" />
                        <span class="input-group-text">km</span>
                    </div>
                    @endforelse
                    
               
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
