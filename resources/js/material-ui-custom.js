// Material Design Web Components Instantiation
import { MDCDrawer } from "@material/drawer";
import { MDCRipple } from "@material/ripple/index";
import { MDCMenuSurface } from "@material/menu-surface";
import { MDCMenu } from "@material/menu";
import { MDCNotchedOutline } from "@material/notched-outline";
import { MDCTextFieldCharacterCounter } from "@material/textfield/character-counter";
import { MDCTextField } from "@material/textfield";
const navigationDrawer = () => {
    // Drawer Menu
    const drawer = MDCDrawer.attachTo(document.querySelector(".mdc-drawer"));
    const menuButtons = () => {
        const button = document.querySelector(".js-menu-button");
        if (!button) return;
        MDCRipple.attachTo(button);
        button.addEventListener("click", function() {
            drawer.open = true;
        });
    }
    menuButtons();

    // const listEl = document.querySelector(".mdc-drawer .mdc-list");
    const mainContentEl = document.querySelector(".mdc-drawer-scrim");

    mainContentEl.addEventListener("click", event => {
        drawer.open = false;
    });

    if (document.querySelector(".mdc-button")){
        // Button
        const ripple = new MDCRipple(document.querySelector(".mdc-button"));
    }
    if (document.querySelector(".mdc-icon-button")){
        // Icon Button
        const iconButtonRipple = new MDCRipple(
            document.querySelector(".mdc-icon-button")
        );
        iconButtonRipple.unbounded = true;
    }
}


const contextualMenuSurface = () => {
    // Menu Surface
    // this was erroring out because mdc-menu-surface is not always available
    if (document.querySelector(".mdc-menu-surface")) {
        const menuSurface = new MDCMenuSurface(
            document.querySelector(".mdc-menu-surface")
        );    
    }
}


const contextualMenu = () => {
    // Menu List
    const menuElements = document.querySelectorAll(".blocks-js .mdc-menu");
    const menus = [];
    if (menuElements) {
        [].map.call(
            document.querySelectorAll(".blocks-js .mdc-menu"),
            function(el) {
                menus[el.getAttribute('data-menu-index')] = new MDCMenu(el);
            }
        );
        document.querySelectorAll(".blocks-js .menu-button").forEach(buttonEl => {
            buttonEl.addEventListener('click', event => {
                menus[event.currentTarget.getAttribute('data-menu-index')].open = !menus[event.currentTarget.getAttribute('data-menu-index')].open;
            });
        });
    }
}

const textField = () => {
    // Text Field
    if (document.querySelectorAll(".mdc-text-field")) {
        const mdcTexts = [].map.call(
            document.querySelectorAll(".mdc-text-field"),
            function(el) {
                return new MDCTextField(el);
            }
        );
    }
}

const textAreaOutline = () => {
    // Text Area Notched Outline
    if (document.querySelectorAll(".mdc-notched-outline")) {
        const mdcNotchedOutline = [].map.call(
            document.querySelectorAll(".mdc-notched-outline"),
            function(el) {
                return new MDCNotchedOutline(el);
            }
        );    
    }
}

const textCounter = () => {
    // Text Counter
    if (document.querySelector(".mdc-text-field-character-counter")) {
        const characterCounter = new MDCTextFieldCharacterCounter(
            document.querySelector(".mdc-text-field-character-counter")
        );
    }
}
textCounter();
textAreaOutline();
textField();
contextualMenuSurface();
contextualMenu();
navigationDrawer();
