@isset ($searchResult)
<a href="{{ route('minisitePublic', ['minisite' => $searchResult->searchable->minisite->slug]) }}">
    <div class="mdc-card neighborhood-card">
        <div class="mdc-card__primary-action demo-card__primary-action" tabindex="0">
            <div class="mdc-card__media mdc-card__media--16-9 demo-card__media"
                style="background-image: url('https://source.unsplash.com/WLUHO9A_xik/1600x900');">
            </div>
            <div class="card__primary theme--primary-bg neighborhood-card-location">
                <p class="card__subtitle mdc-typography mdc-typography--subtitle2">{{ $searchResult->searchable->minisite->neighborhood->country}}</p>
                <p class="card__subtitle mdc-typography mdc-typography--subtitle2">{{ $searchResult->title }}</p>
            </div>
        </div>
    </div>
</a>
@endisset