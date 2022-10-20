import 'bootstrap/dist/js/bootstrap.min';

$(document).ready(() => {
  let $isChecked = $('.js-sanction-unknown-exclude-date').is(':checked');
  $('.js-sanction-date-exclusion').attr('disabled', $isChecked);
})
  .on('click', '.js-sanction-unknown-exclude-date', function () {
    let $isChecked = $(this).is(':checked');
    $('.js-sanction-date-exclusion').attr('disabled', $isChecked);
  });


// $(document).on('change', '#country', function () {
//     let country = $('#country').val();
//     if (country == 1) {
//         $('.js-directive-group').show();
//     } else {
//         $('.js-directive-group').hide();
//     }
// });

// $(document).on('click', '.js-add-directive', function (e) {
//     e.preventDefault();
//     let directiveName = $('#directiveName').val();
//     let directiveDescription = $('#directiveDescription').val();
//
//     $.ajax({
//         type: "POST",
//         url: "index.php",
//         dataType: "json",
//         data: "directiveName=" + directiveName + "&directiveDescription=" + directiveDescription,
//         success: function (response) {
//             let directiveError = $('.js-directive-error');
//             if (response.status === "ok") {
//                 $('.js-directive-group').html(response.data);
//             } else {
//                 directiveError.html(response.data);
//                 directiveError.show();
//             }
//         }
//     });
//
// });

// $(document).on('click', '.js-add-sanction-button', function (e) {
//     let country = $('#country').val();
//     let requisite = $('#requisite').val();
//     let date_inclusion = $('#date_inclusion').val();
//     let date_exclusion = $('#date_exclusion').val();
//     let unknown_exdate = $('#unknown_exdate').is(':checked');
//     let basis = $('#basis').val();
//     let directive = $('#directive').val();
//     $.ajax({
//         type: "POST",
//         url: "index.php",
//         dataType: "json",
//         data: {
//             country: country,
//             requisite: requisite,
//             date_inclusion: date_inclusion,
//             date_exclusion: date_exclusion,
//             unknown_exdate: unknown_exdate,
//             basis: basis,
//             directive: directive
//         },
//         success: function (response) {
//             let success = $('.js-sanction-success');
//             let error = $('.js-sanction-error');
//             if (response.status === "ok") {
//                 success.html(response.data);
//                 error.hide();
//                 success.show();
//                 $('.js-add-into-sunctions-list')[0].reset();
//                 $('#js-date-exclusion').collapse('show');
//                 $('.js-directive-group').show();
//             } else {
//                 error.html(response.data);
//                 success.hide();
//                 error.show();
//             }
//         }
//     });
//     $('#addSanction').modal('hide');
// });
