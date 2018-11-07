@if (count($breadcrumbs))
<ol class="breadcrumb float-left d-flex align-items-center">
    <li><h4>{{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}</h4></li>
</ol>
<ol class="breadcrumb d-flex justify-content-md-end">
    @foreach ($breadcrumbs as $breadcrumb) 
        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
        @endif 
    @endforeach
</ol>
@endif