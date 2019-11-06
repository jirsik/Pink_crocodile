document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#doner-button')) {
        let doner_button = document.querySelector('#doner-button');
        let doner_button_back = document.querySelector('#doner-button-back');
        let old_doner = document.querySelector('#old-doner');
        let new_doner = document.querySelector('#new-doner');
        let doner = document.querySelector('#doner_id'); //select element
        let doner_last_value = 'none';
        
        doner_button.onclick = function () {
            old_doner.classList.toggle('d-none');
            new_doner.classList.toggle('d-block');
            doner_last_value = doner.value;
            doner.value = 'new';
        };

        doner_button_back.onclick = function () {

            old_doner.classList.toggle('d-none');
            new_doner.classList.toggle('d-block');
            doner.value = doner_last_value;
            //doner_name.value = '';
        };
    }
});