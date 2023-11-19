const $ = (id) => {
  return document.getElementById(id)
}

const closeBtnEls = document.querySelectorAll(".close")

closeBtnEls.forEach((el) => {
  el.addEventListener("click", (e) => {
    const errorEl = e.currentTarget.parentNode

    errorEl.parentNode.removeChild(errorEl)
  })
})