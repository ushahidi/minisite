
<div class="card">
    <div class="card-header"><b>{{ $searchResults->count() }} @lang('search.resultsFound') "{{ request('query') }}"</b></div>

    <div class="card-body">
        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
            <h2>@lang("search.$type")</h2>
            @foreach($modelSearchResults as $searchResult)
                <ul>
                    <li><a href="{{ route('minisitePublic', ['minisite'=>$searchResult->searchable->minisite->slug]) }}">{{ $searchResult->title }}</a></li>
                </ul>
            @endforeach
        @endforeach

    </div>
</div>

