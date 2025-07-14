@php
    $searchTerm = '';
    if( isset($type) && $type!='drhp' ){
        $company_name = App\Models\CompanyMaster::select('company_name')->find($type)->company_name;
        $searchTerm = generateSecureHash($type);
        $news = App\Models\Blog::whereIn('type', ['news','blog'])->where('company_id', $type)->limit(3)->latest()->get();
    }elseif( isset($type) && $type=='drhp' ){
        $news = App\Models\Blog::whereIn('type', ['news','blog'])->select('blogs.*')
                ->join('company_master as cm', 'cm.id', '=', 'blogs.company_id')
                ->where('cm.drhp_filed', 1)->get();
    }else{
        $news = App\Models\Blog::whereIn('type', ['news','blog'])->limit(3)->latest()->get();
    }

    $liked = [];
    if( isset(Auth::user()->id) ){
        $liked = App\Models\UserLike::select('blog_id')->where('user_id', Auth::user()->id)->where('user_type', 'App\Models\User')->pluck('blog_id')->toArray();
    }
    if( isset(Auth::guard('customer')->user()->id) ){
        $liked = App\Models\UserLike::select('blog_id')->where('user_id', Auth::guard('customer')->user()->id)->where('user_type', 'App\Models\Customer')->pluck('blog_id')->toArray();
    }
@endphp
@if( count($news) )
<div class="popular px-lg-5">
    <div class="container-fluid">
        <div class="row my-5 mx-auto">
            <div class="mt-lg-5">

                <h1 class="text-center mb-lg-3 pt-md-0 fw-extrabold">Unlisted Shares in News
                </h1>
                <div class="row my-5 mx-auto">
                    @forelse ($news as $n)
                    <div class="col-md-4">
                        <div class="News card border-0 bg-transparent rounded-10">
                            <div class="d-flex align-items-center justify-content-center news-img-container">
                                <img src="{{ is_file(public_storage_path($n->image)) ? storage_asset($n->image) : asset('assets/media/logos/uzdefault.png') }}" class="no-chart-img
 {{!is_file(public_storage_path($n->image)) ? '' : ''}}"  alt="unlistedzone">
                            </div>
                            <div class="card-body border-0 bg-transparent ps-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{$n->created_at->format('d M, Y')}}, {{ucwords(str_replace('_', ' ', $n->category))}}</small>
                                    <div role="button">
                                        <span class="badge rounded-pill bg-secondary-subtle view"><i class="bi bi-eye"></i> {{$n->views}}</span> &nbsp;&nbsp;
                                        <span class="badge rounded-pill bg-secondary-subtle like {{ in_array($n->id, $liked) ? 'active' : '' }}" data-blog="{{ generateSecureHash($n->id) }}"><i class="bi bi-suit-heart-fill" title="Like this"></i> <span class="like-count">{{ $n->likes }}</span></span>
                                    </div>
                                </div>
                                <a href="{{ route('home',$n->slug??'') }}">
                                    <h5 class="fw-bold ps-0 mt-3">{{ strip_tags($n->title) }}</h5>
                                </a>
                                <div class="text-justify">
                                    <small>{{ $n->description ? substr(strip_tags($n->description), 0, 200).' ...' : '' }} </small>
                                </div>
                                {{-- <h6 class="fw-bold text-success mt-md-3 mt-sm-2 read-more border-bottom w-fc border-success">
                                    <a href="{{ route('home',$n->slug??'') }}">Read More</a>
                                </h6> --}}
                            </div>
                        </div>
                    </div>
                    @empty
                    <h5 class="text-center">Data not available!</h5>
                    @endforelse
                </div>

                @if(!empty($news))
                <div class="text-center mt-5 mb-5">
                    <a class="btn btn-white border fw-extrabold text-btn-primary-with-border rounded-10 px-5 fs-5 p-2 btn-color-hover" href="{{ route('blogs', $searchTerm??'') }}"> View More </a>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endif

<div class="popular px-lg-5 my-5">
    <div class="container-fluid">
        <x-twitter></x-twitter>
    </div>
</div>