var buyBtn = document.querySelector('.buy-btn');
var sellBtn = document.querySelector('.sell-btn');

buyBtn.onclick = function(){
    buyBtn.classList.add('active');
    sellBtn.classList.remove('active');
} 

sellBtn.onclick = function(){
    sellBtn.classList.add('active');
    buyBtn.classList.remove('active');
}

