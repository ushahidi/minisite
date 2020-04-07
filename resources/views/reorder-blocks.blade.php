@extends('layouts.app')

@section('content')
<div class="reorder-blocks">
    <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell--span-12">
            <p>Change the order in which blocks appear on your homepage by clicking on Up or Down buttons.</p>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <ul class="mdc-list reorder-list">
                <li class="mdc-list-item" tabindex="0">
                    <span class="mdc-list-item__text">
                        Free Form Content
                    </span>
                    <div class="reorder-buttons">
                      <button class="mdc-button mdc-button--raised theme-neutral-bg" disabled>
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Up</span>
                      </button>
                      <button class="mdc-button mdc-button--raised theme-neutral-bg theme-black">
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Down</span>
                      </button>
                    </div>
                </li>
                <li class="mdc-list-item" tabindex="0">
                    <span class="mdc-list-item__text">
                        WhatsApp Group Link
                    </span>
                    <div class="reorder-buttons">
                        <button class="mdc-button mdc-button--raised theme-neutral-bg theme-black">
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Up</span>
                      </button>
                      <button class="mdc-button mdc-button--raised theme-neutral-bg theme-black">
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Down</span>
                      </button>
                    </div>
                </li>
                <li class="mdc-list-item" tabindex="0">
                    <span class="mdc-list-item__text">
                        Free Form Content
                    </span>
                    <div class="reorder-buttons">
                        <button class="mdc-button mdc-button--raised theme-neutral-bg theme-black">
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Up</span>
                      </button>
                      <button class="mdc-button mdc-button--raised theme-neutral-bg theme-black">
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Down</span>
                      </button>
                    </div>
                </li>
                <li class="mdc-list-item" tabindex="0">
                    <span class="mdc-list-item__text">
                        Ushahidi Platform Map
                    </span>
                    <div class="reorder-buttons">
                        <button class="mdc-button mdc-button--raised theme-neutral-bg theme-black">
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Up</span>
                      </button>
                      <button class="mdc-button mdc-button--raised theme-neutral-bg" disabled>
                          <div class="mdc-button__ripple"></div>
                          <span class="mdc-button__label">Down</span>
                      </button>
                    </div>
                </li>
            </ul>
        </div>

        <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="button-group">
                    <div class="mdc-layout-grid__inner">
                        <div class="grid-cell">
                            <a href="#" class="mdc-button mdc-button--raised theme-secondary-bg">
                                <div class="mdc-button__ripple"></div>
                                <span class="mdc-button__label">Save Block Order</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
