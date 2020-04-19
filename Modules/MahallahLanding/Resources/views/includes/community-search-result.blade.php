@isset ($searchResult)
<a href="{{ route('minisite.admin', ['community' => $community->slug]) }}">
    <div class="mdc-card community-card">
        <div class="mdc-card__primary-action demo-card__primary-action" tabindex="0">
            <div class="mdc-card__media mdc-card__media--16-9 demo-card__media"
                style="background-image: url('/img/community-bg.jpg');">
            </div>
            <div class="card__primary theme-primary-bg community-card-location">
                <p class="card__subtitle mdc-typography mdc-typography--subtitle2">{{ $community->country }}</p>
                <p class="card__subtitle mdc-typography mdc-typography--subtitle2">{{ $community->name }}</p>
            </div>
        </div>
    </div>
</a>
@endisset
