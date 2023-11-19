const menuOpenerEls = document.querySelectorAll('.opener');

menuOpenerEls.forEach(el =>  {
  el.addEventListener('click', (e) => {
    const dropdownMenu = el.nextElementSibling;
    
    dropdownMenu.classList.toggle('show');
  })
});

const tabs = document.querySelectorAll('.tab-button')

tabs.forEach(el => {
  el.addEventListener('click', (e) => {
    tabs.forEach(el => el.classList.remove('active'));

    e.target.classList.add('active');
  })
})