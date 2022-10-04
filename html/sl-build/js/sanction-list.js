"use strict";
(self["webpackChunksymfony"] = self["webpackChunksymfony"] || []).push([["js/sanction-list"],{

/***/ "./assets/sanction-list.js":
/*!*********************************!*\
  !*** ./assets/sanction-list.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bootstrap_dist_js_bootstrap_min__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap/dist/js/bootstrap.min */ "./node_modules/bootstrap/dist/js/bootstrap.min.js");
/* harmony import */ var bootstrap_dist_js_bootstrap_min__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(bootstrap_dist_js_bootstrap_min__WEBPACK_IMPORTED_MODULE_0__);
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(document).ready(function () {
  var $isChecked = $('.js-sanction-unknown-exclude-date').is(':checked');
  $('.js-sanction-date-exclusion').attr('disabled', $isChecked);
}).on('click', '.js-sanction-unknown-exclude-date', function () {
  var $isChecked = $(this).is(':checked');
  $('.js-sanction-date-exclusion').attr('disabled', $isChecked);
}); // $(document).on('change', '#country', function () {
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

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_bootstrap_dist_js_bootstrap_min_js"], () => (__webpack_exec__("./assets/sanction-list.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoianMvc2FuY3Rpb24tbGlzdC5qcyIsIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7O0FBQUE7QUFFQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFNO0VBQ3RCLElBQUlDLFVBQVUsR0FBR0gsQ0FBQyxDQUFDLG1DQUFELENBQUQsQ0FBdUNJLEVBQXZDLENBQTBDLFVBQTFDLENBQWpCO0VBQ0FKLENBQUMsQ0FBQyw2QkFBRCxDQUFELENBQWlDSyxJQUFqQyxDQUFzQyxVQUF0QyxFQUFrREYsVUFBbEQ7QUFDRCxDQUhELEVBSUdHLEVBSkgsQ0FJTSxPQUpOLEVBSWUsbUNBSmYsRUFJb0QsWUFBWTtFQUM1RCxJQUFJSCxVQUFVLEdBQUdILENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUksRUFBUixDQUFXLFVBQVgsQ0FBakI7RUFDQUosQ0FBQyxDQUFDLDZCQUFELENBQUQsQ0FBaUNLLElBQWpDLENBQXNDLFVBQXRDLEVBQWtERixVQUFsRDtBQUNELENBUEgsR0FVQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZXMiOlsid2VicGFjazovL3N5bWZvbnkvLi9hc3NldHMvc2FuY3Rpb24tbGlzdC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJ2Jvb3RzdHJhcC9kaXN0L2pzL2Jvb3RzdHJhcC5taW4nO1xuXG4kKGRvY3VtZW50KS5yZWFkeSgoKSA9PiB7XG4gIGxldCAkaXNDaGVja2VkID0gJCgnLmpzLXNhbmN0aW9uLXVua25vd24tZXhjbHVkZS1kYXRlJykuaXMoJzpjaGVja2VkJyk7XG4gICQoJy5qcy1zYW5jdGlvbi1kYXRlLWV4Y2x1c2lvbicpLmF0dHIoJ2Rpc2FibGVkJywgJGlzQ2hlY2tlZCk7XG59KVxuICAub24oJ2NsaWNrJywgJy5qcy1zYW5jdGlvbi11bmtub3duLWV4Y2x1ZGUtZGF0ZScsIGZ1bmN0aW9uICgpIHtcbiAgICBsZXQgJGlzQ2hlY2tlZCA9ICQodGhpcykuaXMoJzpjaGVja2VkJyk7XG4gICAgJCgnLmpzLXNhbmN0aW9uLWRhdGUtZXhjbHVzaW9uJykuYXR0cignZGlzYWJsZWQnLCAkaXNDaGVja2VkKTtcbiAgfSk7XG5cblxuLy8gJChkb2N1bWVudCkub24oJ2NoYW5nZScsICcjY291bnRyeScsIGZ1bmN0aW9uICgpIHtcbi8vICAgICBsZXQgY291bnRyeSA9ICQoJyNjb3VudHJ5JykudmFsKCk7XG4vLyAgICAgaWYgKGNvdW50cnkgPT0gMSkge1xuLy8gICAgICAgICAkKCcuanMtZGlyZWN0aXZlLWdyb3VwJykuc2hvdygpO1xuLy8gICAgIH0gZWxzZSB7XG4vLyAgICAgICAgICQoJy5qcy1kaXJlY3RpdmUtZ3JvdXAnKS5oaWRlKCk7XG4vLyAgICAgfVxuLy8gfSk7XG5cbi8vICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcuanMtYWRkLWRpcmVjdGl2ZScsIGZ1bmN0aW9uIChlKSB7XG4vLyAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuLy8gICAgIGxldCBkaXJlY3RpdmVOYW1lID0gJCgnI2RpcmVjdGl2ZU5hbWUnKS52YWwoKTtcbi8vICAgICBsZXQgZGlyZWN0aXZlRGVzY3JpcHRpb24gPSAkKCcjZGlyZWN0aXZlRGVzY3JpcHRpb24nKS52YWwoKTtcbi8vXG4vLyAgICAgJC5hamF4KHtcbi8vICAgICAgICAgdHlwZTogXCJQT1NUXCIsXG4vLyAgICAgICAgIHVybDogXCJpbmRleC5waHBcIixcbi8vICAgICAgICAgZGF0YVR5cGU6IFwianNvblwiLFxuLy8gICAgICAgICBkYXRhOiBcImRpcmVjdGl2ZU5hbWU9XCIgKyBkaXJlY3RpdmVOYW1lICsgXCImZGlyZWN0aXZlRGVzY3JpcHRpb249XCIgKyBkaXJlY3RpdmVEZXNjcmlwdGlvbixcbi8vICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlc3BvbnNlKSB7XG4vLyAgICAgICAgICAgICBsZXQgZGlyZWN0aXZlRXJyb3IgPSAkKCcuanMtZGlyZWN0aXZlLWVycm9yJyk7XG4vLyAgICAgICAgICAgICBpZiAocmVzcG9uc2Uuc3RhdHVzID09PSBcIm9rXCIpIHtcbi8vICAgICAgICAgICAgICAgICAkKCcuanMtZGlyZWN0aXZlLWdyb3VwJykuaHRtbChyZXNwb25zZS5kYXRhKTtcbi8vICAgICAgICAgICAgIH0gZWxzZSB7XG4vLyAgICAgICAgICAgICAgICAgZGlyZWN0aXZlRXJyb3IuaHRtbChyZXNwb25zZS5kYXRhKTtcbi8vICAgICAgICAgICAgICAgICBkaXJlY3RpdmVFcnJvci5zaG93KCk7XG4vLyAgICAgICAgICAgICB9XG4vLyAgICAgICAgIH1cbi8vICAgICB9KTtcbi8vXG4vLyB9KTtcblxuLy8gJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5qcy1hZGQtc2FuY3Rpb24tYnV0dG9uJywgZnVuY3Rpb24gKGUpIHtcbi8vICAgICBsZXQgY291bnRyeSA9ICQoJyNjb3VudHJ5JykudmFsKCk7XG4vLyAgICAgbGV0IHJlcXVpc2l0ZSA9ICQoJyNyZXF1aXNpdGUnKS52YWwoKTtcbi8vICAgICBsZXQgZGF0ZV9pbmNsdXNpb24gPSAkKCcjZGF0ZV9pbmNsdXNpb24nKS52YWwoKTtcbi8vICAgICBsZXQgZGF0ZV9leGNsdXNpb24gPSAkKCcjZGF0ZV9leGNsdXNpb24nKS52YWwoKTtcbi8vICAgICBsZXQgdW5rbm93bl9leGRhdGUgPSAkKCcjdW5rbm93bl9leGRhdGUnKS5pcygnOmNoZWNrZWQnKTtcbi8vICAgICBsZXQgYmFzaXMgPSAkKCcjYmFzaXMnKS52YWwoKTtcbi8vICAgICBsZXQgZGlyZWN0aXZlID0gJCgnI2RpcmVjdGl2ZScpLnZhbCgpO1xuLy8gICAgICQuYWpheCh7XG4vLyAgICAgICAgIHR5cGU6IFwiUE9TVFwiLFxuLy8gICAgICAgICB1cmw6IFwiaW5kZXgucGhwXCIsXG4vLyAgICAgICAgIGRhdGFUeXBlOiBcImpzb25cIixcbi8vICAgICAgICAgZGF0YToge1xuLy8gICAgICAgICAgICAgY291bnRyeTogY291bnRyeSxcbi8vICAgICAgICAgICAgIHJlcXVpc2l0ZTogcmVxdWlzaXRlLFxuLy8gICAgICAgICAgICAgZGF0ZV9pbmNsdXNpb246IGRhdGVfaW5jbHVzaW9uLFxuLy8gICAgICAgICAgICAgZGF0ZV9leGNsdXNpb246IGRhdGVfZXhjbHVzaW9uLFxuLy8gICAgICAgICAgICAgdW5rbm93bl9leGRhdGU6IHVua25vd25fZXhkYXRlLFxuLy8gICAgICAgICAgICAgYmFzaXM6IGJhc2lzLFxuLy8gICAgICAgICAgICAgZGlyZWN0aXZlOiBkaXJlY3RpdmVcbi8vICAgICAgICAgfSxcbi8vICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlc3BvbnNlKSB7XG4vLyAgICAgICAgICAgICBsZXQgc3VjY2VzcyA9ICQoJy5qcy1zYW5jdGlvbi1zdWNjZXNzJyk7XG4vLyAgICAgICAgICAgICBsZXQgZXJyb3IgPSAkKCcuanMtc2FuY3Rpb24tZXJyb3InKTtcbi8vICAgICAgICAgICAgIGlmIChyZXNwb25zZS5zdGF0dXMgPT09IFwib2tcIikge1xuLy8gICAgICAgICAgICAgICAgIHN1Y2Nlc3MuaHRtbChyZXNwb25zZS5kYXRhKTtcbi8vICAgICAgICAgICAgICAgICBlcnJvci5oaWRlKCk7XG4vLyAgICAgICAgICAgICAgICAgc3VjY2Vzcy5zaG93KCk7XG4vLyAgICAgICAgICAgICAgICAgJCgnLmpzLWFkZC1pbnRvLXN1bmN0aW9ucy1saXN0JylbMF0ucmVzZXQoKTtcbi8vICAgICAgICAgICAgICAgICAkKCcjanMtZGF0ZS1leGNsdXNpb24nKS5jb2xsYXBzZSgnc2hvdycpO1xuLy8gICAgICAgICAgICAgICAgICQoJy5qcy1kaXJlY3RpdmUtZ3JvdXAnKS5zaG93KCk7XG4vLyAgICAgICAgICAgICB9IGVsc2Uge1xuLy8gICAgICAgICAgICAgICAgIGVycm9yLmh0bWwocmVzcG9uc2UuZGF0YSk7XG4vLyAgICAgICAgICAgICAgICAgc3VjY2Vzcy5oaWRlKCk7XG4vLyAgICAgICAgICAgICAgICAgZXJyb3Iuc2hvdygpO1xuLy8gICAgICAgICAgICAgfVxuLy8gICAgICAgICB9XG4vLyAgICAgfSk7XG4vLyAgICAgJCgnI2FkZFNhbmN0aW9uJykubW9kYWwoJ2hpZGUnKTtcbi8vIH0pO1xuIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwiJGlzQ2hlY2tlZCIsImlzIiwiYXR0ciIsIm9uIl0sInNvdXJjZVJvb3QiOiIifQ==