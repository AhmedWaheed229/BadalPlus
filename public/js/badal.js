var buyBtn = document.querySelector('.buy-btn');
var sellBtn = document.querySelector('.sell-btn');
const dropdowns = document.querySelectorAll('.dropdown-show');



sellBtn.onclick = function () {
    sellBtn.classList.add('active');
    buyBtn.classList.remove('active');
}

buyBtn.onclick = function () {
    buyBtn.classList.add('active');
    sellBtn.classList.remove('active');
}

dropdowns.forEach(dropdown => {
    const menu = dropdown.querySelector('.dropdown-menu');
    const options = dropdown.querySelectorAll('.dropdown-menu li a');
    const selected = dropdown.querySelector('.selected');
    

    options.forEach(option => {
        option.addEventListener('click', function() {
            selected.innerHTML = option.innerText;
        })
    })
})

function test() {
    console.log('test function');
}