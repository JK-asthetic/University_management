
        const dropdown = document.querySelectorAll('.dropdown');

        dropdown.forEach(dropdown => {
            const select = dropdown.querySelector('.select');
            const caret = dropdown.querySelector('.caret');
            const menu = dropdown.querySelector('.menu');
            const options = dropdown.querySelectorAll('.menu li');
            const selected = dropdown.querySelector('.selected');

            select.addEventListener('click', () => {
                select.classList.toggle('select-clicked');
                caret.classList.toggle('caret-rotate');
                menu.classList.toggle('menu-open');
            });

            options.forEach(option => {
                option.addEventListener('click', () => {
                    selected.innerHTML = option.textContent;
                    select.classList.remove('select-clicked');
                    caret.classList.remove('caret-rotate');
                    menu.classList.remove('menu-open');

                    options.forEach(option => {
                        option.classList.remove('active');
                    });

                    option.classList.add('active');

                });
            });
        });


    const radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(radioButton => {
        // Add click event listener to each radio button
        radioButton.addEventListener('click', () => {
            // Hide the dropdown when a radio button is clicked
            document.querySelector('.menu').style.display = 'none';
            // Update the selected value in the dropdown
            document.querySelector('.selected').textContent = radioButton.value;
        });
    });