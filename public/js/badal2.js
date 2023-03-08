
const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
    const menu = dropdown.querySelector('.dropdown-menu');
    const dropBtn = dropdown.querySelector('.dropdown-toggle');
    const options = dropdown.querySelectorAll('.dropdown-menu li a');
    const selected = dropdown.querySelector('.selected');

    console.log(menu);
    console.log(dropBtn);
    console.log(options);
    console.log(selected);
    
    options.forEach(option => {
        option.addEventListener('click', function() {
            selected.innerHTML = option.innerHTML;
        })
    })
})

function test() {
    console.log('test function');
}

