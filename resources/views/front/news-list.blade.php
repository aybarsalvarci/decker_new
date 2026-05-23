@foreach($news as $report)
    <a href="{{route('news', [$report->slug, $report->id])}}" class="news-card-vertical news-item">
        <img src="{{asset('storage/' . $report->image)}}" class="nc-bg" alt="{{$report->slug}}">
        <div class="nc-overlay"></div>
        <div class="nc-action-btn"><i class="fas fa-arrow-right"></i></div>
        <div class="nc-content">
            <span class="nc-date">{{$report->created_at->format('M Y')}}</span>
            <h3 class="nc-title">{{$report->title}}</h3>
        </div>
    </a>
@endforeach
