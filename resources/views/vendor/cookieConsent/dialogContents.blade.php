<div class="mdc-dialog js-cookie-consent cookie-consent"
    style="position: fixed;
    background: #f5f5f5;
    padding: 10px;
    bottom: 0;
    width: 100%;
    text-align: center;
">
  <div class="mdc-dialog__container">
    <div class="mdc-dialog__surface"
      role="alertdialog"
      aria-modal="true"
      aria-labelledby="my-dialog-title"
      aria-describedby="my-dialog-content">
      <div class="mdc-dialog__content" id="my-dialog-content">
      {!! trans('cookieConsent::texts.message') !!}
      </div>
      <div class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button js-cookie-consent-agree cookie-consent__agree" data-mdc-dialog-action="accept">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">{{ trans('cookieConsent::texts.agree') }}</span>
        </button>
      </div>
    </div>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
