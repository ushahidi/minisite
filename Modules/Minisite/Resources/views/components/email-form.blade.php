
    @if(isset($block->content->Recipient))
        <form method="POST" action="{{ route('sendSiteEmail', ['minisite' => $minisite, 'block'=>$block]) }}">
            @csrf
            <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                    <div class="mdc-text-field">
                        <input id="email-name" name="name" class="mdc-text-field__input @error('name') is-invalid @enderror" required autocomplete="name">
                        <div class="mdc-line-ripple"></div>
                        <label for="email-name" class="mdc-floating-label">Name</label>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell--span-12">
                    <div class="mdc-text-field">
                        <input id="email-email" name="email" class="mdc-text-field__input @error('email') is-invalid @enderror" required autocomplete="email">
                        <div class="mdc-line-ripple"></div>
                        <label for="email-email" class="mdc-floating-label">Email</label>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell--span-12">
                    <div class="mdc-text-field text-field mdc-text-field--fullwidth mdc-text-field--no-label mdc-text-field--textarea">
                        <textarea id="email-message" name="message" class="mdc-text-field__input" aria-labelledby="message" rows="6"
                            cols="40" required></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch" style="">
                                <span class="mdc-floating-label" id="message">Message</span>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell--span-2">
                    <button type="submit" class="mdc-button theme-secondary-bg">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label theme-black">Send</span>
                    </button>
                </div>
            </div>
        </form>
    @endif
