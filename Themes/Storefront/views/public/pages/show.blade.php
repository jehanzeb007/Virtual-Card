@extends('public.layout')

@section('title', $page->name)

@push('meta')
    <meta name="title" content="{{ $page->meta->meta_title }}">
    <meta name="keywords" content="{{ implode(',', $page->meta->meta_keywords) }}">
    <meta name="description" content="{{ $page->meta->meta_description }}">
    <meta property="og:title" content="{{ $page->meta->meta_title }}">
    <meta property="og:description" content="{{ $page->meta->meta_description }}">
@endpush

@section('content')
    <div class="page-wrapper clearfix">
        @php echo html_entity_decode($page->body); @endphp
    </div>
@endsection
