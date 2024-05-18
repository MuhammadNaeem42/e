//________ Datepicker

// $(".fc-datepicker").datepicker({
//     dateFormat: "dd MMM yy",
//     monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Maj", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"],
// });
$(function () {
  $(".date_pick_btn").datepicker({ 
        autoclose: true  }).datepicker({  format: "dd MM yy",});
});

$(function () {
  $(".fc-datepicker2")
    .datepicker({
      dateFormat: "dd MMM yy",
      autoclose: true,
      todayHighlight: true,
    })
    .datepicker("update", new Date());
});

// $(document).ready(function () {

//   //Alternativ way
//   $('.fc-datepicker').datepicker({
//     format: "dd/mm/yyyy"
//   }).on('change', function(){
//       $('.datepicker').hide();
//   });

// });
