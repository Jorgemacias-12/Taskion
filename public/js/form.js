const startDatePicker = MCDatepicker.create({
  el: "#startDate",
  dateFormat: "yyyy/mm/dd",
  selectedDate: new Date(),
})

const finishDatePicker = MCDatepicker.create({
  el: '#finishDate',
  dateFormat: 'yyyy/mm/dd'
});