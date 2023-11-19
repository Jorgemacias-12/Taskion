const avatarContainerEl = $('avatar-container');
const avatarEl = $('avatar');
const avatarPreviewEl = $('avatar-img');

avatarEl.addEventListener("change", (e) => {
  const file = e.target.files[0];

  avatarContainerEl.classList.add('show')
  
  if (file) {
    const reader = new FileReader();

    reader.addEventListener('load', (e) => {
      avatarPreviewEl.src = e.target.result;
    });

    reader.readAsDataURL(file);
  }

  avatarPreviewEl.addEventListener('click', () => {
    avatarPreviewEl.src = "";
    avatarContainerEl.classList.remove('show');
    avatarEl.value = "";
  })

});