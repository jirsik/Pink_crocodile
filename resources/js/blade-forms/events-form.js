document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#item-button')) {

        let item_button = document.querySelector('#item-button');
        let item_button_back = document.querySelector('#item-button-back');
        let add_items = document.querySelector('#add-items');
        let available_items = document.querySelector('#available-items');
        let form_type = document.querySelector('#form');
        
        item_button.onclick = function () {
            add_items.classList.toggle('d-none');
            available_items.classList.toggle('d-block');
            form_type.value = 'auction';
        };
    
        item_button_back.onclick = function () {
    
            add_items.classList.toggle('d-none');
            available_items.classList.toggle('d-block');
            form_type.value = 'event';
        };
    }
});