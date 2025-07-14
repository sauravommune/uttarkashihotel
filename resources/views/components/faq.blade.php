@php
    if( !isset($type) ){
        $type = 'dfsdf;ldsahfalsdhfalksdhfa;lskdflaksjdf;klajd';
    }
    $company_name='';
    $frequently_asked = \App\Models\Faq::query();
    if( $slot != '' ){
        $frequently_asked = $frequently_asked->where("page", "like", "%$slot%");
        
        if( isset($type) ){
            $frequently_asked = $frequently_asked->whereIn('company_id', [$type, 0])->get();
            $company_name = \App\Models\CompanyMaster::select('company_name')->find($type)->company_name??'';
        }else{
            $frequently_asked = $frequently_asked->get();
        }

    }else{
        $frequently_asked = $frequently_asked->get();
    }
@endphp
@if( count($frequently_asked) )
<div class="popular px-lg-5 border-bottom">
    <div class="container-fluid">
        <div class="row my-5 mx-auto">
            <h1 class="text-center mt-2 mb-lg-3 pt-md-0  fw-extrabold">Frequently Asked Questions
            </h1>
            <p class="text-center mt-3 fw-normal fs-5">Find answers to common questions that you may have in your mind.
            </p>
            <div class="mt-lg-5">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="accordion" id="accordionExample">
                            <!-- Section - 1 -->
                            @php
                                $qno = 1;    
                            @endphp
                            @foreach($frequently_asked as $fa)
                            @if( !in_array($type, $fa->except_company_id??[]) )
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne{{ $fa->id }}">
                                    <button class="accordion-button collapsed  accordion-button border-top bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $fa->id }}" aria-expanded="{{ $loop->iteration == '1' ? 'false' : 'false' }}" aria-controls="collapseOne{{ $fa->id }}">
                                        Q.{{$qno++}} : {{ str_replace('{name}', $company_name, $fa->title) }}
                                    </button>
                                </h2>
                                <div id="collapseOne{{ $fa->id }}" class="accordion-collapse collapse {{ $loop->iteration == '1' ? '' : '' }}" aria-labelledby="headingOne{{ $fa->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {!! str_replace('{name}', $company_name, $fa->description) !!}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif