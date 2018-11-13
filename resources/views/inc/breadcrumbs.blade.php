@if (count($breadcrumbs))
<ol class="breadcrumb float-left d-flex align-items-center">
    <li><h5 id="page-title">{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : '(No Title)' }}</h5></li>
</ol>
<ol id="breadcrumbs" class="breadcrumb d-flex justify-content-md-end">
    @foreach ($breadcrumbs as $breadcrumb) 
        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
        @endif 
    @endforeach
</ol>
@endif