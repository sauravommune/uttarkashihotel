<x-app-layout>
  <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="sitemap-section">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2>Sitemap</h2>
                            </div>
                            <div>
                                <a href="{{route('generate.sitemap')}}" class="btn btn-primary">
                                    <div class="d-flex align-items-center">
                                        <span class="material-symbols-outlined pe-2 fs-3">rotate_right</span>
                                        <span>Generate Sitemap</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Generate or Download Sitemap</p>
                            @php
                                  $text        =  $sitemapUrl;
                                  $sitemapUrl = $existsSitemap == 'yes' ? $sitemapUrl : 'javascript:void(0)';
                            @endphp
                            <p class="fs-6">Sitemap Public URL: <a href="{{$sitemapUrl}}" target="_blank" class="text-primary bold">{{$text}}</a></p>

                        </div>

                    </div>
                </div>
               
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}", 'Success', { timeOut: 5000 });
        @elseif(session('error'))
            toastr.error("{{ session('error') }}", 'Error', { timeOut: 5000 });
        @endif
    </script>
@endpush